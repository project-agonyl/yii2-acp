<?php

namespace common\models;

use Yii;
use \common\models\base\AccountInfo as BaseAccountInfo;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "AccountInfo".
 */
class AccountInfo extends BaseAccountInfo
{
    public function behaviors()
    {
        return [];
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
