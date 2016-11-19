<?php

namespace common\models;

use Yii;
use \common\models\base\Beta4 as BaseBeta4;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Beta4".
 */
class Beta4 extends BaseBeta4
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
