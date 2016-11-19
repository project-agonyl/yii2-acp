<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "FRIEND0".
 *
 * @property string $CharName
 * @property string $GroupInfo
 * @property string $FriendInfo
 * @property string $aliasModel
 */
abstract class FRIEND0 extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'FRIEND0';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CharName', 'GroupInfo', 'FriendInfo'], 'required'],
            [['CharName', 'GroupInfo', 'FriendInfo'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CharName' => Yii::t('models', 'Char Name'),
            'GroupInfo' => Yii::t('models', 'Group Info'),
            'FriendInfo' => Yii::t('models', 'Friend Info'),
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\FRIEND0Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\FRIEND0Query(get_called_class());
    }


}
