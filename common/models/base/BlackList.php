<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "BlackList".
 *
 * @property integer $BlackListID
 * @property string $AccountID
 * @property string $BlockStartDate
 * @property string $BlockEndDate
 * @property string $AccountStatus
 * @property string $Status
 * @property string $Content
 * @property string $aliasModel
 */
abstract class BlackList extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'BlackList';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BlackListID', 'AccountID', 'BlockStartDate', 'BlockEndDate', 'AccountStatus', 'Status', 'Content'], 'required'],
            [['BlackListID'], 'integer'],
            [['AccountID', 'AccountStatus', 'Status', 'Content'], 'string'],
            [['BlockStartDate', 'BlockEndDate'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'BlackListID' => Yii::t('models', 'Black List ID'),
            'AccountID' => Yii::t('models', 'Account ID'),
            'BlockStartDate' => Yii::t('models', 'Block Start Date'),
            'BlockEndDate' => Yii::t('models', 'Block End Date'),
            'AccountStatus' => Yii::t('models', 'Account Status'),
            'Status' => Yii::t('models', 'Status'),
            'Content' => Yii::t('models', 'Content'),
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\BlackListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\BlackListQuery(get_called_class());
    }


}
