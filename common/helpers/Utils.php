<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 06-12-2016
 * Time: 01:01
 */

namespace common\helpers;


use common\models\BuyUniqCode;
use common\models\DeliveryTable;

class Utils
{
    public static function ObfuscateEmail($email)
    {
        $em = explode("@", $email);
        $name = implode(array_slice($em, 0, count($em) - 1), '@');
        $len = floor(strlen($name) / 2);
        return substr($name, 0, $len) . str_repeat('*', $len) . "@" . end($em);
    }

    public static function GenerateUniqueItemCode()
    {
        $uniqueCode = 0;
        while(true)
        {
            $uniqueCode = (string)mt_rand(100000, 999999);
            $count = BuyUniqCode::find()
                ->where([
                    'unique_code' => $uniqueCode
                ])
                ->count();
            if($count == 0) {
                break;
            }
        }
        return (string)$uniqueCode;
    }

    public static function CurrentDateTime()
    {
        date_default_timezone_set("Asia/Calcutta");
        return date('Y-m-d H:i:s');
    }
}
