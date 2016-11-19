<?php

namespace common\models;

use Yii;
use \common\models\base\ReservedPresent as BaseReservedPresent;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ReservedPresent".
 */
class ReservedPresent extends BaseReservedPresent
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
