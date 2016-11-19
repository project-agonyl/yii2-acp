<?php

namespace common\models;

use Yii;
use \common\models\base\Job as BaseJob;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Job".
 */
class Job extends BaseJob
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
