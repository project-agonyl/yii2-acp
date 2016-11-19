<?php

namespace common\models;

use Yii;
use \common\models\base\UpdateLog as BaseUpdateLog;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "UpdateLog".
 */
class UpdateLog extends BaseUpdateLog
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
