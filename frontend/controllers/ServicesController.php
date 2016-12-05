<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 05-12-2016
 * Time: 01:10
 */

namespace frontend\controllers;

use common\helpers\Utils;
use common\models\Account;
use common\models\ConnectOldAccount;
use common\models\OldAccount;
use frontend\models\OldAccountTransfer;
use Yii;
use common\components\Controller;

class ServicesController extends Controller
{
    public function actionOldAccountTransfer()
    {
        $connected = ConnectOldAccount::find()
            ->where(['current_account' => Yii::$app->user->id])
            ->one();
        if ($connected != null) {
            $oldAccount = OldAccount::find()
                ->where(['c_id' => $connected->old_account])
                ->one();
            switch ($connected->status) {
                case ConnectOldAccount::STATUS_VERIFIED:
                    $msg = 'Your request has been verified and will be processed shortly by admins. Contact support for any further queries.';
                    break;
                case ConnectOldAccount::STATUS_RESOLVED:
                    $msg = 'Your transfer request was approved and Flamez Coins have been credited to you account. Contact support for any further queries.';
                    break;
                case ConnectOldAccount::STATUS_DECLINED:
                    $msg = 'Your transfer request was declined by an admin. Contact support for further information.';
                    break;
                case ConnectOldAccount::STATUS_CLOSED:
                    $msg = 'Your transfer request was closed/suspended by an admin. Contact support for further information.';
                    break;
                default:
                    $msg = 'Please verify the ownership of your old account by clicking on the verification link sent to your old account email address <b>'.
                        Utils::ObfuscateEmail($oldAccount->c_headerb).'</b>';
                    break;
            }
            return $this->render('transferView', ['msg' => $msg]);
        }
        $model = new OldAccountTransfer(['current_account' => Yii::$app->user->id]);
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['old-account-transfer']);
            }
        }
        return $this->render('transferForm', ['model' => $model]);
    }

    public function actionAccountDetails()
    {
        $model = $this->getAccountModel();
        return $this->render('viewAccountDetails', ['model' => $model]);
    }

    private function getAccountModel()
    {
        $model = Account::find()
            ->where([
                'c_id' => Yii::$app->user->id
            ])
            ->one();
        return $model;
    }
}
