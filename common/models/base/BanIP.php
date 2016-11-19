<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "Ban_IP".
 *
 * @property string $List_IP
 * @property string $aliasModel
 */
abstract class BanIP extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ban_IP';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['List_IP'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'List_IP' => Yii::t('models', 'List  Ip'),
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\BanIPQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\BanIPQuery(get_called_class());
    }


}
