<?php

namespace common\models;

use Yii;
use \common\models\base\A3items as BaseA3items;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "a3items".
 */
class A3items extends BaseA3items
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
