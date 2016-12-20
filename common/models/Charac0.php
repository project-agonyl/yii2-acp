<?php

namespace common\models;

use Yii;
use \common\models\base\Charac0 as BaseCharac0;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\Query;
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
        $inventoryString = ArrayHelper::getValue(explode('\_1', $this->m_body), $this->getInventoryIndex());
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
        $wearString = ArrayHelper::getValue(explode('\_1', $this->m_body), $this->getWearIndex());
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
        if ($column1 > 16384) {
            $column1 -= 16384;
        }
        if (!isset($this->_itemModels[$column1])) {
            $item = Item::find()
                ->where(['item_id' => $column1])
                ->one();
            if ($item == null) {
                $toReturn['item_name'] = $column1;
                $toReturn['item_id'] = $column1;
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
            !isset(Yii::$app->params['rebirth']['character'][$this->rb + 1]['requirements']) ||
            !isset(Yii::$app->params['rebirth']['character'][$this->rb + 1]['gifts']) ||
            !isset(Yii::$app->params['rebirth']['character'][$this->rb + 1]['gifts']['points'])
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
            $loreString = ArrayHelper::getValue(explode('\_1', $this->m_body), $this->getLoreIndex());
            $temp = explode('=', $loreString);
            if (isset($temp[1]) && (int)$temp[1] >= $lore) {
                $toReturn['Lore ' . $lore] = 'Yes';
            } else {
                $toReturn['Lore ' . $lore] = 'No';
            }
        }
        $dailyQuestCount = ArrayHelper::getValue($requirements, 'daily_quest_count');
        if ($dailyQuestCount != null) {
            $characterDailyQuestCount = DailyQuest::find()
                ->where([
                    'is_deleted' => false,
                    'character' => $this->c_id
                ])
                ->andWhere('submitted_at IS NOT NULL')
                ->count();
            if ($characterDailyQuestCount < $dailyQuestCount) {
                $toReturn[$dailyQuestCount . ' daily quest(s)'] = 'No';
            } else {
                $toReturn[$dailyQuestCount . ' daily quest(s)'] = 'Yes';
            }
        }
        $items = ArrayHelper::getValue($requirements, 'items');
        if (is_array($items)) {
            $inventoryString = ArrayHelper::getValue(explode('\_1', $this->m_body), $this->getInventoryIndex());
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
                            if (isset($itemArray[$currentSlot * 4]) && $itemId == $itemArray[$currentSlot * 4]) {
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
                    if (isset($itemArray[$currentSlot * 4]) && $items[$i] == $itemArray[$currentSlot * 4]) {
                        $toReturn[$itemModel->name . ' at slot ' . ($currentSlot + 1)] = 'Yes';
                    } else {
                        $toReturn[$itemModel->name . ' at slot ' . ($currentSlot + 1)] = 'No';
                    }
                    $currentSlot++;
                }
            }
        }
        $wearString = ArrayHelper::getValue(explode('\_1', $this->m_body), $this->getWearIndex());
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
            $points = Yii::$app->params['rebirth']['character'][$this->rb + 1]['gifts']['points'];
            $oldStats = $this->c_headera;
            $oldMBody = $this->m_body;
            $oldLevel = $this->c_sheaderc;
            $oldRb = $this->rb;
            $oldWz = $this->c_headerc;
            $this->rb++;
            $this->c_sheaderc = (string)1;
            $this->c_headerc -= ArrayHelper::getValue($requirements, 'woonz', 0);
            $this->c_headerc = (string)$this->c_headerc;
            $mBodyArray = explode('\_1', $this->m_body);
            $EXP = explode("=", $mBodyArray[$this->getExpIndex()]);
            $LORE = explode("=", $mBodyArray[$this->getLoreIndex()]);
            $EXP[1] = 0;
            $LORE[1] -= ArrayHelper::getValue($requirements, 'lore', 0);
            $mBodyArray[$this->getExpIndex()] = implode('=', $EXP);
            $mBodyArray[$this->getLoreIndex()] = implode('=', $LORE);
            $items = ArrayHelper::getValue($requirements, 'items');
            if (is_array($items)) {
                $slotsToClear = 0;
                $INVEN = explode("=", $mBodyArray[$this->getInventoryIndex()]);
                $itemArray = explode(';', $INVEN[1]);
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
                for ($i = 0; $i < $slotsToClear * 4; $i++) {
                    if (isset($itemArray[$i])) {
                        unset($itemArray[$i]);
                    }
                }
                $INVEN[1] = implode(';', $itemArray);
                $mBodyArray[$this->getInventoryIndex()] = implode('=', $INVEN);
            }
            $this->m_body = implode('\_1', $mBodyArray);
            switch ($this->c_sheaderb) {
                case '0':
                    $this->c_headera = "30;0;16;35;130;$points;75;20;120;120";
                    break;
                case '1':
                    $this->c_headera = "30;0;20;35;130;$points;50;30;110;120";
                    break;
                case '2':
                    $this->c_headera = "20;26;12;35;130;$points;30;80;30;120";
                    break;
                case '3':
                    $this->c_headera = "30;0;16;35;130;$points;75;37;100;120";
                    break;
            }
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
                        'old_woonz' => $oldWz,
                        'old_stats' => $oldStats,
                        'new_stats' => $this->c_headera
                    ]
                );
                return true;
            }
            return false;
        }
        $this->addError('rebirth', 'Please check whether you meet all requirements to take rebirth');
        return false;
    }

    public function getLore()
    {
        return $this->getIntFromMbody($this->getLoreIndex());
    }

    public function getExp()
    {
        return $this->getIntFromMbody($this->getExpIndex());
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

    public function getInventoryIndex()
    {
        return $this->getMbodyIndex('INVEN');
    }

    public function getWearIndex()
    {
        return $this->getMbodyIndex('WEAR');
    }

    public function getLoreIndex()
    {
        return $this->getMbodyIndex('LORE');
    }

    public function getExpIndex()
    {
        return $this->getMbodyIndex('EXP');
    }

    public function getCurrentQuestIndex()
    {
        return $this->getMbodyIndex('CQUEST');
    }

    public function getLastQuestIndex()
    {
        return $this->getMbodyIndex('LQUEST');
    }

    public function getSkillIndex()
    {
        return $this->getMbodyIndex('SKILL');
    }

    public function getCurrentShueIndex()
    {
        return $this->getMbodyIndex('PETACT');
    }

    public function getCanTakeDailyQuest()
    {
        $dailyQuest = DailyQuest::find()
            ->where([
                'is_deleted' => false,
                'character' => $this->c_id
            ])
            ->orderBy(['taken_at' => SORT_DESC])
            ->one();
        if ($dailyQuest == null) {
            return true;
        }
        $questTakenInterval = (new Query())
            ->select(["DATEDIFF(DAY, '$dailyQuest->taken_at', CURRENT_TIMESTAMP)"])
            ->scalar();
        return $questTakenInterval != 0;
    }

    protected function getMbodyIndex($type)
    {
        $mBodyArray = explode('\_1', $this->m_body);
        $data = [];
        for ($i = 0; $i < count($mBodyArray); $i++) {
            $temp = explode("=", $mBodyArray[$i]);
            $data[] = $temp[0];
        }
        return ArrayHelper::getValue(array_flip($data), $type, 1000);
    }

    public function saveDailyQuestSubmission()
    {
        $oldMBody = $this->m_body;
        $mBodyArray = explode('\_1', $this->m_body);
        $CQUEST = explode("=", $mBodyArray[$this->lastQuestIndex]);
        if (count($CQUEST) < 2) {
            $this->addError('c_id', 'Please complete the daily quest before submitting.');
            return false;
        }
        $questCheck = explode(';', $CQUEST[1]);
        if ($questCheck[0] != 2465) {
            $this->addError('c_id', 'Please complete the daily quest before submitting.');
            return false;
        }
        $dailyQuest = DailyQuest::find()
            ->where([
                'character' => $this->c_id,
                'is_deleted' => false,
            ])
            ->andWhere('submitted_at IS NULL')
            ->orderBy('id')
            ->one();
        if ($dailyQuest == null) {
            $this->addError('c_id', 'Could not save the submitted quest.');
            return false;
        }
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $oldDailyQuest = DailyQuest::find()
                ->where([
                    'character' => $this->c_id,
                    'is_deleted' => false,
                ])
                ->andWhere('submitted_at IS NOT NULL')
                ->orderBy(['submitted_at' => SORT_DESC])
                ->one();
            if ($oldDailyQuest == null) {
                $spree = new CharacterSpree([
                    'character' => $this->c_id,
                    'type' => CharacterSpree::TYPE_DAILY_QUEST,
                    'count' => 1
                ]);
            } else {
                $questSubmitInterval = (new Query())
                    ->select(["DATEDIFF(DAY, '$oldDailyQuest->submitted_at', CURRENT_TIMESTAMP)"])
                    ->scalar();
                if ($questSubmitInterval < 2) {
                    $spree = CharacterSpree::find()
                        ->where([
                            'is_deleted' => false,
                            'character' => $this->c_id,
                            'type' => CharacterSpree::TYPE_DAILY_QUEST
                        ])
                        ->orderBy(['id' => SORT_DESC])
                        ->one();
                    $spree->count++;
                } else {
                    $spree = new CharacterSpree([
                        'character' => $this->c_id,
                        'type' => CharacterSpree::TYPE_DAILY_QUEST,
                        'count' => 1
                    ]);
                }
            }
            if (!$spree->save()) {
                $transaction->rollBack();
                $this->addErrors($spree->errors);
                return false;
            }
            $dailyQuest->submitted_at = date('Y-m-d', time());
            if (!$dailyQuest->save()) {
                $transaction->rollBack();
                $this->addErrors($dailyQuest->errors);
                return false;
            }
            $CQUEST[1] = "0";
            $mBodyArray[$this->lastQuestIndex] = implode('=', $CQUEST);
            $this->m_body = implode('\_1', $mBodyArray);
            if (!$this->save()) {
                $transaction->rollBack();
                return false;
            }
            $transaction->commit();
            ActivityLog::addEntry(
                ActivityLog::EVENT_SUBMIT_DAILY_QUEST,
                Yii::$app->user->id,
                [
                    'character' => $this->c_id,
                    'old_mbody' => $oldMBody,
                    'new_mbody' => $this->m_body
                ]
            );
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            $this->addError('c_id', $e->getMessage());
            return false;
        }
    }
}
