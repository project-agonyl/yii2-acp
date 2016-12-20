<?php

namespace common\models;

use Yii;
use \common\models\base\DailyQuest as BaseDailyQuest;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "daily_quest".
 */
class DailyQuest extends BaseDailyQuest
{

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                [
                    'class' => TimestampBehavior::className(),
                    'value' => new Expression('CURRENT_TIMESTAMP')
                ]
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
