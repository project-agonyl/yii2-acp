<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 20-11-2016
 * Time: 13:32
 */

namespace backend\modules\database\models;

use common\models\Charac0;
use common\models\EshopOrder;
use kartik\icons\Icon;
use Yii;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\helpers\Url;

class EshopDeliverySearch extends Charac0
{
    public $pageSize = 10;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account', 'delivered_to', 'value']
                , 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'search' => ['account', 'delivered_to', 'value']
        ];
    }

    public function search($params)
    {
        $query = EshopOrder::find()
            ->where([
                'is_delivered' => true
            ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id',
            'pagination' => [
                'pageSize' => $this->pageSize,
                'validatePage' => false
            ],
            'sort' => $this->sortObject()
        ]);
        $this->load($params, '');
        return $dataProvider;
    }

    public function getColumnMap()
    {
        return [
            'id',
            'account',
            'character' => [
                'attribute' => 'delivered_to',
                'label' => 'Character'
            ],
            'Value' => [
                'attribute' => 'current_value',
                'label' => 'Value',
                'value' => function ($model) {
                    return $model->current_value.' Flamez '.$model->currencyType;
                }
            ],
            'items' => [
                'attribute' => 'itemCount',
                'label' => 'Items'
            ],
            'updated' => [
                'attribute' => 'updated_at',
                'label' => 'Delivered At',
                'format' => 'datetime'
            ],
            'actions' => [
                'header' => 'Actions',
                'class' => '\kartik\grid\ActionColumn',
                'template' => '{view}'
            ]
        ];
    }

    protected function sortObject()
    {
        return [
            'attributes' => [
                'id' => [
                    'asc' => [new Expression('CAST(id AS int) ASC')],
                    'desc' => [new Expression('CAST(id AS int) DESC')],
                    'default' => SORT_DESC,
                    'label' => 'ID',
                ],
                'current_value' => [
                    'asc' => [new Expression('CAST(current_value AS int) ASC')],
                    'desc' => [new Expression('CAST(current_value AS int) DESC')],
                    'default' => SORT_DESC,
                    'label' => 'ID',
                ],
                'account' => [
                    'asc' => [new Expression('account ASC')],
                    'desc' => [new Expression('account DESC')],
                    'default' => SORT_ASC,
                    'label' => 'Account',
                ],
                'delivered_to' => [
                    'asc' => [new Expression('delivered_to ASC')],
                    'desc' => [new Expression('delivered_to DESC')],
                    'default' => SORT_ASC,
                    'label' => 'Character',
                ],
                'updated_at' => [
                    'asc' => [new Expression('updated_at ASC')],
                    'desc' => [new Expression('updated_at DESC')],
                    'default' => SORT_DESC,
                    'label' => 'Delivered',
                ]
            ],
            'defaultOrder' => [
                'updated_at' => SORT_DESC
            ]
        ];
    }
}
