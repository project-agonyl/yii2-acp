<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "OutAccount".
 *
 * @property integer $OutAccountID
 * @property string $AccountID
 * @property string $OutDate
 * @property string $Result
 * @property string $ResultUser
 * @property string $ResultDesc
 * @property string $Reason
 * @property string $RestoreDate
 * @property string $SCN
 * @property string $PrevStatus
 * @property string $ResultDate
 * @property string $aliasModel
 */
abstract class OutAccount extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'OutAccount';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OutAccountID', 'AccountID', 'OutDate', 'Result', 'SCN', 'PrevStatus'], 'required'],
            [['OutAccountID'], 'integer'],
            [['AccountID', 'Result', 'ResultUser', 'ResultDesc', 'Reason', 'SCN', 'PrevStatus'], 'string'],
            [['OutDate', 'RestoreDate', 'ResultDate'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'OutAccountID' => Yii::t('models', 'Out Account ID'),
            'AccountID' => Yii::t('models', 'Account ID'),
            'OutDate' => Yii::t('models', 'Out Date'),
            'Result' => Yii::t('models', 'Result'),
            'ResultUser' => Yii::t('models', 'Result User'),
            'ResultDesc' => Yii::t('models', 'Result Desc'),
            'Reason' => Yii::t('models', 'Reason'),
            'RestoreDate' => Yii::t('models', 'Restore Date'),
            'SCN' => Yii::t('models', 'Scn'),
            'PrevStatus' => Yii::t('models', 'Prev Status'),
            'ResultDate' => Yii::t('models', 'Result Date'),
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\OutAccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OutAccountQuery(get_called_class());
    }


}