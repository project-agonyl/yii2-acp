<?php

namespace common\models;

use Yii;
use \common\models\base\DenyChar as BaseDenyChar;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "DenyChar".
 */
class DenyChar extends BaseDenyChar
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
