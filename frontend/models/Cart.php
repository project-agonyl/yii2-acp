<?php
/**
 * Created by PhpStorm.
 * User: talview1
 * Date: 7/12/16
 * Time: 9:35 AM
 */

namespace frontend\models;

use common\models\EshopItem;
use common\models\EshopOrder;
use common\models\EshopOrderItem;
use Yii;
use yii\base\Model;

class Cart extends Model
{
    public $account;
    private $_orderModel;

    public function add($id, $quantity = 1)
    {
        if ($this->account == null) {
            $this->addError('account', 'Account is required to do operations on cart');
            return false;
        }
        if ($id == null) {
            $this->addError('account', 'Invalid eshop item');
            return false;
        }
        if ($quantity == null || !is_numeric($quantity)) {
            $quantity = 1;
        }
        $eshopItemModel = EshopItem::find()
            ->where([
                'is_deleted' => false,
                'id' => $id
            ])
            ->andWhere('cash > -1 OR coin > -1')
            ->one();
        if ($eshopItemModel == null) {
            $this->addError('account', 'Invalid eshop item');
            return false;
        }
        $order = $this->getOrder();
        $orderItem = EshopOrderItem::find()
            ->where([
                'is_deleted' => false,
                'eshop_item_id' => $eshopItemModel->id,
                'eshop_order_id' => $order->id
            ])
            ->one();
        if ($orderItem == null) {
            $orderItem = new EshopOrderItem([
                'eshop_item_id' => $eshopItemModel->id,
                'eshop_order_id' => $order->id,
                'quantity' => $quantity
            ]);
        } else {
            $orderItem->quantity += $quantity;
        }
        if (!$orderItem->save()) {
            $this->addErrors($orderItem->errors);
            return false;
        }
        return true;
    }

    public function remove($id, $quantity = 1)
    {
        if ($this->account == null) {
            $this->addError('account', 'Account is required to do operations on cart');
            return false;
        }
        if ($id == null) {
            $this->addError('account', 'Invalid eshop item');
            return false;
        }
        if ($quantity == null || !is_numeric($quantity)) {
            $quantity = 1;
        }
        $eshopItemModel = EshopItem::find()
            ->where([
                'is_deleted' => false,
                'id' => $id
            ])
            ->andWhere('cash > -1 OR coin > -1')
            ->one();
        if ($eshopItemModel == null) {
            $this->addError('account', 'Invalid eshop item');
            return false;
        }
        $order = $this->getOrder();
        $orderItem = EshopOrderItem::find()
            ->where([
                'is_deleted' => false,
                'eshop_item_id' => $eshopItemModel->id,
                'eshop_order_id' => $order->id
            ])
            ->one();
        if ($orderItem == null) {
            return true;
        }
        if ($orderItem->quantity <= $quantity) {
            $orderItem->is_deleted = true;
        } else {
            $orderItem->quantity -= $quantity;
        }
        if (!$orderItem->save()) {
            $this->addErrors($orderItem->errors);
            return false;
        }
        return true;
    }

    public function getOrder()
    {
        if ($this->_orderModel != null) {
            return $this->_orderModel;
        }
        if ($this->account == null) {
            return null;
        }
        $this->_orderModel = EshopOrder::find()
            ->where([
                'is_delivered' => false,
                'account' => $this->account
            ])
            ->orderBy(['id' => SORT_DESC])
            ->one();
        if ($this->_orderModel == null) {
            $this->_orderModel = new EshopOrder([
                'account' => $this->account
            ]);
            $this->_orderModel->save();
        }
        return $this->_orderModel;
    }
}
