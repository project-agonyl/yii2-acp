<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "wallet".
 *
 * @property integer $id
 * @property integer $is_deleted
 * @property string $account
 * @property double $cash
 * @property double $coin
 * @property double $credit
 * @property string $created_at
 * @property string $updated_at
 * @property string $aliasModel
 */
abstract class Wallet extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wallet';
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_deleted'], 'integer'],
            [['account'], 'required'],
            [['account'], 'string'],
            [['cash', 'coin', 'credit'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'is_deleted' => Yii::t('models', 'Is Deleted'),
            'account' => Yii::t('models', 'Account'),
            'cash' => Yii::t('models', 'Cash'),
            'coin' => Yii::t('models', 'Coin'),
            'credit' => Yii::t('models', 'Credit'),
            'created_at' => Yii::t('models', 'Created At'),
            'updated_at' => Yii::t('models', 'Updated At'),
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\WalletQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\WalletQuery(get_called_class());
    }


}
