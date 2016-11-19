<?php

namespace common\models;

use Yii;
use \common\models\base\Answer as BaseAnswer;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Answer".
 */
class Answer extends BaseAnswer
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
