<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 26-11-2016
 * Time: 22:36
 */

namespace backend\modules\admin\models;

use Yii;
use yii\helpers\ArrayHelper;

class EshopItem extends \common\models\EshopItem
{
    public function init()
    {
        parent::init();
        if ($this->category == null) {
            $this->category = self::CATEGORY_OTHER;
        }
        if ($this->cash == null) {
            $this->cash = -1;
        }
        if ($this->coin == null) {
            $this->coin = -1;
        }
        if ($this->credit == null) {
            $this->credit = -1;
        }
    }

    public function scenarios()
    {
        return ArrayHelper::merge(
            parent::scenarios(),
            [
                'create' => ['item_id' , 'bundle_id', 'display_name' , 'coin', 'cash', 'credit', 'category', 'description', 'image_url'],
                'update' => ['item_id' , 'bundle_id', 'display_name' , 'coin', 'cash', 'credit', 'category', 'description', 'image_url']
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                [['item_id' , 'display_name' , 'coin', 'cash', 'credit', 'category'], 'required'],
                [
                    ['coin', 'cash', 'credit'],
                    'number',
                    'min' => -1,
                    'tooSmall' => 'Price cannot be less than -1'
                ],
                ['category', 'in', 'range' => array_keys(self::getCategoryList())]
            ]
        );
    }
}
