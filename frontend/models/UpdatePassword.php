<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 10-12-2016
 * Time: 15:24
 */

namespace frontend\models;

use common\models\Account;
use common\models\ActivityLog;
use common\models\NotificationLog;
use Yii;
use yii\base\Model;

class UpdatePassword extends Model
{
    public $account;
    public $oldPassword;
    public $newPassword;
    public $repeatPassword;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oldPassword', 'newPassword', 'repeatPassword'], 'safe'],
            ['account', 'required'],
            ['oldPassword', 'trim'],
            ['oldPassword', 'required'],
            ['oldPassword', function ($attribute, $params) {
                $accountModel = Account::find()
                    ->where([
                        'c_headera' => $this->$attribute,
                        'c_id' => $this->account
                    ])
                    ->one();
                if ($accountModel == null) {
                    $this->addError($attribute, 'Incorrect old password.');
                } else {
                    if ($this->newPassword == $this->oldPassword) {
                        $this->addError('newPassword', 'Old and new password cannot be same.');
                    }
                }
            }],
            [['newPassword', 'repeatPassword'], 'required'],
            [['newPassword', 'repeatPassword'], 'string', 'min' => 4],
            ['repeatPassword', 'compare', 'compareAttribute' => 'newPassword', 'message' => 'Passwords do not match']
        ];
    }

    public function save()
    {
        if ($this->validate()) {
            $accountModel = Account::find()
                ->where([
                    'c_id' => $this->account
                ])
                ->one();
            $accountModel->c_headera = $this->newPassword;
            if (!$accountModel->save()) {
                $this->addErrors($accountModel->errors);
                return false;
            }
            ActivityLog::addEntry(
                ActivityLog::EVENT_PASSWORD_UPDATED,
                $accountModel->c_id,
                [
                    'old_password' => $this->oldPassword,
                    'new_password' => $accountModel->c_headera
                ]
            );
            NotificationLog::sendMail(
                NotificationLog::TYPE_UPDATED_PASSWORD,
                $accountModel->c_headerb,
                [
                    'username' => $accountModel->c_id,
                    'password' => $accountModel->c_headera
                ]
            );
            return true;
        }
        return false;
    }
}
