<?php

namespace common\models;

use Yii;
use \common\models\base\UserTicket as BaseUserTicket;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "UserTicket".
 */
class UserTicket extends BaseUserTicket
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
