<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "vStatPcbang1".
 *
 * @property string $Sido
 * @property string $Gugun
 * @property integer $TypeA
 * @property integer $TypeO
 * @property integer $Total
 * @property double $Ratio
 * @property string $aliasModel
 */
abstract class VStatPcbang1 extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vStatPcbang1';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Sido', 'Gugun'], 'string'],
            [['TypeA', 'TypeO', 'Total'], 'integer'],
            [['Ratio'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Sido' => Yii::t('models', 'Sido'),
            'Gugun' => Yii::t('models', 'Gugun'),
            'TypeA' => Yii::t('models', 'Type A'),
            'TypeO' => Yii::t('models', 'Type O'),
            'Total' => Yii::t('models', 'Total'),
            'Ratio' => Yii::t('models', 'Ratio'),
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\VStatPcbang1Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VStatPcbang1Query(get_called_class());
    }


}