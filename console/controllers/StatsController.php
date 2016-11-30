<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 30-11-2016
 * Time: 23:27
 */

namespace console\controllers;

use common\models\Account;
use common\models\Charac0;
use Yii;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use yii\helpers\Console;

class StatsController extends Controller
{
    public $item_code;

    /**
     * @inheritdoc
     */
    public function options($id)
    {
        switch ($id) {
            case 'item-count':
                $options = ['item_code'];
                break;
            default:
                $options = [];
                break;
        }
        return array_merge(parent::options($id), $options);
    }

    public function actionItemCount()
    {
        if ($this->item_code == null) {
            $this->item_code =  Console::prompt('Please input the item code to count:', ['required' => true]);
        }
        Console::output('Sit tight while I calculate how many items with code '. $this->item_code.' exists in the server...');
        $accounts = Account::find()
            ->where([
                'c_status' => Account::STATUS_ACTIVE
            ])
            ->all();
        $itemCount = 0;
        foreach ($accounts as $account) {
            $storage = $account->parsedStorage;
            foreach ($storage as $slot => $item) {
                if (ArrayHelper::getValue($item, 'item_id') == $this->item_code) {
                    $itemCount++;
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
                    if (ArrayHelper::getValue($item, 'item_id') == $this->item_code) {
                        $itemCount++;
                    }
                }
                $wear = $character->parsedWear;
                foreach ($wear as $slot => $item) {
                    if (ArrayHelper::getValue($item, 'item_id') == $this->item_code) {
                        $itemCount++;
                    }
                }
            }
        }
        Console::output('I found '.$itemCount.' items');
    }
}
