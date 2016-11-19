<?php

namespace common\models;

use Yii;
use \common\models\base\BetaPresent as BaseBetaPresent;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "BetaPresent".
 */
class BetaPresent extends BaseBetaPresent
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
