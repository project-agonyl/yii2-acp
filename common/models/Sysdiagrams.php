<?php

namespace common\models;

use Yii;
use \common\models\base\Sysdiagrams as BaseSysdiagrams;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "sysdiagrams".
 */
class Sysdiagrams extends BaseSysdiagrams
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
