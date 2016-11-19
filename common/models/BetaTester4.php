<?php

namespace common\models;

use Yii;
use \common\models\base\BetaTester4 as BaseBetaTester4;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "BetaTester4".
 */
class BetaTester4 extends BaseBetaTester4
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
