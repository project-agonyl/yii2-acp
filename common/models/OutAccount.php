<?php

namespace common\models;

use Yii;
use \common\models\base\OutAccount as BaseOutAccount;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "OutAccount".
 */
class OutAccount extends BaseOutAccount
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
