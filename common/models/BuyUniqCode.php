<?php

namespace common\models;

use Yii;
use \common\models\base\BuyUniqCode as BaseBuyUniqCode;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "buy_uniq_code".
 */
class BuyUniqCode extends BaseBuyUniqCode
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
