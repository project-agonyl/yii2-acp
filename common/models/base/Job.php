<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "Job".
 *
 * @property string $JobID
 * @property string $JobName
 * @property string $aliasModel
 */
abstract class Job extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Job';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['JobID', 'JobName'], 'required'],
            [['JobID', 'JobName'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'JobID' => 'Job ID',
            'JobName' => 'Job Name',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\JobQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\JobQuery(get_called_class());
    }


}
