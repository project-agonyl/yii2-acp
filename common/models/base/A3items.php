<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "a3items".
 *
 * @property string $item_id
 * @property string $item_name
 * @property string $aliasModel
 */
abstract class A3items extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'a3items';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'item_name'], 'required'],
            [['item_id'], 'integer'],
            [['item_name'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => Yii::t('models', 'Item ID'),
            'item_name' => Yii::t('models', 'Item Name'),
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\A3itemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\A3itemsQuery(get_called_class());
    }


}
