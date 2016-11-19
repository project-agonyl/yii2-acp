<?php

namespace common\models;

use Yii;
use \common\models\base\ReservedChar as BaseReservedChar;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ReservedChar".
 */
class ReservedChar extends BaseReservedChar
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
