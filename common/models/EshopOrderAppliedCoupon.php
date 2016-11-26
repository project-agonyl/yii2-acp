<?php

namespace common\models;

use Yii;
use \common\models\base\EshopOrderAppliedCoupon as BaseEshopOrderAppliedCoupon;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "eshop_order_applied_coupon".
 */
class EshopOrderAppliedCoupon extends BaseEshopOrderAppliedCoupon
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
}
