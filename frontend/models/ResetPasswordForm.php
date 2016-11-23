<?php
namespace frontend\models;

use common\models\Account;
use common\models\AccountInfo;
use common\models\ActivityLog;
use yii\base\Model;
use yii\base\InvalidParamException;
use Yii;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $repeatPassword;

    /**
     * @var \common\models\Account
     */
    private $_account;
    /**
     * @var \common\models\AccountInfo
     */
    private $_accInfo;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Password reset token cannot be blank.');
        }
        $this->_accInfo = AccountInfo::find()
            ->where(['forgot_pass_key' => $token])
            ->one();
        if (!$this->_accInfo) {
            throw new InvalidParamException('Wrong password reset token.');
        }
        $this->_account = Account::find()
            ->where(['c_id' => $this->_accInfo->account])
            ->one();
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password', 'repeatPassword'], 'required'],
            ['password', 'string', 'min' => 4],
            ['repeatPassword', 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords do not match']
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $oldPassword = $this->_account->c_headera;
            $this->_account->c_headera = $this->password;
            if (!$this->_account->save()) {
                $transaction->rollBack();
                $this->addErrors($this->_account->errors);
                return false;
            }
            $this->_accInfo->forgot_pass_key = null;
            if (!$this->_accInfo->save()) {
                $transaction->rollBack();
                $this->addErrors($this->_accInfo->errors);
                return false;
            }
            $transaction->commit();
            ActivityLog::addEntry(
                ActivityLog::EVENT_PASSWORD_UPDATED,
                $this->_account->c_id,
                [
                    'old_password' => $oldPassword,
                    'new_password' => $this->password
                ]
            );
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            $this->addError('password', $e->getMessage());
            return false;
        }
    }
}
