<?php

namespace common\models;

use Yii;
use \common\models\base\ItemTable as BaseItemTable;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "item_table".
 */
class ItemTable extends BaseItemTable
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
