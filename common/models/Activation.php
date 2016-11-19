<?php

namespace common\models;

use Yii;
use \common\models\base\Activation as BaseActivation;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Activation".
 */
class Activation extends BaseActivation
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
