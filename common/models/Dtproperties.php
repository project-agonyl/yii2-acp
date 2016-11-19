<?php

namespace common\models;

use Yii;
use \common\models\base\Dtproperties as BaseDtproperties;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "dtproperties".
 */
class Dtproperties extends BaseDtproperties
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
