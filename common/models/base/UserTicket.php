<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "UserTicket".
 *
 * @property string $AccountID
 * @property string $TicketNo
 * @property string $aliasModel
 */
abstract class UserTicket extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'UserTicket';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AccountID', 'TicketNo'], 'required'],
            [['AccountID', 'TicketNo'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AccountID' => 'Account ID',
            'TicketNo' => 'Ticket No',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\UserTicketQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\UserTicketQuery(get_called_class());
    }


}
