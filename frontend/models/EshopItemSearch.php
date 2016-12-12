<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 20-11-2016
 * Time: 13:32
 */

namespace frontend\models;

use common\models\Charac0;
use common\models\EshopItem;
use kartik\icons\Icon;
use Yii;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\helpers\Url;

class EshopItemSearch extends EshopItem
{
    public $account;
    public $pageSize = 12;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'display_name', 'description', 'category']
                , 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'search' => ['item_id', 'display_name', 'description', 'category']
        ];
    }

    public function search($params)
    {
        $query = EshopItem::find()
            ->where([
                'is_deleted' => false
            ])
            ->andWhere('cash > -1 OR coin > -1')
            ->orderBy('display_name');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id',
            'pagination' => [
                'pageSize' => $this->pageSize,
                'validatePage' => false
            ]
        ]);
        $this->load($params, '');
        $query->andFilterWhere(['category' => $this->category]);
        return $dataProvider;
    }

    public static function AvailableCategoryNavs()
    {
        $categories = (new Query())
            ->select(['category'])
            ->from('eshop_item')
            ->where([
                'is_deleted' => false
            ])
            ->andWhere('cash > -1 OR coin > -1')
            ->groupBy('category')
            ->all();
        $items = [];
        $categoryList = self::getCategoryList();
        foreach ($categories as $row) {
            $items[$row['category']] = Inflector::pluralize(ArrayHelper::getValue($categoryList, $row['category'], 'Item'));
        }
        return $items;
    }
}
