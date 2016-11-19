<?php

namespace common\models;

use Yii;
use \common\models\base\GroupSeat as BaseGroupSeat;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "GroupSeat".
 */
class GroupSeat extends BaseGroupSeat
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
