<?php

namespace common\models;

use Yii;
use \common\models\base\CdgMondrops as BaseCdgMondrops;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cdg_mondrops".
 */
class CdgMondrops extends BaseCdgMondrops
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
