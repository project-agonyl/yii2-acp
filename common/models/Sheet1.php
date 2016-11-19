<?php

namespace common\models;

use Yii;
use \common\models\base\Sheet1 as BaseSheet1;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Sheet1".
 */
class Sheet1 extends BaseSheet1
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
