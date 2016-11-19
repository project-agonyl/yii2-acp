<?php

namespace common\models;

use Yii;
use \common\models\base\LottoEvent as BaseLottoEvent;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "LottoEvent".
 */
class LottoEvent extends BaseLottoEvent
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
