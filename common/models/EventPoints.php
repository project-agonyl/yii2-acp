<?php

namespace common\models;

use Yii;
use \common\models\base\EventPoints as BaseEventPoints;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "event_points".
 */
class EventPoints extends BaseEventPoints
{
    const TYPE_PUMPKIN = 1;

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

    public static function getEventTypes()
    {
        return [
            self::TYPE_PUMPKIN => 'Pumpkin Collection Event'
        ];
    }

    public static function getSubmissionEventItemCode()
    {
        return [
            self::TYPE_PUMPKIN => 9735
        ];
    }
}
