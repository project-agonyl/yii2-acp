<?php

namespace common\models;

use Yii;
use \common\models\base\AuthLog as BaseAuthLog;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "AuthLog".
 */
class AuthLog extends BaseAuthLog
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
