<?php

namespace common\models;

use Yii;
use \common\models\base\Beta31 as BaseBeta31;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Beta3_1".
 */
class Beta31 extends BaseBeta31
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
