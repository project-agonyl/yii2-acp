<?php

namespace common\models;

use Yii;
use \common\models\base\BetaTester as BaseBetaTester;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "BetaTester".
 */
class BetaTester extends BaseBetaTester
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
