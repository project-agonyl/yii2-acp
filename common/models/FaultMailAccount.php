<?php

namespace common\models;

use Yii;
use \common\models\base\FaultMailAccount as BaseFaultMailAccount;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "FaultMailAccount".
 */
class FaultMailAccount extends BaseFaultMailAccount
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
