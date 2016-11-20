<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "ClanMember".
 *
 * @property integer $ClanID
 * @property integer $ServerID
 * @property string $CharName
 * @property integer $Level
 * @property integer $Class
 * @property integer $Rank
 * @property string $aliasModel
 */
abstract class ClanMember extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ClanMember';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ClanID', 'ServerID', 'Level', 'Class', 'Rank'], 'integer'],
            [['CharName'], 'required'],
            [['CharName'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ClanID' => 'Clan ID',
            'ServerID' => 'Server ID',
            'CharName' => 'Char Name',
            'Level' => 'Level',
            'Class' => 'Class',
            'Rank' => 'Rank',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\ClanMemberQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ClanMemberQuery(get_called_class());
    }


}
