<?php
/**
 * Created by PhpStorm.
 * User: talview1
 * Date: 7/12/16
 * Time: 9:35 AM
 */

namespace frontend\models;

use common\helpers\Utils;
use common\models\Account;
use common\models\ActivityLog;
use common\models\BuyUniqCode;
use common\models\Charac0;
use common\models\DeliveryTable;
use common\models\EshopItem;
use common\models\EshopOrder;
use common\models\EshopOrderItem;
use common\models\NotificationLog;
use common\models\Wallet;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

class Cart extends Model
{
    public $account;
    public $charToDeliver;
    protected $_orderModel;
    protected $_wallet;
    protected $_accountModel;

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
        if ($order->itemCount >= 25) {
            $this->addError('account', 'Shopping cart is full. Please deliver the existing items to a character before ordering more!');
            return false;
        }
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

    /**
     * @return EshopOrder
     */
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

    public function getItemDataProvider()
    {
        $order = $this->getOrder();
        $query = EshopOrderItem::find()
            ->where([
                'is_deleted' => false,
                'eshop_order_id' => $order->id
            ])
            ->orderBy(['id' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id',
            'pagination' => [
                'pageSize' => 30,
                'validatePage' => false
            ],
            'sort' => false
        ]);
        return $dataProvider;
    }

    public function getCanBuyUsingCoins()
    {
        $order = $this->getOrder();
        return $order->canBuyUsingCoins;
    }

    public function getCanBuyUsingCash()
    {
        $order = $this->getOrder();
        return $order->canBuyUsingCash;
    }

    /**
     * @return Wallet
     */
    public function getWallet()
    {
        if ($this->_wallet != null) {
            return $this->_wallet;
        }
        if ($this->account == null) {
            return null;
        }
        $this->_wallet = Wallet::find()
            ->where([
                'is_deleted' => false,
                'account' => $this->account
            ])
            ->one();
        if ($this->_wallet == null) {
            $this->_wallet = new Wallet();
            $this->_wallet->account = $this->account;
            $this->_wallet->save();
        }
        return $this->_wallet;
    }

    /**
     * @return Account
     */
    public function getAccountModel()
    {
        if ($this->account == null) {
            return null;
        }
        $this->_accountModel = Account::find()
            ->where([
                'c_id' => $this->account
            ])
            ->one();
        return $this->_accountModel;
    }

    public function getIsEmpty()
    {
        $order = $this->getOrder();
        return $order->isEmpty;
    }

    public function deliverUsingCoins()
    {
        return $this->deliverItems('coins');
    }

    public function deliverUsingCash()
    {
        return $this->deliverItems();
    }

    protected function deliverItems($type = 'cash')
    {
        if (!in_array($type, ['coins', 'cash'])) {
            $type = 'cash';
        }
        if ($this->isEmpty) {
            $this->addError('charToDeliver', 'Shopping cart is empty. Please add items to be delivered');
            return false;
        }
        if ($type == 'coins' && !$this->canBuyUsingCoins) {
            $this->addError('charToDeliver', 'Remove items that are not available for Flamez coins and try again!');
            return false;
        }
        if ($type == 'cash' && !$this->canBuyUsingCash) {
            $this->addError('charToDeliver', 'Remove items that are not available for Flamez cash and try again!');
            return false;
        }
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $wallet = $this->getWallet();
            $order = $this->getOrder();
            $amount = 0;
            if ($type == 'coins') {
                $requiredCoins = $order->totalCoinValue;
                $amount = $requiredCoins;
                if ($requiredCoins > $wallet->coin) {
                    $this->addError('charToDeliver', "Your account does not have $requiredCoins Flamez coins to deliver these items!");
                    $transaction->rollBack();
                    return false;
                }
                $wallet->coin -= $requiredCoins;
                if (!$wallet->save()) {
                    $this->addErrors($wallet->errors);
                    $transaction->rollBack();
                    return false;
                }
            }
            if ($type == 'cash') {
                $requiredCash = $order->totalCashValue;
                $amount = $requiredCash;
                if ($requiredCash > $wallet->cash) {
                    $this->addError('charToDeliver', "Your account does not have $requiredCash Flamez cash to deliver these items!");
                    $transaction->rollBack();
                    return false;
                }
                $wallet->cash -= $requiredCash;
                if (!$wallet->save()) {
                    $this->addErrors($wallet->errors);
                    $transaction->rollBack();
                    return false;
                }
            }
            if (!$this->deliverItemsToCharacter($type)) {
                $transaction->rollBack();
                return false;
            }
            $order->is_delivered = true;
            $order->delivered_to = $this->charToDeliver;
            if (!$order->save()) {
                $this->addErrors($order->errors);
                $transaction->rollBack();
                return false;
            }
            $transaction->commit();
            $accountModel = $this->getAccountModel();
            NotificationLog::sendMail(
                NotificationLog::TYPE_ESHOP_DELIVERY,
                $accountModel->c_headerb,
                [
                    'character' => $this->charToDeliver,
                    'type' => $type,
                    'amount' => $amount
                ]
            );
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            $this->addError('charToDeliver', $e->getMessage());
            return false;
        }
    }

    protected function deliverItemsToCharacter($type)
    {
        $characterModel = Charac0::find()
            ->where([
                'c_id' => $this->charToDeliver,
                'c_status' => Charac0::STATUS_ACTIVE
            ])
            ->one();
        if ($characterModel == null) {
            $this->addError('charToDeliver', 'Either invalid character or character is not active');
            return false;
        }
        $order = $this->getOrder();
        $transactionId = (string)$order->id;
        $oldMBody = $characterModel->m_body;
        $mBodyArray = explode('\_1', $characterModel->m_body);
        $INVEN = explode("=", $mBodyArray[6]);
        if (count($INVEN) < 2) {
            $INVEN[1] = '';
        }
        $order = $this->getOrder();
        $currentSlot = 1;
        $itemIds = [];
        foreach ($order->eshopOrderItems as $eshopOrderItem) {
            $itemIds[] = $eshopOrderItem->id;
            for ($k = 1; $k <= $eshopOrderItem->quantity; $k++) {
                $uniqueItemCode = Utils::GenerateUniqueItemCode();
                $uniqueCodeLog = new BuyUniqCode([
                    'transaction_id' => $transactionId,
                    'item_code' => (string)$eshopOrderItem->eshopItem->item_id,
                    'unique_code' => $uniqueItemCode
                ]);
                if (!$uniqueCodeLog->save()) {
                    $this->addErrors($uniqueCodeLog->errors);
                    return false;
                }
                $INVEN[1] .= ';'.$eshopOrderItem->eshopItem->item_id.
                    ';'.$eshopOrderItem->eshopItem->item->second_column_id.';'.$uniqueItemCode.';'.$currentSlot;
                $currentSlot++;
            }
        }
        $mBodyArray[6] = implode('=', $INVEN);
        $characterModel->m_body = implode('\_1', $mBodyArray);
        if (!$characterModel->save()) {
            $this->addErrors($characterModel->errors);
            return false;
        }
        $amount = ($type == 'coins')?$order->totalCoinValue:$order->totalCashValue;
        $deliveryTableModel = new DeliveryTable([
            'transaction_id' => (string)$order->id,
            'account_name' => $this->account,
            'char_name' => $this->charToDeliver,
            'item_ids' => '6144',
            'delivery_time' => Utils::CurrentDateTime(),
            'credits_used' => $amount,
            'ip_address' => Yii::$app->request->userIP
        ]);
        if (!$deliveryTableModel->save()) {
            $this->addErrors($deliveryTableModel->errors);
            return false;
        }
        ActivityLog::addEntry(
            ActivityLog::EVENT_ESHOP_DELIVERY,
            $this->account,
            [
                'character' => $this->charToDeliver,
                'old_m_body' => $oldMBody,
                'new_m_body' => $characterModel->m_body,
                'currency_type' => $type,
                'amount' => $amount
            ],
            "E-shop items worth $amount $type delivered to $this->charToDeliver"
        );
        return true;
    }
}
