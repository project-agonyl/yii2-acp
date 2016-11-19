<?php

namespace common\models;

use Yii;
use \common\models\base\Banlist as BaseBanlist;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Banlist".
 */
class Banlist extends BaseBanlist
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
