<?php

namespace common\models;

use Yii;
use \common\models\base\VCpu as BaseVCpu;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "v_cpu".
 */
class VCpu extends BaseVCpu
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
