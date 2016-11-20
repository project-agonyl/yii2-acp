<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "v_beta".
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
abstract class VBeta extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_beta';
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
     * @return \common\models\query\VBetaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VBetaQuery(get_called_class());
    }


}
