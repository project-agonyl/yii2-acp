<?php

namespace common\models;

use Yii;
use \common\models\base\WebLoginLog as BaseWebLoginLog;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "WebLoginLog".
 */
class WebLoginLog extends BaseWebLoginLog
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
