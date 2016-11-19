<?php

namespace common\models;

use Yii;
use \common\models\base\VAdultAge as BaseVAdultAge;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "vAdultAge".
 */
class VAdultAge extends BaseVAdultAge
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
