<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "WebLoginLog".
 *
 * @property integer $WebLoginLogID
 * @property string $AccountID
 * @property string $LoginIP
 * @property string $LoginDate
 * @property string $LoginSuccess
 * @property integer $AccessDeny
 * @property string $aliasModel
 */
abstract class WebLoginLog extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'WebLoginLog';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WebLoginLogID', 'AccountID', 'LoginIP', 'LoginDate', 'LoginSuccess', 'AccessDeny'], 'required'],
            [['WebLoginLogID', 'AccessDeny'], 'integer'],
            [['AccountID', 'LoginIP', 'LoginSuccess'], 'string'],
            [['LoginDate'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WebLoginLogID' => Yii::t('models', 'Web Login Log ID'),
            'AccountID' => Yii::t('models', 'Account ID'),
            'LoginIP' => Yii::t('models', 'Login Ip'),
            'LoginDate' => Yii::t('models', 'Login Date'),
            'LoginSuccess' => Yii::t('models', 'Login Success'),
            'AccessDeny' => Yii::t('models', 'Access Deny'),
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\WebLoginLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\WebLoginLogQuery(get_called_class());
    }


}
