<?php

namespace common\models;

use Yii;
use \common\models\base\Clan as BaseClan;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "clan".
 */
class Clan extends BaseClan
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
