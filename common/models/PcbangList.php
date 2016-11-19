<?php

namespace common\models;

use Yii;
use \common\models\base\PcbangList as BasePcbangList;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "PcbangList".
 */
class PcbangList extends BasePcbangList
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
