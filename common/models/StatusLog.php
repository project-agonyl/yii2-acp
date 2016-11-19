<?php

namespace common\models;

use Yii;
use \common\models\base\StatusLog as BaseStatusLog;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "StatusLog".
 */
class StatusLog extends BaseStatusLog
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
