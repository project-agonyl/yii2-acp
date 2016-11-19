<?php

namespace common\models;

use Yii;
use \common\models\base\GameBroadcast as BaseGameBroadcast;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "GameBroadcast".
 */
class GameBroadcast extends BaseGameBroadcast
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
