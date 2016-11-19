<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "v_os".
 *
 * @property integer $QuestNo
 * @property integer $AnswerNo
 * @property string $AccountID
 * @property string $aliasModel
 */
abstract class VOs extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_os';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['QuestNo', 'AnswerNo', 'AccountID'], 'required'],
            [['QuestNo', 'AnswerNo'], 'integer'],
            [['AccountID'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'QuestNo' => Yii::t('models', 'Quest No'),
            'AnswerNo' => Yii::t('models', 'Answer No'),
            'AccountID' => Yii::t('models', 'Account ID'),
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\VOsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VOsQuery(get_called_class());
    }


}
