<?php

namespace common\models;

use Yii;
use \common\models\base\RestoreRequest as BaseRestoreRequest;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "RestoreRequest".
 */
class RestoreRequest extends BaseRestoreRequest
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
