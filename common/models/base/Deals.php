<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "Deals".
 *
 * @property integer $deal_id
 * @property string $character
 * @property string $item_name
 * @property string $item_code
 * @property double $flamez_coins
 * @property integer $deal_status
 * @property string $bcharacter
 * @property string $deal_time
 * @property string $seller_ip
 * @property integer $hidden
 * @property double $credits
 * @property string $aliasModel
 */
abstract class Deals extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Deals';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deal_id', 'character', 'item_name', 'item_code'], 'required'],
            [['deal_id', 'deal_status', 'hidden'], 'integer'],
            [['character', 'item_name', 'item_code', 'bcharacter', 'deal_time', 'seller_ip'], 'string'],
            [['flamez_coins', 'credits'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'deal_id' => Yii::t('models', 'Deal ID'),
            'character' => Yii::t('models', 'Character'),
            'item_name' => Yii::t('models', 'Item Name'),
            'item_code' => Yii::t('models', 'Item Code'),
            'flamez_coins' => Yii::t('models', 'Flamez Coins'),
            'deal_status' => Yii::t('models', 'Deal Status'),
            'bcharacter' => Yii::t('models', 'Bcharacter'),
            'deal_time' => Yii::t('models', 'Deal Time'),
            'seller_ip' => Yii::t('models', 'Seller Ip'),
            'hidden' => Yii::t('models', 'Hidden'),
            'credits' => Yii::t('models', 'Credits'),
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\DealsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\DealsQuery(get_called_class());
    }


}