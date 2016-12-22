<?php
namespace common\models\virtual;

use common\models\Account;
use common\models\ActivityLog;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    protected $_account;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean']
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $account = $this->getAccount();
            if ($account == null) {
                $this->addError('username', 'Invalid username or password');
                return false;
            }
            if ($account->c_status == Account::STATUS_NEW) {
                $this->addError('username', 'Please activate your account');
                return false;
            }
            if ($account->c_status != Account::STATUS_ACTIVE) {
                $this->addError('username', 'Account has been suspended/banned. Please contact admin');
                return false;
            }
            switch (Yii::$app->id) {
                case 'a3-admin':
                    $event = ActivityLog::EVENT_ADMIN_PANEL_LOGIN;
                    break;
                default:
                    $event = ActivityLog::EVENT_ACP_LOGIN;
                    break;
            }
            ActivityLog::addEntry(
                $event,
                $account->c_id
            );
            return Yii::$app->user->login($account, $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds account
     *
     * @return Account|null
     */
    protected function getAccount()
    {
        if ($this->_account === null) {
            $this->_account = Account::find()
                ->where([
                    'c_id' => $this->username,
                    'c_headera' => $this->password
                ])
                ->one();
        }

        return $this->_account;
    }
}
