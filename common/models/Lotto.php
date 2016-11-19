<?php

namespace common\models;

use Yii;
use \common\models\base\Lotto as BaseLotto;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Lotto".
 */
class Lotto extends BaseLotto
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
