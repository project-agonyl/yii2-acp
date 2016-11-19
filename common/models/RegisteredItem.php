<?php

namespace common\models;

use Yii;
use \common\models\base\RegisteredItem as BaseRegisteredItem;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "RegisteredItem".
 */
class RegisteredItem extends BaseRegisteredItem
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
