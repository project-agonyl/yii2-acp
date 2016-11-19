<?php

namespace common\models;

use Yii;
use \common\models\base\Deals as BaseDeals;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Deals".
 */
class Deals extends BaseDeals
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
