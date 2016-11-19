<?php

namespace common\models;

use Yii;
use \common\models\base\VStatAuth1 as BaseVStatAuth1;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "vStatAuth1".
 */
class VStatAuth1 extends BaseVStatAuth1
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
