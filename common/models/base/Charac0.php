<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "charac0".
 *
 * @property string $c_id
 * @property string $c_sheadera
 * @property string $c_sheaderb
 * @property string $c_sheaderc
 * @property string $c_headera
 * @property string $c_headerb
 * @property string $c_headerc
 * @property string $d_cdate
 * @property string $d_udate
 * @property string $c_status
 * @property string $m_body
 * @property integer $rb
 * @property integer $set_gift
 * @property string $online
 * @property integer $c_reset
 * @property integer $rc_event
 * @property string $aliasModel
 */
abstract class Charac0 extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'charac0';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_id', 'c_sheadera', 'c_sheaderb', 'c_sheaderc', 'c_headera', 'c_headerb', 'c_headerc', 'c_status', 'm_body'], 'required'],
            [['c_id', 'c_sheadera', 'c_sheaderb', 'c_sheaderc', 'c_headera', 'c_headerb', 'c_headerc', 'c_status', 'm_body', 'online'], 'string'],
            [['d_cdate', 'd_udate'], 'safe'],
            [['rb', 'set_gift', 'c_reset', 'rc_event'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c_id' => Yii::t('models', 'C ID'),
            'c_sheadera' => Yii::t('models', 'C Sheadera'),
            'c_sheaderb' => Yii::t('models', 'C Sheaderb'),
            'c_sheaderc' => Yii::t('models', 'C Sheaderc'),
            'c_headera' => Yii::t('models', 'C Headera'),
            'c_headerb' => Yii::t('models', 'C Headerb'),
            'c_headerc' => Yii::t('models', 'C Headerc'),
            'd_cdate' => Yii::t('models', 'D Cdate'),
            'd_udate' => Yii::t('models', 'D Udate'),
            'c_status' => Yii::t('models', 'C Status'),
            'm_body' => Yii::t('models', 'M Body'),
            'rb' => Yii::t('models', 'Rb'),
            'set_gift' => Yii::t('models', 'Set Gift'),
            'online' => Yii::t('models', 'Online'),
            'c_reset' => Yii::t('models', 'C Reset'),
            'rc_event' => Yii::t('models', 'Rc Event'),
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\Charac0Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\Charac0Query(get_called_class());
    }


}
