<?php

namespace common\models;

use Yii;
use \common\models\base\Charloginlog as BaseCharloginlog;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "charloginlog".
 */
class Charloginlog extends BaseCharloginlog
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

    public static function onlinePlayerCount()
    {
        return self::find()
            ->where('c_id IS NOT NULL')
            ->count();
    }
}
