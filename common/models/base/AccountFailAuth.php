<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "AccountFailAuth".
 *
 * @property integer $FailAuthID
 * @property string $AccountID
 * @property string $SCN1
 * @property string $SCN2
 * @property string $AuthDate
 * @property string $aliasModel
 */
abstract class AccountFailAuth extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'AccountFailAuth';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FailAuthID', 'AccountID', 'SCN1', 'SCN2', 'AuthDate'], 'required'],
            [['FailAuthID'], 'integer'],
            [['AccountID', 'SCN1', 'SCN2'], 'string'],
            [['AuthDate'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'FailAuthID' => 'Fail Auth ID',
            'AccountID' => 'Account ID',
            'SCN1' => 'Scn1',
            'SCN2' => 'Scn2',
            'AuthDate' => 'Auth Date',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\AccountFailAuthQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AccountFailAuthQuery(get_called_class());
    }


}
