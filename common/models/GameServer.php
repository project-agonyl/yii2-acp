<?php

namespace common\models;

use Yii;
use \common\models\base\GameServer as BaseGameServer;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "GameServer".
 */
class GameServer extends BaseGameServer
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
