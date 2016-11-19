<?php

namespace common\models;

use Yii;
use \common\models\base\VVga as BaseVVga;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "v_vga".
 */
class VVga extends BaseVVga
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
