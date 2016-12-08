<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "old_hstable".
 *
 * @property integer $HSID
 * @property string $HSName
 * @property string $MasterName
 * @property integer $Type
 * @property integer $HSLevel
 * @property integer $HSExp
 * @property string $Ability
 * @property string $CreateDate
 * @property string $SaveDate
 * @property integer $HSState
 * @property string $DelDate
 * @property string $HSBody
 * @property string $aliasModel
 */
abstract class OldHstable extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'old_hstable';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HSID', 'HSName', 'MasterName', 'Type', 'HSLevel', 'HSExp', 'Ability', 'HSBody'], 'required'],
            [['HSID', 'Type', 'HSLevel', 'HSExp', 'HSState'], 'integer'],
            [['HSName', 'MasterName', 'Ability', 'HSBody'], 'string'],
            [['CreateDate', 'SaveDate', 'DelDate'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'HSID' => 'Hsid',
            'HSName' => 'Hsname',
            'MasterName' => 'Master Name',
            'Type' => 'Type',
            'HSLevel' => 'Hslevel',
            'HSExp' => 'Hsexp',
            'Ability' => 'Ability',
            'CreateDate' => 'Create Date',
            'SaveDate' => 'Save Date',
            'HSState' => 'Hsstate',
            'DelDate' => 'Del Date',
            'HSBody' => 'Hsbody',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\OldHstableQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OldHstableQuery(get_called_class());
    }


}
