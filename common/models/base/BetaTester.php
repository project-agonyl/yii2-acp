<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "BetaTester".
 *
 * @property string $AccountID
 * @property string $Motive
 * @property string $Result
 * @property string $UserName
 * @property string $SCN
 * @property string $ResultDate
 * @property string $ResultUser
 * @property integer $ResultNo
 * @property string $ResultDesc
 * @property string $AuthType
 * @property string $RegistDate
 * @property string $aliasModel
 */
abstract class BetaTester extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'BetaTester';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AccountID', 'Result', 'UserName', 'SCN', 'ResultNo', 'AuthType', 'RegistDate'], 'required'],
            [['AccountID', 'Motive', 'Result', 'UserName', 'SCN', 'ResultUser', 'ResultDesc', 'AuthType'], 'string'],
            [['ResultDate', 'RegistDate'], 'safe'],
            [['ResultNo'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AccountID' => 'Account ID',
            'Motive' => 'Motive',
            'Result' => 'Result',
            'UserName' => 'User Name',
            'SCN' => 'Scn',
            'ResultDate' => 'Result Date',
            'ResultUser' => 'Result User',
            'ResultNo' => 'Result No',
            'ResultDesc' => 'Result Desc',
            'AuthType' => 'Auth Type',
            'RegistDate' => 'Regist Date',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\BetaTesterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\BetaTesterQuery(get_called_class());
    }


}
