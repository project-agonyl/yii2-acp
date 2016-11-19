<?php

namespace common\models;

use Yii;
use \common\models\base\BetaTester2 as BaseBetaTester2;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "BetaTester2".
 */
class BetaTester2 extends BaseBetaTester2
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
