<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "RentalIndex".
 *
 * @property string $c_id
 * @property string $account
 * @property string $itemcode
 * @property string $attribute
 * @property string $uniqcode
 * @property string $datestart
 * @property string $dateend
 * @property integer $totaldays
 * @property string $status
 * @property integer $points
 * @property string $datetime
 * @property string $aliasModel
 */
abstract class RentalIndex extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'RentalIndex';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_id', 'account', 'itemcode', 'attribute', 'uniqcode', 'datestart', 'dateend', 'totaldays', 'status', 'points'], 'required'],
            [['c_id', 'account', 'status'], 'string'],
            [['itemcode', 'attribute', 'uniqcode', 'datestart', 'dateend', 'totaldays', 'points'], 'integer'],
            [['datetime'], 'safe']
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
            'itemcode' => 'Itemcode',
            'attribute' => 'Attribute',
            'uniqcode' => 'Uniqcode',
            'datestart' => 'Datestart',
            'dateend' => 'Dateend',
            'totaldays' => 'Totaldays',
            'status' => 'Status',
            'points' => 'Points',
            'datetime' => 'Datetime',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\RentalIndexQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RentalIndexQuery(get_called_class());
    }


}
