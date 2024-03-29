<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "Lotto".
 *
 * @property integer $LottoEventID
 * @property string $AccountID
 * @property integer $SelectNum1
 * @property integer $SelectNum2
 * @property integer $SelectNum3
 * @property integer $SelectNum4
 * @property integer $SelectNum5
 * @property string $aliasModel
 */
abstract class Lotto extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Lotto';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LottoEventID', 'AccountID', 'SelectNum1', 'SelectNum2', 'SelectNum3', 'SelectNum4', 'SelectNum5'], 'required'],
            [['LottoEventID', 'SelectNum1', 'SelectNum2', 'SelectNum3', 'SelectNum4', 'SelectNum5'], 'integer'],
            [['AccountID'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LottoEventID' => 'Lotto Event ID',
            'AccountID' => 'Account ID',
            'SelectNum1' => 'Select Num1',
            'SelectNum2' => 'Select Num2',
            'SelectNum3' => 'Select Num3',
            'SelectNum4' => 'Select Num4',
            'SelectNum5' => 'Select Num5',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\LottoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\LottoQuery(get_called_class());
    }


}
