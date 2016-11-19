<?php

namespace common\models;

use Yii;
use \common\models\base\AdultCheck as BaseAdultCheck;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "AdultCheck".
 */
class AdultCheck extends BaseAdultCheck
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
