<?php

namespace common\models;

use Yii;
use \common\models\base\VStatPcbang2 as BaseVStatPcbang2;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "vStatPcbang2".
 */
class VStatPcbang2 extends BaseVStatPcbang2
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
