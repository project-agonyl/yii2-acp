<?php

namespace common\models;

use Yii;
use \common\models\base\VOs as BaseVOs;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "v_os".
 */
class VOs extends BaseVOs
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
