<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "vStorage".
 *
 * @property string $HistoryDate
 * @property integer $ServerID
 * @property string $AccountID
 * @property string $Money
 * @property string $CreateDate
 * @property string $LastDate
 * @property string $Status
 * @property string $BodyInfo
 * @property string $aliasModel
 */
abstract class VStorage extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vStorage';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HistoryDate', 'ServerID'], 'required'],
            [['HistoryDate', 'CreateDate', 'LastDate'], 'safe'],
            [['ServerID'], 'integer'],
            [['AccountID', 'Money', 'Status', 'BodyInfo'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'HistoryDate' => 'History Date',
            'ServerID' => 'Server ID',
            'AccountID' => 'Account ID',
            'Money' => 'Money',
            'CreateDate' => 'Create Date',
            'LastDate' => 'Last Date',
            'Status' => 'Status',
            'BodyInfo' => 'Body Info',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\VStorageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VStorageQuery(get_called_class());
    }


}
