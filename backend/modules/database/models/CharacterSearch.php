<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 20-11-2016
 * Time: 13:32
 */

namespace backend\modules\database\models;

use common\models\Charac0;
use kartik\icons\Icon;
use Yii;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\helpers\Url;

class CharacterSearch extends Charac0
{
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
                'c_status' => Charac0::STATUS_ACTIVE
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
        $this->load($params);
        $query->andFilterWhere(['and',
            ['LIKE', 'lower(c_id)', strtolower($this->c_id)],
            ['LIKE', 'lower(c_sheadera)', strtolower($this->c_sheadera)],
            ['LIKE', 'lower(c_sheaderb)', strtolower($this->c_sheaderb)],
            ['LIKE', 'lower(c_sheaderc)', strtolower($this->c_sheaderc)],
            ['LIKE', 'lower(rb)', strtolower($this->rb)]
        ]);
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
            'account' => [
                'attribute' => 'c_sheadera',
                'label' => 'Account'
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
                            Url::to(['account/transfer-cash', 'id' => trim($model->c_sheadera)]),
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
                            Url::to(['account/transfer-coin', 'id' => trim($model->c_sheadera)]),
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
