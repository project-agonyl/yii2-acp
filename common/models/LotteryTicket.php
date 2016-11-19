<?php

namespace common\models;

use Yii;
use \common\models\base\LotteryTicket as BaseLotteryTicket;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "LotteryTicket".
 */
class LotteryTicket extends BaseLotteryTicket
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
