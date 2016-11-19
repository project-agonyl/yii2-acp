<?php

namespace common\models;

use Yii;
use \common\models\base\VItemStorage as BaseVItemStorage;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "vItemStorage".
 */
class VItemStorage extends BaseVItemStorage
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
