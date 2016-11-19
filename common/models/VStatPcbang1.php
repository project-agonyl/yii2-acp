<?php

namespace common\models;

use Yii;
use \common\models\base\VStatPcbang1 as BaseVStatPcbang1;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "vStatPcbang1".
 */
class VStatPcbang1 extends BaseVStatPcbang1
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
