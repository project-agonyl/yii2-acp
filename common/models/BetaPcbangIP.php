<?php

namespace common\models;

use Yii;
use \common\models\base\BetaPcbangIP as BaseBetaPcbangIP;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "BetaPcbangIP".
 */
class BetaPcbangIP extends BaseBetaPcbangIP
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
