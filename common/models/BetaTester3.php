<?php

namespace common\models;

use Yii;
use \common\models\base\BetaTester3 as BaseBetaTester3;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "BetaTester3".
 */
class BetaTester3 extends BaseBetaTester3
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
