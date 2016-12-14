<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 14-12-2016
 * Time: 22:02
 */

namespace backend\modules\database\models;

use kartik\icons\Icon;
use Yii;
use common\models\BundleItem;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class BundleItemSearch extends BundleItem
{
    public $pageSize = 10;

    public function search($params)
    {
        $query = BundleItem::find()
            ->where([
                'is_deleted' => false,
                'bundle_id' => $this->bundle_id
            ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id',
            'pagination' => [
                'pageSize' => $this->pageSize,
                'validatePage' => false
            ],
            'sort' => false
        ]);
        $this->load($params, '');
        return $dataProvider;
    }

    public function getColumnMap()
    {
        return [
            'id',
            'name' => ['attribute' => 'item.name', 'label' => 'Name'],
            'quantity',
            'actions' => [
                'header' => 'Actions',
                'class' => '\kartik\grid\ActionColumn',
                'template' => '{incr} {decr} {rem}',
                'buttons' => [
                    'incr' => function ($url, $model) {
                        return Html::a(
                            Icon::show('plus-circle'),
                            '#',
                            [
                                'class' => 'incr-item black-text btn btn-success',
                                'data-url' => Url::to(['add-to-bundle', 'id' => $model->bundle_id]),
                                'data-toggle' => "tooltip",
                                'title' => 'Increase Count',
                                'data-item' => $model->item_id,
                                'data-pjax' => 0
                            ]
                        );
                    },
                    'decr' => function ($url, $model) {
                        return Html::a(
                            Icon::show('minus-circle'),
                            '#',
                            [
                                'class' => 'decr-item black-text btn btn-warning',
                                'data-url' => Url::to(['remove-from-bundle', 'id' => $model->bundle_id]),
                                'data-toggle' => "tooltip",
                                'title' => 'Decrease Count',
                                'data-item' => $model->item_id,
                                'data-pjax' => 0
                            ]
                        );
                    },
                    'rem' => function ($url, $model) {
                        return Html::a(
                            Icon::show('times-circle'),
                            '#',
                            [
                                'class' => 'rem-item black-text btn btn-danger',
                                'data-url' => Url::to(['remove-from-bundle', 'id' => $model->bundle_id]),
                                'data-toggle' => "tooltip",
                                'title' => 'Remove',
                                'data-item' => $model->item_id,
                                'data-pjax' => 0
                            ]
                        );
                    },
                ]
            ]
        ];
    }
}
