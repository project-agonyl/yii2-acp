<?php

namespace common\models;

use Yii;
use \common\models\base\QuestResponse as BaseQuestResponse;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "QuestResponse".
 */
class QuestResponse extends BaseQuestResponse
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
