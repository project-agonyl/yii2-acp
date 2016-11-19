<?php

namespace common\models;

use Yii;
use \common\models\base\Charac0ex as BaseCharac0ex;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Charac0ex".
 */
class Charac0ex extends BaseCharac0ex
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
