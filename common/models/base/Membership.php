<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "membership".
 *
 * @property string $c_id
 * @property string $account
 * @property string $memtype
 * @property string $salary
 * @property string $datetook
 * @property string $saldata
 * @property string $ip
 * @property string $d_udate
 * @property integer $curmonth
 * @property string $aliasModel
 */
abstract class Membership extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'membership';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_id', 'account', 'memtype', 'salary'], 'required'],
            [['c_id', 'account', 'memtype', 'salary', 'datetook', 'saldata', 'ip'], 'string'],
            [['d_udate'], 'safe'],
            [['curmonth'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c_id' => 'C ID',
            'account' => 'Account',
            'memtype' => 'Memtype',
            'salary' => 'Salary',
            'datetook' => 'Datetook',
            'saldata' => 'Saldata',
            'ip' => 'Ip',
            'd_udate' => 'D Udate',
            'curmonth' => 'Curmonth',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\MembershipQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\MembershipQuery(get_called_class());
    }


}
