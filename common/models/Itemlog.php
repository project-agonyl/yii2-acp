<?php

namespace common\models;

use Yii;
use \common\models\base\Itemlog as BaseItemlog;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Itemlog".
 */
class Itemlog extends BaseItemlog
{
    public function behaviors()
    {
        return [

        ];
    }

    public function rules()
    {
        return ArrayHelper::merge(
             parent::rules(),
             [
                  # custom validation rules
             ]
        );
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'charname' => 'From',
            'tocharname' => 'To',
            'ip' => 'From IP',
            'toip' => 'To IP',
            'itemname' => 'Item Name',
            'itemcode' => 'Item Code',
            'uniqcode' => 'Unique Code',
            'loc' => 'Location',
            'date' => 'Date',
            'shopname' => 'Shop Name',
            'event' => 'Event',
        ];
    }
}
