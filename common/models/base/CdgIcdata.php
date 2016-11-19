<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "cdg_icdata".
 *
 * @property integer $item1
 * @property integer $item2
 * @property integer $item3
 * @property integer $item4
 * @property integer $item5
 * @property integer $item6
 * @property integer $item7
 * @property integer $item8
 * @property integer $item9
 * @property integer $item10
 * @property integer $item11
 * @property integer $item12
 * @property integer $item13
 * @property integer $item14
 * @property integer $item15
 * @property integer $item16
 * @property string $aliasModel
 */
abstract class CdgIcdata extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cdg_icdata';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item1', 'item2', 'item3', 'item4', 'item5', 'item6', 'item7', 'item8', 'item9', 'item10', 'item11', 'item12', 'item13', 'item14', 'item15', 'item16'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item1' => Yii::t('models', 'Item1'),
            'item2' => Yii::t('models', 'Item2'),
            'item3' => Yii::t('models', 'Item3'),
            'item4' => Yii::t('models', 'Item4'),
            'item5' => Yii::t('models', 'Item5'),
            'item6' => Yii::t('models', 'Item6'),
            'item7' => Yii::t('models', 'Item7'),
            'item8' => Yii::t('models', 'Item8'),
            'item9' => Yii::t('models', 'Item9'),
            'item10' => Yii::t('models', 'Item10'),
            'item11' => Yii::t('models', 'Item11'),
            'item12' => Yii::t('models', 'Item12'),
            'item13' => Yii::t('models', 'Item13'),
            'item14' => Yii::t('models', 'Item14'),
            'item15' => Yii::t('models', 'Item15'),
            'item16' => Yii::t('models', 'Item16'),
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\CdgIcdataQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CdgIcdataQuery(get_called_class());
    }


}
