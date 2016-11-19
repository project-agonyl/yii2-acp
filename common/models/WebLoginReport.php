<?php

namespace common\models;

use Yii;
use \common\models\base\WebLoginReport as BaseWebLoginReport;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "WebLoginReport".
 */
class WebLoginReport extends BaseWebLoginReport
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
