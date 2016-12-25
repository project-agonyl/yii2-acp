<?php

namespace common\models;

use Yii;
use \common\models\base\MapMonster as BaseMapMonster;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "map_monster".
 */
class MapMonster extends BaseMapMonster
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
