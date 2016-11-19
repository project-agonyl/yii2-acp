<?php

namespace common\models;

use Yii;
use \common\models\base\Charrecord as BaseCharrecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Charrecord".
 */
class Charrecord extends BaseCharrecord
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
