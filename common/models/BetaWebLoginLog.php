<?php

namespace common\models;

use Yii;
use \common\models\base\BetaWebLoginLog as BaseBetaWebLoginLog;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "BetaWebLoginLog".
 */
class BetaWebLoginLog extends BaseBetaWebLoginLog
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
