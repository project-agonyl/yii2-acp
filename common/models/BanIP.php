<?php

namespace common\models;

use Yii;
use \common\models\base\BanIP as BaseBanIP;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Ban_IP".
 */
class BanIP extends BaseBanIP
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
