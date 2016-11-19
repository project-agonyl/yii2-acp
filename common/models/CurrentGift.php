<?php

namespace common\models;

use Yii;
use \common\models\base\CurrentGift as BaseCurrentGift;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "CurrentGift".
 */
class CurrentGift extends BaseCurrentGift
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
