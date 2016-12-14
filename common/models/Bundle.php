<?php

namespace common\models;

use Yii;
use \common\models\base\Bundle as BaseBundle;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "bundle".
 */
class Bundle extends BaseBundle
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

    public function getBundleItems()
    {
        return $this->hasMany(BundleItem::className(), ['bundle_id' => 'id'])
            ->onCondition(['is_deleted' => false]);
    }

    public function getItemCount()
    {
        $itemCount = 0;
        foreach ($this->bundleItems as $bundleItem) {
            $itemCount += $bundleItem->quantity;
        }
        return $itemCount;
    }
}
