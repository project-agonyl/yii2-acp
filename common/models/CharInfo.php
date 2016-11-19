<?php

namespace common\models;

use Yii;
use \common\models\base\CharInfo as BaseCharInfo;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "CharInfo".
 */
class CharInfo extends BaseCharInfo
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
