<?php

namespace common\models;

use Yii;
use \common\models\base\ConnectOldAccount as BaseConnectOldAccount;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "connect_old_account".
 */
class ConnectOldAccount extends BaseConnectOldAccount
{
    const STATUS_PENDING = 1;
    const STATUS_VERIFIED = 2;
    const STATUS_RESOLVED = 3;
    const STATUS_CLOSED = 4;
    const STATUS_DECLINED = 5;

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                [
                    'class' => TimestampBehavior::className(),
                    'createdAtAttribute' => 'created_at',
                    'updatedAtAttribute' => 'updated_at',
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

    public static function listStatuses()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_VERIFIED => 'Verified',
            self::STATUS_RESOLVED => 'Resolved',
            self::STATUS_CLOSED => 'Closed',
            self::STATUS_DECLINED => 'Declined'
        ];
    }

    public function getStatusString()
    {
        return ArrayHelper::getValue(self::listStatuses(), $this->status, 'Unknown');
    }
}
