<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "playerpkinfo".
 *
 * @property string $id
 * @property string $pker
 * @property string $pker_rb
 * @property string $pker_lvl
 * @property string $pked
 * @property string $pked_rb
 * @property string $pked_lvl
 * @property string $loc
 * @property string $time
 * @property string $pker_nation
 * @property string $pked_nation
 * @property string $aliasModel
 */
abstract class Playerpkinfo extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'playerpkinfo';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pker', 'pker_rb', 'pker_lvl', 'pked', 'pked_rb', 'pked_lvl', 'loc', 'time', 'pker_nation', 'pked_nation'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pker' => 'Pker',
            'pker_rb' => 'Pker Rb',
            'pker_lvl' => 'Pker Lvl',
            'pked' => 'Pked',
            'pked_rb' => 'Pked Rb',
            'pked_lvl' => 'Pked Lvl',
            'loc' => 'Loc',
            'time' => 'Time',
            'pker_nation' => 'Pker Nation',
            'pked_nation' => 'Pked Nation',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\PlayerpkinfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PlayerpkinfoQuery(get_called_class());
    }


}
