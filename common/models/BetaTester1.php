<?php

namespace common\models;

use Yii;
use \common\models\base\BetaTester1 as BaseBetaTester1;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "BetaTester1".
 */
class BetaTester1 extends BaseBetaTester1
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
