<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "map".
 *
 * @property integer $id
 * @property string $name
 * @property integer $map_id
 * @property integer $zone
 * @property string $meta
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \common\models\MapMonster[] $mapMonsters
 * @property string $aliasModel
 */
abstract class Map extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'map';
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'map_id'], 'required'],
            [['name', 'meta'], 'string'],
            [['map_id', 'zone'], 'integer'],
            [['map_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'map_id' => 'Map ID',
            'zone' => 'Zone',
            'meta' => 'Meta',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMapMonsters()
    {
        return $this->hasMany(\common\models\MapMonster::className(), ['map_id' => 'map_id']);
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\MapQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\MapQuery(get_called_class());
    }


}
