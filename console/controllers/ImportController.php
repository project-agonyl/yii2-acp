<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 24-11-2016
 * Time: 00:05
 */

namespace console\controllers;

use common\models\Item;
use common\models\Map;
use common\models\MapMonster;
use common\models\Monster;
use common\models\MonsterItem;
use PHPExcel_IOFactory;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use yii\helpers\Json;

class ImportController extends Controller
{
    public $path;
    public $clearPrevious = false;

    /**
     * @inheritdoc
     */
    public function options($id)
    {
        switch ($id) {
            default:
                $options = ['path', 'clearPrevious'];
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

    /**
     * Import MON.txt
     */
    public function actionMonster()
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
            $monster = Monster::find()
                ->where(['monster_id' => (int)$temp[0]])
                ->one();
            if ($monster == null) {
                $monster = new Monster();
                $monster->monster_id = (int)$temp[0];
            }
            $monster->name = trim($temp[1]);
            $monster->respawn_time = (int)$temp[2];
            $monster->meta = Json::encode($temp);
            if ($monster->save()) {
                Console::output('Successfully saved monster '.$monster->monster_id);
            } else {
                Console::error('Monster '.$monster->monster_id.' failed.');
            }
            $currentLine++;
        }
        fclose($fp);
    }

    /**
     * Import MC.txt
     */
    public function actionMap()
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
            $map = Map::find()
                ->where(['map_id' => (int)$temp[0]])
                ->one();
            if ($map == null) {
                $map = new Map();
                $map->map_id = (int)$temp[0];
            }
            $map->name = trim($temp[6]);
            $map->meta = Json::encode($temp);
            if ($map->save()) {
                Console::output('Successfully saved map '.$map->map_id);
            } else {
                Console::error('Monster '.$map->map_id.' failed.');
            }
            $currentLine++;
        }
        fclose($fp);
    }

    /**
     * Import A3DATA.xls
     */
    public function actionMonsterDrop()
    {
        if ($this->path == null) {
            $this->path =  Console::prompt('Please input the path of the file to import:', ['required' => true]);
        }
        if (!file_exists($this->path)) {
            Console::error('File does not exists or you do not have the permission to access it!');
            return;
        }
        if ($this->clearPrevious) {
            MonsterItem::deleteAll();
        }
        $inputFileType = PHPExcel_IOFactory::identify($this->path);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($this->path);
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $currentLine = 0;
        foreach ($objWorksheet->getRowIterator() as $row) {
            if ($currentLine == 0) {
                $currentLine++;
                continue;
            }
            $currentLine++;
            $i = 1;
            $skip = false;
            $dropRate = $monsterId = $itemId = null;
            foreach ($row->getCellIterator() as $cell) {
                $cellValue = trim($cell->getCalculatedValue());
                if ($i == 1 && $cellValue == 65535) {
                    $skip = true;
                    break;
                }
                switch ($i) {
                    case 1:
                        $itemId = (int)$cellValue;
                        break;
                    case 2:
                        $dropRate = (int)$cellValue;
                        break;
                    case 3:
                        $monsterId = (int)$cellValue;
                        break;
                }
                $i++;
            }
            if ($skip) {
                continue;
            }
            if ($dropRate == null || $monsterId == null || $itemId == null) {
                continue;
            }
            $md = MonsterItem::find()
                ->where([
                    'monster_id' => $monsterId,
                    'item_id' => $itemId
                ])
                ->one();
            if ($md == null) {
                $md = new MonsterItem([
                    'monster_id' => $monsterId,
                    'item_id' => $itemId
                ]);
            }
            $md->drop_rate = $dropRate;
            try {
                if ($md->save()) {
                    Console::output('Successfully saved '.$md->item->name.' drop for monster '.$md->monster->name);
                } else {
                    Console::error('Saving of drop '.$md->item_id. ' for monster '.$md->monster_id.' failed');
                }
            } catch (\Exception $e) {
                Console::error('Saving of drop '.$md->item_id. ' for monster '.$md->monster_id.' failed');
            }
        }
    }

    /**
     * Import *.n_ndt files from a folder
     */
    public function actionMapMonster()
    {
        echo 'Doesn\'t work as expected';
        return;
        if ($this->path == null) {
            $this->path =  Console::prompt('Please input the path of the folder from where to import:', ['required' => true]);
        }
        $this->path = rtrim($this->path, '/').'/';
        $maps = Map::find()
            ->where('map_id IS NOT NULL')
            ->orderBy('map_id')
            ->all();
        foreach ($maps as $map) {
            if (!file_exists($this->path.$map->map_id.'.n_ndt')) {
                continue;
            }
            $fp = fopen($this->path.$map->map_id.'.n_ndt', 'rb');
            $contents = fread($fp, filesize($this->path.$map->map_id.'.n_ndt'));
            try {
                $byteArray = unpack("cchars/nint*", $contents);
                for ($i = 0; $i < count($byteArray); $i = $i + 8) {
                    if (!isset($byteArray[$i])) {
                        continue;
                    }
                    if ($byteArray[$i] === 159 && $byteArray[$i + 1] === 1 &&
                        $byteArray[$i + 2] === 128 && $byteArray[$i + 3] === 128 &&
                        $byteArray[$i + 6] === 2 && $byteArray[$i + 7] === 106) {
                        break;
                    }
                    $monsterId = hexdec(dechex($byteArray[$i + 1]).dechex($byteArray[$i]));
                    $mm = MapMonster::find()
                        ->where([
                            'monster_id' => $monsterId,
                            'map_id' => $map->map_id
                        ])
                        ->one();
                    if ($mm == null) {
                        $mm = new MapMonster([
                            'monster_id' => $monsterId,
                            'map_id' => $map->map_id
                        ]);
                    }
                    try {
                        if ($mm->save()) {
                            Console::output('Successfully saved '.$mm->monster->name.' monster for map '.$mm->map->name);
                        } else {
                            Console::error('Saving of monster '.$mm->monster_id. ' for map '.$mm->map_id.' failed');
                        }
                    } catch (\Exception $e) {
                        Console::error('Saving of monster '.$mm->monster_id. ' for map '.$mm->map_id.' failed');
                    }
                    break;
                }
            } catch (\Exception $e) {
                Console::error('Saving of monsters for map '.$map->map_id. ' failed with exception '.$e->getMessage());
            }
            fclose($fp);
        }
    }
}
