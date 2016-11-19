<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "Itemlog".
 *
 * @property string $charname
 * @property string $tocharname
 * @property string $ip
 * @property string $toip
 * @property string $itemname
 * @property string $itemcode
 * @property string $uniqcode
 * @property string $loc
 * @property string $date
 * @property string $shopname
 * @property string $event
 * @property string $aliasModel
 */
abstract class Itemlog extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Itemlog';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['charname', 'tocharname', 'event'], 'required'],
            [['charname', 'tocharname', 'ip', 'toip', 'itemname', 'itemcode', 'uniqcode', 'loc', 'shopname', 'event'], 'string'],
            [['date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'charname' => Yii::t('models', 'Charname'),
            'tocharname' => Yii::t('models', 'Tocharname'),
            'ip' => Yii::t('models', 'Ip'),
            'toip' => Yii::t('models', 'Toip'),
            'itemname' => Yii::t('models', 'Itemname'),
            'itemcode' => Yii::t('models', 'Itemcode'),
            'uniqcode' => Yii::t('models', 'Uniqcode'),
            'loc' => Yii::t('models', 'Loc'),
            'date' => Yii::t('models', 'Date'),
            'shopname' => Yii::t('models', 'Shopname'),
            'event' => Yii::t('models', 'Event'),
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\ItemlogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ItemlogQuery(get_called_class());
    }


}