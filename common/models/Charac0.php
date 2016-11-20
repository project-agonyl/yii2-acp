<?php

namespace common\models;

use Yii;
use \common\models\base\Charac0 as BaseCharac0;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "charac0".
 */
class Charac0 extends BaseCharac0
{
    const STATUS_ACTIVE = 'A';

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
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
                $type = 'Mage';
                break;
            case 2:
                $type = 'Holy Knight';
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
}
