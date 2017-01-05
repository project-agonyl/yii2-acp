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

    public static function safeBase64Encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public static function safeBase64Decode($data) {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
}
