<?php

namespace common\models;

use Yii;
use \common\models\base\Charloginlog as BaseCharloginlog;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "charloginlog".
 */
class Charloginlog extends BaseCharloginlog
{
    public function behaviors()
    {
        return [];
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

    public static function onlinePlayerCount()
    {
        return self::find()
            ->where('c_id IS NOT NULL')
            ->count();
    }

    public function getTypeString()
    {
        switch ((int)$this->class) {
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

    public function getNationString()
    {
        switch ((int)$this->Nation) {
            case 1:
                $nation = 'Quanato';
                break;
            default:
                $nation = 'Temoz';
                break;
        }
        return $nation;
    }
}
