<?php
/**
 * Created by PhpStorm.
 * User: talview1
 * Date: 1/12/16
 * Time: 12:13 PM
 */

namespace console\controllers;

use common\models\Account;
use common\models\Charac0;
use common\models\Item;
use Yii;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use yii\helpers\Console;

class ExportController extends Controller
{
    public function actionAllItemCount()
    {
        Console::output('Sit tight while I generate report. This might take a while...');
        $filePath = Yii::$app->runtimePath.'/'.time().'_all_item_count.csv';
        $itemCount = [];
        $accounts = Account::find()
            ->where([
                'c_status' => Account::STATUS_ACTIVE
            ])
            ->all();
        foreach ($accounts as $account) {
            $storage = $account->parsedStorage;
            foreach ($storage as $slot => $item) {
                if (ArrayHelper::getValue($item, 'item_id') != null) {
                    if (!isset($itemCount[ArrayHelper::getValue($item, 'item_id')])) {
                        $itemCount[ArrayHelper::getValue($item, 'item_id')] = 0;
                    }
                    $itemCount[ArrayHelper::getValue($item, 'item_id')]++;
                }
            }
            $characters = Charac0::find()
                ->where([
                    'c_sheadera' => $account->c_id,
                    'c_status' => Charac0::STATUS_ACTIVE
                ])
                ->all();
            foreach ($characters as $character) {
                $inventory = $character->parsedInventory;
                foreach ($inventory as $slot => $item) {
                    if (ArrayHelper::getValue($item, 'item_id') != null) {
                        if (!isset($itemCount[ArrayHelper::getValue($item, 'item_id')])) {
                            $itemCount[ArrayHelper::getValue($item, 'item_id')] = 0;
                        }
                        $itemCount[ArrayHelper::getValue($item, 'item_id')]++;
                    }
                }
                $wear = $character->parsedWear;
                foreach ($wear as $slot => $item) {
                    if (ArrayHelper::getValue($item, 'item_id') != null) {
                        if (!isset($itemCount[ArrayHelper::getValue($item, 'item_id')])) {
                            $itemCount[ArrayHelper::getValue($item, 'item_id')] = 0;
                        }
                        $itemCount[ArrayHelper::getValue($item, 'item_id')]++;
                    }
                }
            }
        }
        $header = ['Item Code', 'Item Name', 'Count'];
        $body = [];
        $items = Item::find()
            ->where('id IS NOT NULL')
            ->orderBy('item_id')
            ->all();
        foreach ($items as $item) {
            $body[] = [$item->item_id, $item->name, ArrayHelper::getValue($itemCount, $item->item_id, 0)];
        }
        $fp = fopen($filePath, 'w');
        fputcsv($fp, $header);
        for ($i = 0; $i < count($body); $i++) {
            fputcsv($fp, $body[$i]);
        }
        fclose($fp);
        Console::output('Item counts were exported to '.$filePath);
    }
}
