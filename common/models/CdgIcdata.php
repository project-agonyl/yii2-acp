<?php

namespace common\models;

use Yii;
use \common\models\base\CdgIcdata as BaseCdgIcdata;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cdg_icdata".
 */
class CdgIcdata extends BaseCdgIcdata
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
