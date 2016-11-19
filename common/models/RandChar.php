<?php

namespace common\models;

use Yii;
use \common\models\base\RandChar as BaseRandChar;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "RandChar".
 */
class RandChar extends BaseRandChar
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
