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
use common\models\AccountInfo;
use common\models\ConnectOldAccount;
use common\models\EventPoints;
use common\models\OldAccount;
use frontend\models\EshopDeliverySearch;
use frontend\models\OldAccountTransfer;
use frontend\models\UpdatePassword;
use Yii;
use common\components\Controller;
use yii\data\ActiveDataProvider;

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
        $formModel = AccountInfo::find()
            ->where(['account' => $model->c_id])
            ->one();
        if (Yii::$app->request->isPost) {
            $formModel->scenario = 'update';
            if ($formModel->load(Yii::$app->request->post()) && $formModel->save()) {
                Yii::$app->session->setFlash('success', 'Account info was successfully updated');
                Yii::$app->session->set('theme', $formModel->theme);
                return $this->redirect(['account-details']);
            } else {
                Yii::$app->session->setFlash('error', 'There was some error updating account info. Please try again later!');
            }
        }
        return $this->render('viewAccountDetails', ['model' => $model, 'formModel' => $formModel]);
    }

    public function actionUpdatePassword()
    {
        $model = new UpdatePassword(['account' => Yii::$app->user->id]);
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['/dashboard']);
            }
        }
        return $this->render('updatePasswordForm', ['model' => $model]);
    }

    public function actionEshopDeliveries()
    {
        $searchModel = new EshopDeliverySearch(['account' => Yii::$app->user->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('eshopDeliveryView', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    public function actionTopPumpkinSubmitters()
    {
        $query = EventPoints::find()
            ->where([
                'type' => EventPoints::TYPE_PUMPKIN
            ])
            ->andWhere(['not', [
                'account' => ['Merlano', 'karthikp', 'a3gm1', 'a3gm2', 'a3gm3', 'a3gm4', 'a3gm5', 'a3gm6', 'a3gm7']
            ]])
            ->orderBy(['points' => SORT_DESC])
            ->limit(10);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id',
            'pagination' => false,
            'sort' => false
        ]);
        return $this->render('topSubmission', ['dataProvider' => $dataProvider]);
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
