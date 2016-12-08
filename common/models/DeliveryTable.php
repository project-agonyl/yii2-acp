<?php

namespace common\models;

use Yii;
use \common\models\base\DeliveryTable as BaseDeliveryTable;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "delivery_table".
 */
class DeliveryTable extends BaseDeliveryTable
{

    public function behaviors()
    {
        return [];
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
}
