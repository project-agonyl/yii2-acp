<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "GroupSeat".
 *
 * @property integer $GroupSeatID
 * @property string $Master
 * @property string $SeatName
 * @property string $SeatType
 * @property string $SeatPassword
 * @property integer $ServerIdx
 * @property integer $CntRegist
 * @property string $Name
 * @property string $aliasModel
 */
abstract class GroupSeat extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'GroupSeat';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GroupSeatID', 'Master', 'SeatName', 'SeatType', 'SeatPassword', 'ServerIdx', 'CntRegist', 'Name'], 'required'],
            [['GroupSeatID', 'ServerIdx', 'CntRegist'], 'integer'],
            [['Master', 'SeatName', 'SeatType', 'SeatPassword', 'Name'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'GroupSeatID' => Yii::t('models', 'Group Seat ID'),
            'Master' => Yii::t('models', 'Master'),
            'SeatName' => Yii::t('models', 'Seat Name'),
            'SeatType' => Yii::t('models', 'Seat Type'),
            'SeatPassword' => Yii::t('models', 'Seat Password'),
            'ServerIdx' => Yii::t('models', 'Server Idx'),
            'CntRegist' => Yii::t('models', 'Cnt Regist'),
            'Name' => Yii::t('models', 'Name'),
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\GroupSeatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\GroupSeatQuery(get_called_class());
    }


}