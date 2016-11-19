<?php

namespace common\models;

use Yii;
use \common\models\base\BetaPcbang as BaseBetaPcbang;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "BetaPcbang".
 */
class BetaPcbang extends BaseBetaPcbang
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
