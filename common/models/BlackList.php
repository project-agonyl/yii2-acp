<?php

namespace common\models;

use Yii;
use \common\models\base\BlackList as BaseBlackList;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "BlackList".
 */
class BlackList extends BaseBlackList
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
