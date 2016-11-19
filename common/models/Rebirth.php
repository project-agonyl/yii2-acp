<?php

namespace common\models;

use Yii;
use \common\models\base\Rebirth as BaseRebirth;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Rebirth".
 */
class Rebirth extends BaseRebirth
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
