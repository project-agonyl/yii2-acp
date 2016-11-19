<?php

namespace common\models;

use Yii;
use \common\models\base\RentalIndex as BaseRentalIndex;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "RentalIndex".
 */
class RentalIndex extends BaseRentalIndex
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
