<?php

namespace common\models;

use Yii;
use \common\models\base\VBeta as BaseVBeta;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "v_beta".
 */
class VBeta extends BaseVBeta
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
