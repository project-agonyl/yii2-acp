<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 20-11-2016
 * Time: 13:32
 */

namespace backend\modules\database\models;

use common\models\Account;
use kartik\icons\Icon;
use Yii;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\helpers\Url;

class AccountSearch extends Account
{
    public $pageSize = 10;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_id', 'c_headerb']
                , 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'search' => ['c_id', 'c_headerb']
        ];
    }

    public function search($params)
    {
        $query = Account::find()
            ->where('c_id IS NOT NULL');
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
            'serial' => [
                'class' => '\kartik\grid\SerialColumn'
            ],
            'name' => [
                'attribute' => 'c_id',
                'label' => 'Name'
            ],
            'email' => [
                'attribute' => 'c_headerb',
                'label' => 'E-mail'
            ],
            'wallet_cash' => [
                'attribute' => 'cash',
                'label' => 'Wallet Cash'
            ],
            'created' => [
                'attribute' => 'd_cdate',
                'label' => 'Created',
                'format' => 'datetime'
            ],
            'updated' => [
                'attribute' => 'd_udate',
                'label' => 'Last Updated',
                'format' => 'datetime'
            ],
            'actions' => [
                'header' => 'Actions',
                'class' => '\kartik\grid\ActionColumn',
                'template' => '{view} {add-credits} {add-coins}',
                'buttons' => [
                    'add-credits' => function ($url, $model) {
                        return Html::a(
                            Icon::show('plus'),
                            Url::to(['account/transfer-cash', 'id' => trim($model->c_id)]),
                            [
                                'data-toggle' => "tooltip",
                                'title' => 'Transfer wallet cash',
                                'data-pjax' => 0
                            ]
                        );
                    },
                    'add-coins' => function ($url, $model) {
                        return Html::a(
                            Icon::show('plus-circle'),
                            Url::to(['account/transfer-coin', 'id' => trim($model->c_id)]),
                            [
                                'data-toggle' => "tooltip",
                                'title' => 'Transfer wallet coin',
                                'data-pjax' => 0
                            ]
                        );
                    }
                ]
            ]
        ];
    }

    protected function sortObject()
    {
        return [
            'attributes' => [
                'c_id' => [
                    'asc' => [new Expression('c_id ASC')],
                    'desc' => [new Expression('c_id DESC')],
                    'default' => SORT_ASC,
                    'label' => 'Name',
                ],
                'c_headerb' => [
                    'asc' => [new Expression('c_headerb ASC')],
                    'desc' => [new Expression('c_headerb DESC')],
                    'default' => SORT_ASC,
                    'label' => 'Email',
                ],
                'd_cdate' => [
                    'asc' => [new Expression('d_cdate ASC')],
                    'desc' => [new Expression('d_cdate DESC')],
                    'default' => SORT_DESC,
                    'label' => 'Created',
                ],
                'd_udate' => [
                    'asc' => [new Expression('d_udate ASC')],
                    'desc' => [new Expression('d_udate DESC')],
                    'default' => SORT_DESC,
                    'label' => 'Updated',
                ]
            ],
            'defaultOrder' => [
                'd_udate' => SORT_DESC
            ]
        ];
    }
}
