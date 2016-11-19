<?php

namespace common\models;

use Yii;
use \common\models\base\Membership as BaseMembership;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "membership".
 */
class Membership extends BaseMembership
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
