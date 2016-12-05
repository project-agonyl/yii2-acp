<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "old_charac0".
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
abstract class OldCharac0 extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'old_charac0';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_id', 'c_sheadera', 'c_sheaderb', 'c_sheaderc', 'c_headera', 'c_headerb', 'c_headerc', 'c_status'], 'required'],
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
            'c_id' => 'C ID',
            'c_sheadera' => 'C Sheadera',
            'c_sheaderb' => 'C Sheaderb',
            'c_sheaderc' => 'C Sheaderc',
            'c_headera' => 'C Headera',
            'c_headerb' => 'C Headerb',
            'c_headerc' => 'C Headerc',
            'd_cdate' => 'D Cdate',
            'd_udate' => 'D Udate',
            'c_status' => 'C Status',
            'm_body' => 'M Body',
            'rb' => 'Rb',
            'set_gift' => 'Set Gift',
            'online' => 'Online',
            'c_reset' => 'C Reset',
            'rc_event' => 'Rc Event',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\OldCharac0Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OldCharac0Query(get_called_class());
    }


}
