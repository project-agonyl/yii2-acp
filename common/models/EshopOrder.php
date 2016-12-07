<?php

namespace common\models;

use Yii;
use \common\models\base\EshopOrder as BaseEshopOrder;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "eshop_order".
 */
class EshopOrder extends BaseEshopOrder
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

    public function getItemCount()
    {
        return (new Query())
            ->select('SUM(quantity)')
            ->from('eshop_order_item')
            ->where([
                'is_deleted' => false,
                'eshop_order_id' => $this->id
            ])
            ->scalar();
    }
}
