<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 05-12-2016
 * Time: 01:22
 */

namespace frontend\models;

use common\models\ActivityLog;
use common\models\ConnectOldAccount;
use common\models\ConnectOldAccountRequest;
use common\models\NotificationLog;
use common\models\OldAccount;
use Ramsey\Uuid\Uuid;
use Yii;
use yii\base\Model;
use yii\helpers\Url;

class OldAccountTransfer extends Model
{
    public $current_account;
    public $old_account;

    public function rules()
    {
        return [
            [['current_account', 'old_account'], 'safe'],
            [['current_account', 'old_account'], 'required'],
            ['old_account', 'match', 'pattern' => '/^[A-Za-z0-9]+$/u', 'message'=> 'Old username cannot contain special characters.'],
            ['old_account', 'unique', 'targetClass' => '\common\models\ConnectOldAccount', 'message' => 'This account has already been requested to be transferred. Please contact support for further information'],
            ['current_account', 'unique', 'targetClass' => '\common\models\ConnectOldAccount', 'message' => 'You have already raised a request for old account transfer.'],
            ['old_account', function ($attribute, $params) {
                $oldAccountModel = OldAccount::find()
                   ->where(['c_id' => $this->$attribute])
                   ->one();
                if ($oldAccountModel == null) {
                    $this->addError($attribute, 'Could not find the old account in the server. Please re-check the username or contact support');
                } else {
                    if ($oldAccountModel->c_status != OldAccount::STATUS_ACTIVE) {
                        $this->addError($attribute, 'This old account was not active in the server. Please contact support for further information');
                    }
                }
            }]
        ];
    }

    public function save()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($this->validate()) {
                $oldAccountModel = OldAccount::find()
                    ->where(['c_id' => $this->old_account])
                    ->one();
                $connectOldAccountModel = new ConnectOldAccount([
                    'current_account' => $this->current_account,
                    'old_account' => $this->old_account
                ]);
                if (!$connectOldAccountModel->save()) {
                    $this->addErrors($connectOldAccountModel->errors);
                    $transaction->rollBack();
                    return false;
                }
                $uuid = Uuid::uuid4();
                $requestModel = new ConnectOldAccountRequest([
                    'connect_old_account_id' => $connectOldAccountModel->id,
                    'token' => $uuid->toString()
                ]);
                if (!$requestModel->save()) {
                    $this->addErrors($requestModel->errors);
                    $transaction->rollBack();
                    return false;
                }
                $transaction->commit();
                ActivityLog::addEntry(
                    ActivityLog::EVENT_OLD_ACCOUNT_TRANSFER_REQUEST,
                    $this->current_account,
                    [
                        'old_account' => $this->old_account
                    ]
                );
                NotificationLog::sendMail(
                    NotificationLog::TYPE_TRANSFER_OLD_ACCOUNT_REQUEST,
                    $oldAccountModel->c_headerb,
                    [
                        'old_account' => $this->old_account,
                        'confirmTransferLink' => Url::to(['/account/confirm-transfer', 'token' => $requestModel->token], true),
                        'new_account' => $this->current_account
                    ]
                );
                return true;
            }
            $transaction->rollBack();
            return false;
        } catch (\Exception $e) {
            $transaction->rollBack();
            $this->addError('old_account', $e->getMessage());
            return false;
        }
    }
}
