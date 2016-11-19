<?php

namespace common\models;

use Yii;
use \common\models\base\AccountFailAuth as BaseAccountFailAuth;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "AccountFailAuth".
 */
class AccountFailAuth extends BaseAccountFailAuth
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
