<?php

namespace common\models;

use Yii;
use \common\models\base\Playerpkinfo as BasePlayerpkinfo;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "playerpkinfo".
 */
class Playerpkinfo extends BasePlayerpkinfo
{
    public function behaviors()
    {
        return [];
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
