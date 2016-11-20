<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "BetaPresent".
 *
 * @property string $AccountID
 * @property string $Present
 * @property string $PresentType
 * @property string $aliasModel
 */
abstract class BetaPresent extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'BetaPresent';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AccountID', 'Present', 'PresentType'], 'required'],
            [['AccountID', 'Present', 'PresentType'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AccountID' => 'Account ID',
            'Present' => 'Present',
            'PresentType' => 'Present Type',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\BetaPresentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\BetaPresentQuery(get_called_class());
    }


}
