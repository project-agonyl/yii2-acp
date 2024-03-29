<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "vStatPcbang2".
 *
 * @property string $Sido
 * @property integer $TypeA
 * @property integer $TypeO
 * @property integer $Total
 * @property double $Ratio
 * @property string $aliasModel
 */
abstract class VStatPcbang2 extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vStatPcbang2';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Sido'], 'string'],
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
            'Sido' => 'Sido',
            'TypeA' => 'Type A',
            'TypeO' => 'Type O',
            'Total' => 'Total',
            'Ratio' => 'Ratio',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\VStatPcbang2Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VStatPcbang2Query(get_called_class());
    }


}
