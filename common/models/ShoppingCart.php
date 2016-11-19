<?php

namespace common\models;

use Yii;
use \common\models\base\ShoppingCart as BaseShoppingCart;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "shopping_cart".
 */
class ShoppingCart extends BaseShoppingCart
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
