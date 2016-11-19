<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "Beta4".
 *
 * @property string $AccountID
 * @property integer $CntLogin
 * @property string $aliasModel
 */
abstract class Beta4 extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Beta4';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AccountID'], 'required'],
            [['AccountID'], 'string'],
            [['CntLogin'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AccountID' => Yii::t('models', 'Account ID'),
            'CntLogin' => Yii::t('models', 'Cnt Login'),
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\Beta4Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\Beta4Query(get_called_class());
    }


}
