<?php

namespace common\models;

use Yii;
use \common\models\base\InnerAccount as BaseInnerAccount;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "InnerAccount".
 */
class InnerAccount extends BaseInnerAccount
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
