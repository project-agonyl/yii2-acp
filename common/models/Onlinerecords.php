<?php

namespace common\models;

use Yii;
use \common\models\base\Onlinerecords as BaseOnlinerecords;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "onlinerecords".
 */
class Onlinerecords extends BaseOnlinerecords
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
