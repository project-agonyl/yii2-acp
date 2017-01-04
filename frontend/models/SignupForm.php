<?php
namespace frontend\models;

use common\helpers\Utils;
use common\models\Account;
use common\models\AccountInfo;
use common\models\Activation;
use common\models\ActivityLog;
use common\models\Charac0;
use common\models\NotificationLog;
use Ramsey\Uuid\Uuid;
use Yii;
use yii\base\Model;
use yii\db\Expression;
use yii\helpers\Url;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $c_id;
    public $c_headerb;
    public $c_headera;
    public $repeatPassword;
    public $name = '';
    public $phone = '';
    public $notify = true;
    public $referrer;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c_id' => 'Username',
            'c_headerb' => 'E-mail',
            'c_headera' => 'Password',
            'repeatPassword' => 'Repeat Password',
            'name' => 'Name',
            'phone' => 'Phone'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_id', 'c_headerb', 'c_headera', 'name', 'phone', 'repeatPassword'], 'safe'],
            ['c_id', 'trim'],
            ['c_id', 'match', 'pattern' => '/^[A-Za-z0-9]+$/u', 'message'=> 'Username cannot contain special characters.'],
            ['c_id', 'required'],
            ['c_id', 'unique', 'targetClass' => '\common\models\Account', 'message' => 'This username has already been taken.'],
            ['c_id', 'string', 'min' => 6, 'max' => 12],
            ['c_headerb', 'trim'],
            ['c_headerb', 'required'],
            ['c_headerb', 'email'],
            ['c_headerb', 'string', 'max' => 255],
            ['c_headerb', 'unique', 'targetClass' => '\common\models\Account', 'message' => 'This email address has already been taken.'],
            [['c_headera', 'repeatPassword'], 'required'],
            [['c_headera', 'repeatPassword'], 'string', 'min' => 4],
            ['repeatPassword', 'compare', 'compareAttribute' => 'c_headera', 'message' => 'Passwords do not match']
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool
     */
    public function save()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($this->validate()) {
                $account = new Account();
                $account->c_id = $this->c_id;
                $account->c_headerb = $this->c_headerb;
                $account->c_headera = $this->c_headera;
                $account->c_sheadera = 'reserve';
                $account->c_sheaderb = 'reserve';
                $account->c_sheaderc = 'reserve';
                $account->c_headerc = 'reserve';
                $account->c_status = Account::STATUS_NEW;
                $account->m_body = 'reserve';
                $account->acc_status = 'Normal';
                $account->salary = new Expression('CURRENT_TIMESTAMP');
                $account->last_salary = new Expression('CURRENT_TIMESTAMP');
                if (!$account->save()) {
                    $transaction->rollBack();
                    $this->addErrors($account->errors);
                    return false;
                }
                $accInfo = new AccountInfo();
                $accInfo->name = $this->name;
                $accInfo->account = $account->c_id;
                $accInfo->contact = $this->phone;
                $accInfo->email = $account->c_headerb;
                $accInfo->ip = Yii::$app->request->userIP;
                $accInfo->event_points = 0;
                $accInfo->cevent_points = 0;
                $accInfo->refresh_count = 0;
                $accInfo->ref_add_allow = 1;
                if (!$accInfo->save()) {
                    $transaction->rollBack();
                    $this->addErrors($accInfo->errors);
                    return false;
                }
                $activation = new Activation();
                $activation->account = $account->c_id;
                $uuid = Uuid::uuid4();
                $activation->act_id = $uuid->toString();
                if (!$activation->save()) {
                    $transaction->rollBack();
                    $this->addErrors($activation->errors);
                    return false;
                }
                $transaction->commit();
                ActivityLog::addEntry(
                    ActivityLog::EVENT_ACP_SIGNUP,
                    $account->c_id
                );
                if ($this->notify) {
                    NotificationLog::sendMail(
                        NotificationLog::TYPE_ACCOUNT_ACTIVATION,
                        $account->c_headerb,
                        [
                            'name' => $accInfo->name,
                            'username' => $account->c_id,
                            'password' => $account->c_headera,
                            'activationLink' => Url::to(['/account/activate', 'id' => $activation->act_id], true)
                        ]
                    );
                }
                return true;
            }
            $transaction->rollBack();
            return false;
        } catch (\Exception $e) {
            $transaction->rollBack();
            $this->addError('c_id', $e->getMessage());
            return false;
        }
    }

    public function getReferredBy()
    {
        if ($this->referrer == null) {
            return 'N/A';
        }
        $char = Charac0::find()
            ->where([
                'c_id' => Utils::safeBase64Decode($this->referrer),
                'c_status' => Charac0::STATUS_ACTIVE
            ])
    }
}
