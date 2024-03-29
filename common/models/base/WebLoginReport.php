<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "WebLoginReport".
 *
 * @property integer $LoginYear
 * @property integer $LoginMonth
 * @property integer $LoginDay
 * @property integer $LoginHour
 * @property integer $CntSuccess
 * @property integer $CntFailure
 * @property integer $CntAccessDeny
 * @property string $aliasModel
 */
abstract class WebLoginReport extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'WebLoginReport';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LoginYear', 'LoginMonth', 'LoginDay', 'LoginHour', 'CntSuccess', 'CntFailure', 'CntAccessDeny'], 'required'],
            [['LoginYear', 'LoginMonth', 'LoginDay', 'LoginHour', 'CntSuccess', 'CntFailure', 'CntAccessDeny'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LoginYear' => 'Login Year',
            'LoginMonth' => 'Login Month',
            'LoginDay' => 'Login Day',
            'LoginHour' => 'Login Hour',
            'CntSuccess' => 'Cnt Success',
            'CntFailure' => 'Cnt Failure',
            'CntAccessDeny' => 'Cnt Access Deny',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\WebLoginReportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\WebLoginReportQuery(get_called_class());
    }


}
