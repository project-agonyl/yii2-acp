<?php

namespace common\models;

use Yii;
use \common\models\base\Item as BaseItem;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "item".
 */
class Item extends BaseItem
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
