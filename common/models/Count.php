<?php

namespace common\models;

use Yii;
use \common\models\base\Count as BaseCount;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Count".
 */
class Count extends BaseCount
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
