<?php

namespace common\models;

use Yii;
use \common\models\base\OldItemstorage0 as BaseOldItemstorage0;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "old_itemstorage0".
 */
class OldItemstorage0 extends BaseOldItemstorage0
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
