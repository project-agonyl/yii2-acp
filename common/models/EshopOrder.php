<?php

namespace common\models;

use Yii;
use \common\models\base\EshopOrder as BaseEshopOrder;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * This is the model class for table "eshop_order".
 */
class EshopOrder extends BaseEshopOrder
{
    const CURRENCY_TYPE = 'currency_type';

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
        $toReturn = 0;
        foreach ($this->eshopOrderItems as $eshopOrderItem) {
            if ($eshopOrderItem->eshopItem->bundle_id == null) {
                $toReturn += $eshopOrderItem->quantity;
            } else {
                $toReturn += $eshopOrderItem->eshopItem->bundle->itemCount * $eshopOrderItem->quantity;
            }
        }
        return $toReturn;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEshopOrderItems()
    {
        return $this->hasMany(EshopOrderItem::className(), ['eshop_order_id' => 'id'])
            ->onCondition(['is_deleted' => false]);
    }

    /**
     * @todo Take discount into consideration
     * @return float|int
     */
    public function getTotalCoinValue()
    {
        $toReturn = 0;
        foreach ($this->eshopOrderItems as $eshopOrderItem) {
            if ($eshopOrderItem->eshopItem->coin == -1) {
                $toReturn = -1;
                break;
            }
            $toReturn += $eshopOrderItem->eshopItem->coin * $eshopOrderItem->quantity;
        }
        return $toReturn;
    }

    /**
     * @todo Take discount into consideration
     * @return float|int
     */
    public function getTotalCashValue()
    {
        $toReturn = 0;
        foreach ($this->eshopOrderItems as $eshopOrderItem) {
            if ($eshopOrderItem->eshopItem->cash == -1) {
                $toReturn = -1;
                break;
            }
            $toReturn += $eshopOrderItem->eshopItem->cash * $eshopOrderItem->quantity;
        }
        return $toReturn;
    }

    public function getCanBuyUsingCoins()
    {
        return $this->totalCoinValue != -1;
    }

    public function getCanBuyUsingCash()
    {
        return $this->totalCashValue != -1;
    }
    
    public function getIsEmpty()
    {
        return EshopOrderItem::find()
            ->where([
                'eshop_order_id' => $this->id,
                'is_deleted' => false
            ])
            ->count() == 0;
    }

    public function getCurrencyType()
    {
        if ($this->account == null || $this->meta == null) {
            return 'coins';
        }
        return ArrayHelper::getValue(Json::decode($this->meta), self::CURRENCY_TYPE);
    }
}
