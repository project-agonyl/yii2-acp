<?php

namespace common\models;

use Yii;
use \common\models\base\ClanMember as BaseClanMember;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ClanMember".
 */
class ClanMember extends BaseClanMember
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
