<?php

namespace common\models;

use Yii;
use \common\models\base\GiftInfo as BaseGiftInfo;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "GiftInfo".
 */
class GiftInfo extends BaseGiftInfo
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
