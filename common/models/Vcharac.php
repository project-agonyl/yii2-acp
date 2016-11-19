<?php

namespace common\models;

use Yii;
use \common\models\base\Vcharac as BaseVcharac;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "vcharac".
 */
class Vcharac extends BaseVcharac
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
