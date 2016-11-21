<?php

namespace common\models;

use Yii;
use \common\models\base\Account as BaseAccount;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "account".
 */
class Account extends BaseAccount implements IdentityInterface
{
    const STATUS_ACTIVE = 'A';
    const STATUS_NEW = 'F';

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                [
                    'class' => TimestampBehavior::className(),
                    'createdAtAttribute' => 'd_cdate',
                    'updatedAtAttribute' => 'd_udate',
                    'value' => new Expression('CURRENT_TIMESTAMP'),
                ]
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
             parent::rules(),
             [
                  # custom validation rules
             ]
        );
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['c_id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->c_id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->c_headerb;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function getCash()
    {
        $wallet = $this->getWallet();
        if ($wallet == null) {
            return 0;
        }
        return $wallet->cash;
    }

    public function getCoin()
    {
        $wallet = $this->getWallet();
        if ($wallet == null) {
            return 0;
        }
        return $wallet->coin;
    }

    public function getCredit()
    {
        $wallet = $this->getWallet();
        if ($wallet == null) {
            return 0;
        }
        return $wallet->credit;
    }

    protected function getWallet()
    {
        return Wallet::find()
            ->where([
                'is_deleted' => false,
                'account' => $this->c_id
            ])
            ->one();
    }
}
