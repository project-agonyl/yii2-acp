<?php

namespace common\models;

use Yii;
use \common\models\base\EshopOrder as BaseEshopOrder;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "eshop_order".
 */
class EshopOrder extends BaseEshopOrder
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
