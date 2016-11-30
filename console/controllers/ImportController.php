<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 24-11-2016
 * Time: 00:05
 */

namespace console\controllers;

use common\models\Item;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use yii\helpers\Json;

class ImportController extends Controller
{
    public $path;

    /**
     * @inheritdoc
     */
    public function options($id)
    {
        switch ($id) {
            default:
                $options = ['path'];
                break;
        }
        return array_merge(parent::options($id), $options);
    }

    /**
     * Import IT0.txt file into database
     */
    public function actionIt0()
    {
        if ($this->path == null) {
            $this->path =  Console::prompt('Please input the path of the file to import:', ['required' => true]);
        }
        if (!file_exists($this->path)) {
            Console::error('File does not exists or you do not have the permission to access it!');
            return;
        }
        $fp = fopen($this->path, 'r');
        $currentLine = 0;
        while(!feof($fp)){
            $line = fgets($fp);
            if ($currentLine == 0) {
                $currentLine++;
                continue;
            }
            if ($currentLine == 1 || ($currentLine - 1)%10 == 0) {
                $temp = explode(',', mb_convert_encoding($line, 'ASCII'));
                $item = Item::find()
                    ->where(['item_id' => (int)$temp[0]])
                    ->one();
                if ($item == null) {
                    $item = new Item();
                    $item->item_id = (int)$temp[0];
                    $item->type = (int)$temp[4];
                }
                $item->name = trim($temp[5]);
                $item->woonz = (int)$temp[6];
                $item->meta = Json::encode($temp);
                if ($item->save()) {
                    Console::output('Successfully saved item '.$item->item_id);
                } else {
                    Console::error('Item '.$item->item_id.' failed.');
                }
            }
            $currentLine++;
        }
        fclose($fp);
    }

    /**
     * Import IT1.txt or IT2.txt or IT3.txt file into database
     */
    public function actionIt123()
    {
        if ($this->path == null) {
            $this->path =  Console::prompt('Please input the path of the file to import:', ['required' => true]);
        }
        if (!file_exists($this->path)) {
            Console::error('File does not exists or you do not have the permission to access it!');
            return;
        }
        $fp = fopen($this->path, 'r');
        $currentLine = 0;
        while(!feof($fp)){
            $line = fgets($fp);
            if ($currentLine == 0) {
                $currentLine++;
                continue;
            }
            $temp = explode(',', mb_convert_encoding($line, 'ASCII'));
            $item = Item::find()
                ->where(['item_id' => (int)$temp[0]])
                ->one();
            if ($item == null) {
                $item = new Item();
                $item->item_id = (int)$temp[0];
                $item->type = (int)$temp[1];
            }
            $item->name = trim($temp[3]);
            $item->woonz = (int)$temp[4];
            $item->meta = Json::encode($temp);
            if ($item->save()) {
                Console::output('Successfully saved item '.$item->item_id);
            } else {
                Console::error('Item '.$item->item_id.' failed.');
            }
            $currentLine++;
        }
        fclose($fp);
    }
}
