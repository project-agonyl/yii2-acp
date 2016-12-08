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
            $toReturn += $eshopOrderItem->eshopItem->coin;
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
            $toReturn += $eshopOrderItem->eshopItem->cash;
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
}
