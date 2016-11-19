<?php

namespace common\models;

use Yii;
use \common\models\base\CouponTable as BaseCouponTable;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "coupon_table".
 */
class CouponTable extends BaseCouponTable
{

public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
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
