<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 20-11-2016
 * Time: 13:32
 */

namespace frontend\models;

use common\models\Charac0;
use kartik\icons\Icon;
use Yii;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\helpers\Url;

class CharacterSearch extends Charac0
{
    public $account;
    public $pageSize = 10;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_id', 'c_sheadera', 'c_sheaderb', 'c_sheaderc', 'c_status', 'rb']
                , 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'search' => ['c_id', 'c_sheadera', 'c_sheaderb', 'c_sheaderc', 'c_status', 'rb']
        ];
    }

    public function search($params)
    {
        $query = Charac0::find()
            ->where([
                'c_status' => Charac0::STATUS_ACTIVE,
                'c_sheadera' => $this->account
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
            'serial' => [
                'class' => '\kartik\grid\SerialColumn'
            ],
            'name' => [
                'attribute' => 'c_id',
                'label' => 'Name'
            ],
            'type' => [
                'attribute' => 'c_sheaderb',
                'label' => 'Type',
                'value' => function ($model) {
                    return $model->typeString;
                }
            ],
            'level' => [
                'attribute' => 'c_sheaderc',
                'label' => 'Level'
            ],
            'rb' => [
                'attribute' => 'rb',
                'label' => 'Rebirth'
            ],
            'woonz' => [
                'attribute' => 'c_headerc',
                'label' => 'Woonz'
            ],
            'actions' => [
                'header' => 'Actions',
                'class' => '\kartik\grid\ActionColumn',
                'template' => '{view} {offline-tp} {gift} {rb}',
                'buttons' => [
                    'offline-tp' => function ($url, $model) {
                        return Html::a(
                            Icon::show('plane'),
                            '#',
                            [
                                'class' => 'char-offline-tp black-text btn btn-default',
                                'data-url' => Url::to(['/character/offline-teleport', 'id' => $model->c_id]),
                                'data-toggle' => "tooltip",
                                'title' => 'Offline Teleport',
                                'data-pjax' => 0
                            ]
                        );
                    },
                    'view' => function ($url, $model) {
                        return Html::a(
                            Icon::show('eye'),
                            '#',
                            [
                                'class' => 'char-view inherit-color btn btn-default',
                                'data-url' => Url::to(['/character/view', 'id' => $model->c_id]),
                                'data-toggle' => "tooltip",
                                'title' => 'View Inventory and Wear',
                                'data-pjax' => 0
                            ]
                        );
                    },
                    'gift' => function ($url, $model) {
                        return Html::a(
                            Icon::show('gift'),
                            '#',
                            [
                                'class' => 'char-gift inherit-color btn btn-default',
                                'data-url' => Url::to(['/character/beginners-gift', 'id' => $model->c_id]),
                                'data-toggle' => "tooltip",
                                'title' => 'Beginner\'s Gift',
                                'data-pjax' => 0
                            ]
                        );
                    },
                    'rb' => function ($url, $model) {
                        return Html::a(
                            Icon::show('fast-forward'),
                            '#',
                            [
                                'class' => 'char-rb inherit-color btn btn-default',
                                'data-url' => Url::to(['/character/rebirth', 'id' => $model->c_id]),
                                'data-toggle' => "tooltip",
                                'title' => 'Rebirth',
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
                'c_sheaderc' => [
                    'asc' => [new Expression('CAST(c_sheaderc AS int) ASC')],
                    'desc' => [new Expression('CAST(c_sheaderc AS int) DESC')],
                    'default' => SORT_DESC,
                    'label' => 'Level',
                ],
                'c_sheaderb' => [
                    'asc' => [new Expression('CAST(c_sheaderb AS int) ASC')],
                    'desc' => [new Expression('CAST(c_sheaderb AS int) DESC')],
                    'default' => SORT_DESC,
                    'label' => 'Type',
                ],
                'c_headerc' => [
                    'asc' => [new Expression('CAST(c_headerc AS int) ASC')],
                    'desc' => [new Expression('CAST(c_headerc AS int) DESC')],
                    'default' => SORT_ASC,
                    'label' => 'Type',
                ],
                'rb' => [
                    'asc' => [new Expression('CAST(rb AS int) ASC')],
                    'desc' => [new Expression('CAST(rb AS int) DESC')],
                    'default' => SORT_DESC,
                    'label' => 'Rebirth',
                ],
                'c_id' => [
                    'asc' => [new Expression('c_id ASC')],
                    'desc' => [new Expression('c_id DESC')],
                    'default' => SORT_ASC,
                    'label' => 'Name',
                ],
                'c_sheadera' => [
                    'asc' => [new Expression('c_sheadera ASC')],
                    'desc' => [new Expression('c_sheadera DESC')],
                    'default' => SORT_ASC,
                    'label' => 'Account',
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
