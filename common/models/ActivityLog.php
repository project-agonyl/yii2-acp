<?php

namespace common\models;

use Yii;
use \common\models\base\ActivityLog as BaseActivityLog;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "activity_log".
 */
class ActivityLog extends BaseActivityLog
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
