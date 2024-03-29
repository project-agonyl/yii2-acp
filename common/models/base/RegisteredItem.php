<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "RegisteredItem".
 *
 * @property string $c_id
 * @property string $itemcode
 * @property string $uniqcode
 * @property string $status
 * @property string $charname
 * @property string $aliasModel
 */
abstract class RegisteredItem extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'RegisteredItem';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_id', 'itemcode', 'uniqcode', 'status'], 'required'],
            [['c_id', 'itemcode', 'uniqcode', 'status', 'charname'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c_id' => 'C ID',
            'itemcode' => 'Itemcode',
            'uniqcode' => 'Uniqcode',
            'status' => 'Status',
            'charname' => 'Charname',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\RegisteredItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RegisteredItemQuery(get_called_class());
    }


}
