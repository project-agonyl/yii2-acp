<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "BetaWebLoginLog".
 *
 * @property integer $BetaWebLoginLogID
 * @property string $AccountID
 * @property string $IpAddr
 * @property string $LoginDate
 * @property integer $LoginCheck
 * @property integer $AccessDeny
 * @property string $aliasModel
 */
abstract class BetaWebLoginLog extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'BetaWebLoginLog';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BetaWebLoginLogID', 'AccountID', 'IpAddr', 'LoginDate', 'LoginCheck', 'AccessDeny'], 'required'],
            [['BetaWebLoginLogID', 'LoginCheck', 'AccessDeny'], 'integer'],
            [['AccountID', 'IpAddr'], 'string'],
            [['LoginDate'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'BetaWebLoginLogID' => 'Beta Web Login Log ID',
            'AccountID' => 'Account ID',
            'IpAddr' => 'Ip Addr',
            'LoginDate' => 'Login Date',
            'LoginCheck' => 'Login Check',
            'AccessDeny' => 'Access Deny',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\BetaWebLoginLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\BetaWebLoginLogQuery(get_called_class());
    }


}
