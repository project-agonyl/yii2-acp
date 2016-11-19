<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "QuestList".
 *
 * @property integer $QuestNo
 * @property string $Content
 * @property integer $QuestFlag
 * @property string $aliasModel
 */
abstract class QuestList extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'QuestList';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['QuestNo', 'Content', 'QuestFlag'], 'required'],
            [['QuestNo', 'QuestFlag'], 'integer'],
            [['Content'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'QuestNo' => Yii::t('models', 'Quest No'),
            'Content' => Yii::t('models', 'Content'),
            'QuestFlag' => Yii::t('models', 'Quest Flag'),
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\QuestListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\QuestListQuery(get_called_class());
    }


}