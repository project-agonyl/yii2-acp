<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "Charrecord".
 *
 * @property string $c_id
 * @property string $info
 * @property string $aliasModel
 */
abstract class Charrecord extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Charrecord';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_id'], 'required'],
            [['c_id', 'info'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c_id' => 'C ID',
            'info' => 'Info',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\CharrecordQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CharrecordQuery(get_called_class());
    }


}
