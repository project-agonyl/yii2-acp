<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "GameLoginLog".
 *
 * @property integer $LoginIdx
 * @property string $AccountID
 * @property string $LoginIP
 * @property string $LoginDate
 * @property string $PayMode
 * @property string $aliasModel
 */
abstract class GameLoginLog extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'GameLoginLog';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LoginIdx', 'AccountID', 'LoginIP', 'LoginDate', 'PayMode'], 'required'],
            [['LoginIdx'], 'integer'],
            [['AccountID', 'LoginIP', 'PayMode'], 'string'],
            [['LoginDate'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LoginIdx' => Yii::t('models', 'Login Idx'),
            'AccountID' => Yii::t('models', 'Account ID'),
            'LoginIP' => Yii::t('models', 'Login Ip'),
            'LoginDate' => Yii::t('models', 'Login Date'),
            'PayMode' => Yii::t('models', 'Pay Mode'),
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\GameLoginLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\GameLoginLogQuery(get_called_class());
    }


}
