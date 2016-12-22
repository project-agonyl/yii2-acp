<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 26-11-2016
 * Time: 19:59
 */

namespace backend\modules\admin\models;

use Yii;
use common\models\EshopItem;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

class EshopSearch extends EshopItem
{
    public $pageSize = 10;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'item_id', 'display_name', 'cash', 'coin', 'credit']
                , 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'search' => ['id', 'item_id', 'display_name', 'cash', 'coin', 'credit']
        ];
    }

    public function search($params)
    {
        $query = EshopItem::find()
            ->where(['is_deleted' => false]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id',
            'pagination' => [
                'pageSize' => $this->pageSize,
                'validatePage' => false
            ],
            'sort' => $this->sortObject()
        ]);
        $this->load($params);
        $query->andFilterWhere(['and',
            ['LIKE', 'lower(id)', strtolower($this->id)],
            ['LIKE', 'lower(item_id)', strtolower($this->item_id)],
            ['LIKE', 'lower(display_name)', strtolower($this->display_name)],
            ['LIKE', 'lower(cash)', strtolower($this->cash)],
            ['LIKE', 'lower(coin)', strtolower($this->coin)],
            ['LIKE', 'lower(credit)', strtolower($this->credit)]
        ]);
        return $dataProvider;
    }

    public function getColumnMap()
    {
        return [
            'id',
            'category' => [
                'attribute' => 'category',
                'label' => 'Category',
                'value' => function ($model) {
                    return $model->categoryString;
                }
            ],
            'display_name',
            'coin',
            'cash',
            'credit',
            'updated_at',
            'actions' => [
                'header' => 'Actions',
                'class' => '\kartik\grid\ActionColumn',
                'template' => '{update} {view}'
            ]
        ];
    }

    protected function sortObject()
    {
        return [
            'attributes' => [
                'id' => [
                    'asc' => [new Expression('id ASC')],
                    'desc' => [new Expression('id DESC')],
                    'default' => SORT_ASC,
                    'label' => 'Name',
                ],
                'coin' => [
                    'asc' => [new Expression('coin ASC')],
                    'desc' => [new Expression('coin DESC')],
                    'default' => SORT_ASC,
                    'label' => 'Item',
                ],
                'cash' => [
                    'asc' => [new Expression('cash ASC')],
                    'desc' => [new Expression('cash DESC')],
                    'default' => SORT_ASC,
                    'label' => 'Item',
                ],
                'credit' => [
                    'asc' => [new Expression('credit ASC')],
                    'desc' => [new Expression('credit DESC')],
                    'default' => SORT_ASC,
                    'label' => 'Item',
                ],
                'category' => [
                    'asc' => [new Expression('category ASC')],
                    'desc' => [new Expression('category DESC')],
                    'default' => SORT_DESC,
                    'label' => 'Category',
                ],
                'updated_at' => [
                    'asc' => [new Expression('updated_at ASC')],
                    'desc' => [new Expression('updated_at DESC')],
                    'default' => SORT_DESC,
                    'label' => 'Updated',
                ]
            ],
            'defaultOrder' => [
                'updated_at' => SORT_DESC
            ]
        ];
    }
}
