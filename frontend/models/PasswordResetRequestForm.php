<?php
namespace frontend\models;

use common\models\Account;
use common\models\AccountInfo;
use common\models\ActivityLog;
use common\models\NotificationLog;
use Ramsey\Uuid\Uuid;
use Yii;
use yii\base\Model;
use common\models\User;
use yii\db\Query;
use yii\helpers\Url;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $username;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'safe'],
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 6, 'max' => 12],
            ['username', 'match', 'pattern' => '/^[A-Za-z0-9]+$/u', 'message'=> 'Username cannot contain special characters.']
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function save()
    {
        $account = Account::find()
            ->where([
                'c_id' => $this->username,
                'c_status' => Account::STATUS_ACTIVE
            ])
            ->one();
        if ($account != null) {
            $accInfo = AccountInfo::find()
                ->where(['account' => $account->c_id])
                ->one();
            if ($accInfo == null) {
                $accInfo = new AccountInfo([
                    'account' => $account->c_id
                ]);
                $accInfo->email = $account->c_headerb;
                $accInfo->ip = Yii::$app->request->userIP;
                $accInfo->event_points = 0;
                $accInfo->cevent_points = 0;
                $accInfo->refresh_count = 0;
                $accInfo->ref_add_allow = 1;
            }
            $uuid = Uuid::uuid4();
            $accInfo->forgot_pass_key = $uuid->toString();
            if ($accInfo->save()) {
                NotificationLog::sendMail(
                    NotificationLog::TYPE_FORGOT_PASSWORD,
                    $account->c_headerb,
                    [
                        'username' => $account->c_id,
                        'resetPasswordLink' => Url::to(['/account/reset-password', 'token' => $accInfo->forgot_pass_key], true)
                    ]
                );
            }
        }
        return true;
    }
}
