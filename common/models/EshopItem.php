<?php

namespace common\models;

use Yii;
use \common\models\base\EshopItem as BaseEshopItem;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "eshop".
 */
class EshopItem extends BaseEshopItem
{
    const IMG_BASE_URL = '/img/item/';

    const CATEGORY_WARRIOR_ITEM = 1;
    const CATEGORY_HK_ITEM = 2;
    const CATEGORY_MAGE_ITEM = 3;
    const CATEGORY_ARCHER_ITEM = 4;
    const CATEGORY_CRAFTING_ITEM = 5;
    const CATEGORY_POTION = 6;
    const CATEGORY_JEWELLERY = 7;
    const CATEGORY_QUEST_ITEM = 8;
    const CATEGORY_SCROLL = 9;
    const CATEGORY_OTHER = 99;

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                [
                    'class' => TimestampBehavior::className(),
                    'value' => new Expression('CURRENT_TIMESTAMP')
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

    public static function getCategoryList()
    {
        return [
            self::CATEGORY_WARRIOR_ITEM => 'Warrior Item',
            self::CATEGORY_HK_ITEM => 'Holy Knight Item',
            self::CATEGORY_MAGE_ITEM => 'Mage Item',
            self::CATEGORY_ARCHER_ITEM => 'Archer Item',
            self::CATEGORY_CRAFTING_ITEM => 'Crafting Item',
            self::CATEGORY_POTION => 'Potion',
            self::CATEGORY_JEWELLERY => 'Jewellery',
            self::CATEGORY_QUEST_ITEM => 'Quest Item',
            self::CATEGORY_SCROLL => 'Scroll',
            self::CATEGORY_OTHER => 'Other'
        ];
    }

    public function getCategoryString()
    {
        return ArrayHelper::getValue(self::getCategoryList(), $this->category, 'Other');
    }

    public function getImageUrl()
    {
        return self::IMG_BASE_URL.$this->item_id.'.jpg';
    }
}
