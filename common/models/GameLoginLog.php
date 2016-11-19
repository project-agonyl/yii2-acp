<?php

namespace common\models;

use Yii;
use \common\models\base\GameLoginLog as BaseGameLoginLog;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "GameLoginLog".
 */
class GameLoginLog extends BaseGameLoginLog
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
