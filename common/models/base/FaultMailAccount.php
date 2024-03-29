<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "FaultMailAccount".
 *
 * @property string $AccountID
 * @property string $aliasModel
 */
abstract class FaultMailAccount extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'FaultMailAccount';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AccountID'], 'required'],
            [['AccountID'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AccountID' => 'Account ID',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\FaultMailAccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\FaultMailAccountQuery(get_called_class());
    }


}
