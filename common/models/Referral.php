<?php

namespace common\models;

use Yii;
use \common\models\base\Referral as BaseReferral;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "referral".
 */
class Referral extends BaseReferral
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
