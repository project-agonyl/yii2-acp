<?php

namespace common\models;

use Yii;
use \common\models\base\ZipCode as BaseZipCode;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ZipCode".
 */
class ZipCode extends BaseZipCode
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
