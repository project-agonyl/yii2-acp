<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "StatusLog".
 *
 * @property integer $StatusLogID
 * @property string $ManageID
 * @property string $AccountID
 * @property string $Status
 * @property string $StartDate
 * @property string $EndDate
 * @property string $Content
 * @property string $LogDate
 * @property string $aliasModel
 */
abstract class StatusLog extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'StatusLog';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['StatusLogID', 'ManageID', 'AccountID', 'Status', 'StartDate', 'EndDate', 'Content', 'LogDate'], 'required'],
            [['StatusLogID'], 'integer'],
            [['ManageID', 'AccountID', 'Status', 'Content'], 'string'],
            [['StartDate', 'EndDate', 'LogDate'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'StatusLogID' => 'Status Log ID',
            'ManageID' => 'Manage ID',
            'AccountID' => 'Account ID',
            'Status' => 'Status',
            'StartDate' => 'Start Date',
            'EndDate' => 'End Date',
            'Content' => 'Content',
            'LogDate' => 'Log Date',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\StatusLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\StatusLogQuery(get_called_class());
    }


}
