<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 30-12-2016
 * Time: 21:37
 */

namespace frontend\models;

use common\models\Monster;
use kartik\grid\GridView;
use Yii;
use common\models\MonsterItem;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class MonsterItemSearch extends MonsterItem
{
    public $pageSize = 30;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['monster_id', 'item_id']
                , 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'search' => ['monster_id', 'item_id', 'description', 'category']
        ];
    }

    public function search($params)
    {
        $query = MonsterItem::find()
            ->joinWith(['monster', 'item'])
            ->where('monster.name NOT LIKE \'%?%\'')
            ->andWhere('item.name NOT LIKE \'%?%\'');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id',
            'pagination' => [
                'pageSize' => $this->pageSize,
                'validatePage' => false
            ],
            'sort' => false
        ]);
        $this->load($params);
        $query->andFilterWhere(['and',
            ['LIKE', 'lower(monster.name)', strtolower($this->monster_id)],
            ['LIKE', 'lower(item.name)', strtolower($this->item_id)]
        ]);
        return $dataProvider;
    }

    public function getColumnMap()
    {
        return [
            'serial' => [
                'class' => '\kartik\grid\SerialColumn'
            ],
            [
                'label' => 'Monster',
                'attribute' => 'monster_id',
                'value' => function ($model, $key, $index, $widget) {
                    return $model->monster->name;
                }
            ],
            [
                'label' => 'Item Drop',
                'attribute' => 'item_id',
                'value' => function ($model, $key, $index, $widget) {
                    return $model->item->name;
                }
            ]
        ];
    }
}
