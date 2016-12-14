<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 26-11-2016
 * Time: 22:36
 */

namespace backend\modules\database\models;

use common\models\Bundle;
use common\models\BundleItem;
use common\models\Item;
use Yii;
use yii\helpers\ArrayHelper;

class BundleForm extends Bundle
{
    public function scenarios()
    {
        return ArrayHelper::merge(
            parent::scenarios(),
            [
                'create' => ['name'],
                'update' => ['name']
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                [['name'], 'required']
            ]
        );
    }

    public function add($id, $quantity = 1)
    {
        if ($this->id == null) {
            $this->addError('id', 'Bundle has to be specified');
            return false;
        }
        if ($id == null) {
            $this->addError('id', 'Invalid eshop item');
            return false;
        }
        if ($quantity == null || !is_numeric($quantity)) {
            $quantity = 1;
        }
        $itemModel = Item::find()
            ->where([
                'item_id' => $id
            ])
            ->one();
        if ($itemModel == null) {
            $this->addError('account', 'Invalid item');
            return false;
        }
        $bundleItem = BundleItem::find()
            ->where([
                'is_deleted' => false,
                'item_id' => $itemModel->item_id,
                'bundle_id' => $this->id
            ])
            ->one();
        if ($bundleItem == null) {
            $bundleItem = new BundleItem([
                'item_id' => $itemModel->item_id,
                'bundle_id' => $this->id,
                'quantity' => $quantity
            ]);
        } else {
            $bundleItem->quantity += $quantity;
        }
        if (!$bundleItem->save()) {
            $this->addErrors($bundleItem->errors);
            return false;
        }
        return true;
    }

    public function remove($id, $quantity = 1)
    {
        if ($this->id == null) {
            $this->addError('id', 'Account is required to do operations on cart');
            return false;
        }
        if ($quantity == null || !is_numeric($quantity)) {
            $quantity = 1;
        }
        $itemModel = Item::find()
            ->where([
                'item_id' => $id
            ])
            ->one();
        if ($itemModel == null) {
            $this->addError('account', 'Invalid eshop item');
            return false;
        }
        $bundleItem = BundleItem::find()
            ->where([
                'is_deleted' => false,
                'item_id' => $itemModel->item_id,
                'bundle_id' => $this->id
            ])
            ->one();
        if ($bundleItem == null) {
            return true;
        }
        if ($bundleItem->quantity <= $quantity) {
            $bundleItem->is_deleted = true;
        } else {
            $bundleItem->quantity -= $quantity;
        }
        if (!$bundleItem->save()) {
            $this->addErrors($bundleItem->errors);
            return false;
        }
        return true;
    }
}
