<?php

namespace common\models;

use Yii;
use \common\models\base\ClanInfo as BaseClanInfo;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ClanInfo".
 */
class ClanInfo extends BaseClanInfo
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
