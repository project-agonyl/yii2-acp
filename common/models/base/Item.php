<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "item".
 *
 * @property integer $id
 * @property integer $second_column_id
 * @property integer $is_available_eshop
 * @property string $name
 * @property integer $type
 * @property string $meta
 * @property integer $woonz
 * @property integer $item_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \common\models\EshopCoupon[] $eshopCoupons
 * @property \common\models\EshopItem[] $eshopItems
 * @property \common\models\ItemInfo[] $itemInfos
 * @property string $aliasModel
 */
abstract class Item extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item';
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
            [['second_column_id', 'is_available_eshop', 'type', 'woonz', 'item_id'], 'integer'],
            [['name', 'item_id'], 'required'],
            [['name', 'meta'], 'string'],
            [['item_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'second_column_id' => 'Second Column ID',
            'is_available_eshop' => 'Is Available Eshop',
            'name' => 'Name',
            'type' => 'Type',
            'meta' => 'Meta',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'woonz' => 'Woonz',
            'item_id' => 'Item ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEshopCoupons()
    {
        return $this->hasMany(\common\models\EshopCoupon::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEshopItems()
    {
        return $this->hasMany(\common\models\EshopItem::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemInfos()
    {
        return $this->hasMany(\common\models\ItemInfo::className(), ['item_id' => 'id']);
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\ItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ItemQuery(get_called_class());
    }


}
