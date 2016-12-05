<?php

namespace common\models;

use Yii;
use \common\models\base\Charac0 as BaseCharac0;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "charac0".
 */
class Charac0 extends BaseCharac0
{
    const STATUS_ACTIVE = 'A';
    const STATUS_DELETED = 'X';

    const TEMOZ_LOCATION = '1;32383';

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

    public function getId()
    {
        return $this->c_id;
    }

    public function getTypeString()
    {
        switch ((int)$this->c_sheaderb) {
            case 1:
                $type = 'Holy Knight';
                break;
            case 2:
                $type = 'Mage';
                break;
            case 3:
                $type = 'Archer';
                break;
            default:
                $type = 'Warrior';
                break;
        }
        return $type;
    }

    public function getParsedInventory()
    {
        $inventoryString = ArrayHelper::getValue(explode('\_1', $this->m_body), 6);
        if ($inventoryString == null) {
            return [];
        }
        $temp = explode('=', $inventoryString);
        $itemArray = explode(';', $temp[1]);
        $toReturn = [];
        for ($i = 0; $i < count($itemArray); $i += 4) {
            if (!isset($itemArray[$i + 3])) {
                continue;
            }
            $toReturn[(int)$itemArray[$i + 3]] = $this->processItem(
                (int)$itemArray[$i],
                (int)$itemArray[$i + 1],
                (int)$itemArray[$i + 2]
            );
        }
        return $toReturn;
    }

    public function getParsedWear()
    {
        $wearString = ArrayHelper::getValue(explode('\_1', $this->m_body), 5);
        if ($wearString == null) {
            return [];
        }
        $temp = explode('=', $wearString);
        if (count($temp) == 1) {
            return [];
        }
        $itemArray = explode(';', $temp[1]);
        $toReturn = [];
        for ($i = 0; $i < count($itemArray); $i += 3) {
            if (!isset($itemArray[$i + 2])) {
                continue;
            }
            $toReturn[] = $this->processItem(
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
            $toReturn['full_item_name'] = ($mounted * 10) . '% Mounted ' . $toReturn['full_item_name'];
        }
        if ($bless) {
            $toReturn['full_item_name'] = 'Blessed ' . $toReturn['full_item_name'];
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

    public function checkRebirthRequirements()
    {
        if (!isset(Yii::$app->params['rebirth']) ||
            !isset(Yii::$app->params['rebirth']['character']) ||
            !isset(Yii::$app->params['rebirth']['character'][$this->rb + 1]) ||
            !isset(Yii::$app->params['rebirth']['character'][$this->rb + 1]['requirements'])
        ) {
            return ['Rebirth' => 'Not Available'];
        }
        $toReturn = [];
        $requirements = Yii::$app->params['rebirth']['character'][$this->rb + 1]['requirements'];
        $level = ArrayHelper::getValue($requirements, 'level');
        if ($level != null) {
            if ($this->c_sheaderc >= $level) {
                $toReturn['Level ' . $level] = 'Yes';
            } else {
                $toReturn['Level ' . $level] = 'No';
            }
        }
        $wz = ArrayHelper::getValue($requirements, 'woonz');
        if ($wz != null) {
            if ($this->c_headerc >= $wz) {
                $toReturn['Woonz ' . $wz] = 'Yes';
            } else {
                $toReturn['Woonz ' . $wz] = 'No';
            }
        }
        $lore = ArrayHelper::getValue($requirements, 'lore');
        if ($lore != null) {
            $loreString = ArrayHelper::getValue(explode('\_1', $this->m_body), 19);
            $temp = explode('=', $loreString);
            if ((int)$temp[1] >= $lore) {
                $toReturn['Lore ' . $lore] = 'Yes';
            } else {
                $toReturn['Lore ' . $lore] = 'No';
            }
        }
        $items = ArrayHelper::getValue($requirements, 'items');
        if (is_array($items)) {
            $inventoryString = ArrayHelper::getValue(explode('\_1', $this->m_body), 6);
            $temp = explode('=', $inventoryString);
            $itemArray = explode(';', $temp[1]);
            $currentSlot = 0;
            for ($i = 0; $i < count($items); $i++) {
                if (is_array($items[$i])) {
                    foreach ($items[$i] as $itemId => $count) {
                        $itemModel = Item::find()
                            ->where(['item_id' => $itemId])
                            ->one();
                        if ($itemModel == null) {
                            continue;
                        }
                        while ($count > 0) {
                            if ($itemId == $itemArray[$currentSlot * 4]) {
                                $toReturn[$itemModel->name . ' at slot ' . ($currentSlot + 1)] = 'Yes';
                            } else {
                                $toReturn[$itemModel->name . ' at slot ' . ($currentSlot + 1)] = 'No';
                            }
                            $currentSlot++;
                            $count--;
                        }
                    }
                } else {
                    $itemModel = Item::find()
                        ->where(['item_id' => $items[$i]])
                        ->one();
                    if ($itemModel == null) {
                        continue;
                    }
                    if ($items[$i] == $itemArray[$currentSlot * 4]) {
                        $toReturn[$itemModel->name . ' at slot ' . ($currentSlot + 1)] = 'Yes';
                    } else {
                        $toReturn[$itemModel->name . ' at slot ' . ($currentSlot + 1)] = 'No';
                    }
                    $currentSlot++;
                }
            }
        }
        $wearString = ArrayHelper::getValue(explode('\_1', $this->m_body), 5);
        if ($wearString == null) {
            $toReturn['Wear cleared'] = 'Yes';
        } else {
            $temp = explode('=', $wearString);
            if (count($temp) == 1) {
                $toReturn['Wear cleared'] = 'Yes';
            } else {
                $itemArray = explode(';', $temp[1]);
                $notWorn = true;
                for ($j = 0; $j < count($itemArray); $j++) {
                    if ($itemArray[$j] != 0) {
                        $notWorn = false;
                        break;
                    }
                }
                if ($notWorn) {
                    $toReturn['Wear cleared'] = 'Yes';
                } else {
                    $toReturn['Wear cleared'] = 'No';
                }
            }
        }
        return (count($toReturn) == 0) ? ['Rebirth' => 'Not Available'] : $toReturn;
    }

    public function getCanTakeRebirth()
    {
        $requirements = $this->checkRebirthRequirements();
        if (ArrayHelper::getValue($requirements, 'Rebirth') != null) {
            return false;
        }
        $toReturn = true;
        foreach ($requirements as $msg => $status) {
            if ($status == 'No') {
                $toReturn = false;
                break;
            }
        }
        return $toReturn;
    }

    public function takeRebirth()
    {
        if ($this->canTakeRebirth) {
            $requirements = Yii::$app->params['rebirth']['character'][$this->rb + 1]['requirements'];
            $oldMBody = $this->m_body;
            $oldLevel = $this->c_sheaderc;
            $oldRb = $this->rb;
            $oldWz = $this->c_headerc;
            $this->rb++;
            $this->c_sheaderc = 1;
            $this->c_headerc -= ArrayHelper::getValue($requirements, 'woonz', 0);
            $mBodyArray = explode('\_1', $this->m_body);
            $INVEN = explode("=", $mBodyArray[6]);
            $EXP = explode("=", $mBodyArray[0]);
            $LORE = explode("=", $mBodyArray[19]);
            $EXP[1] = 0;
            $LORE[1] -= ArrayHelper::getValue($requirements, 'lore', 0);
            $mBodyArray[0] = implode('=', $EXP);
            $mBodyArray[19] = implode('=', $LORE);
            $itemArray = explode(';', $INVEN[1]);
            $slotsToClear = 0;
            $items = ArrayHelper::getValue($requirements, 'items');
            if (is_array($items)) {
                for ($i = 0; $i < count($items); $i++) {
                    if (is_array($items[$i])) {
                        foreach ($items[$i] as $itemId => $count) {
                            while ($count > 0) {
                                $slotsToClear++;
                                $count--;
                            }
                        }
                    } else {
                        $slotsToClear++;
                    }
                }
            }
            for ($i = 1; $i <= $slotsToClear * 4; $i++) {
                if (isset($itemArray[$i])) {
                    unset($itemArray[$i]);
                }
            }
            $itemArray = array_filter($itemArray);
            $INVEN[1] = implode(';', $itemArray);
            $mBodyArray[6] = implode('=', $INVEN);
            $this->m_body = implode('\_1', $mBodyArray);
            if ($this->save()) {
                ActivityLog::addEntry(
                    ActivityLog::EVENT_TAKE_REBIRTH,
                    $this->c_sheadera,
                    [
                        'character' => $this->c_id,
                        'old_m_body' => $oldMBody,
                        'new_m_body' => $this->m_body,
                        'old_level' => $oldLevel,
                        'old_rebirth' => $oldRb,
                        'old_woonz' => $oldWz
                    ]
                );
            }
            return false;
        }
        $this->addError('rebirth', 'Please check whether you meet all requirements to take rebirth');
        return false;
    }

    public function getLore()
    {
        return $this->getIntFromMbody(19);
    }

    public function getExp()
    {
        return $this->getIntFromMbody(0);
    }

    protected function getIntFromMbody($index)
    {
        $string = ArrayHelper::getValue(explode('\_1', $this->m_body), $index);
        if ($string == null) {
            return 0;
        }
        $temp = explode('=', $string);
        if (count($temp) < 2) {
            return 0;
        }
        return (int)$temp[1];
    }
}
