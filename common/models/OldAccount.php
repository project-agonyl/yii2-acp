<?php

namespace common\models;

use Yii;
use \common\models\base\OldAccount as BaseOldAccount;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "old_account".
 */
class OldAccount extends BaseOldAccount
{
    const STATUS_ACTIVE = 'A';
    const STATUS_NEW = 'F';

    protected $_itemModels = [];

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                [
                    'class' => TimestampBehavior::className(),
                    'createdAtAttribute' => 'd_cdate',
                    'updatedAtAttribute' => 'd_udate',
                    'value' => new Expression('CURRENT_TIMESTAMP'),
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

    public function getParsedStorage()
    {
        $storage = ItemStorage0::find()
            ->where([
                'c_id' => $this->c_id
            ])
            ->one();
        if ($storage == null) {
            return [];
        }
        $itemArray = explode(';', $storage->m_body);
        $toReturn = [];
        for ($i = 0; $i < count($itemArray);$i += 4) {
            $toReturn[(int)$itemArray[$i + 3]] = $this->processItem(
                (int)$itemArray[$i],
                (int)$itemArray[$i + 1],
                (int)$itemArray[$i + 2]
            );
        }
        return $toReturn;
    }

    public function processItem($column1, $column2, $column3)
    {
        $toReturn['original_item_code'] = implode(';', [$column1, $column2, $column3]);
        $mounted = 0;
        $bless = false;
        $greyOption = 0;
        $redOption = 0;
        $blueOption = 0;
        $level = 0;
        $additionalStats = 0;
        while ($column1 > 65536) {
            $mounted++;
            $column1 -= 65536;
        }
        if ($column1 > 32768) {
            $bless = true;
            $column1 -= 32768;
        }
        if (!isset($this->_itemModels[$column1])) {
            $item = Item::find()
                ->where(['item_id' => $column1])
                ->one();
            if ($item == null) {
                $toReturn['item_name'] = 'Unknown Item';
                return $toReturn;
            }
            $this->_itemModels[$column1] = $item;
        } else {
            $item = $this->_itemModels[$column1];
        }
        while ($column2 > 67108864) {
            $column2 -= 67108864;
            $greyOption++;
        }
        $toReturn['item_name'] = $item->name;
        $toReturn['item_id'] = $item->item_id;
        $toReturn['full_item_name'] = $item->name;
        if ($mounted != 0) {
            $toReturn['full_item_name'] = ($mounted*10).'% Mounted '.$toReturn['full_item_name'];
        }
        if ($bless) {
            $toReturn['full_item_name'] = 'Blessed '.$toReturn['full_item_name'];
        }
        $toReturn['options'] = [
            'mount' => $mounted,
            'bless' => $bless,
            'greyOption' => $greyOption,
            'redOption' => $redOption,
            'blueOption' => $blueOption,
            'level' => $level,
            'additionalStats' => $additionalStats
        ];
        return $toReturn;
    }

    public function getTotalItemValue()
    {
        $itemCosts = ArrayHelper::getValue(Yii::$app->params, 'old.item.cost');
        if (!is_array($itemCosts)) {
            return 0;
        }
        $accountCost = 0;
        $storage = $this->parsedStorage;
        foreach ($storage as $slot => $item) {
            $accountCost += ArrayHelper::getValue($itemCosts, ArrayHelper::getValue($item, 'item_id'), 0);
        }
        $characters = OldCharac0::find()
            ->where([
                'c_sheadera' => $this->c_id,
                'c_status' => OldCharac0::STATUS_ACTIVE
            ])
            ->all();
        foreach ($characters as $character) {
            $inventory = $character->parsedInventory;
            foreach ($inventory as $slot => $item) {
                $accountCost += ArrayHelper::getValue($itemCosts, ArrayHelper::getValue($item, 'item_id'), 0);
            }
            $wear = $character->parsedWear;
            foreach ($wear as $slot => $item) {
                $accountCost += ArrayHelper::getValue($itemCosts, ArrayHelper::getValue($item, 'item_id'), 0);
            }
        }
        return $accountCost;
    }
}
