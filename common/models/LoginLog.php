<?php

namespace common\models;

use Yii;
use \common\models\base\LoginLog as BaseLoginLog;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "LoginLog".
 */
class LoginLog extends BaseLoginLog
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
