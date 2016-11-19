<?php

namespace common\models;

use Yii;
use \common\models\base\VStatAuth2 as BaseVStatAuth2;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "vStatAuth2".
 */
class VStatAuth2 extends BaseVStatAuth2
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
