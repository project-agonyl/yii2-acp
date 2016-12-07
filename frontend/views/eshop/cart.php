<?php

/* @var $this yii\web\View
 * @var $cart frontend\models\Cart
 */
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = 'E-shop Checkout';
?>
<div class="row">
    <div class="col-sm-12">
        <h2>E-shop Checkout <span class="pull-right"><?= Html::a(Icon::show('arrow-circle-left').'Back', Url::to(['/eshop']), ['class' => 'btn btn-danger']);?></span></h2>
        <?= GridView::widget([
            'id' => 'cart-grid',
            'showPageSummary' => true,
            'dataProvider' => $cart->itemDataProvider,
            'columns' => [
                'serial' => [
                    'class' => '\kartik\grid\SerialColumn'
                ],
                'name' => [
                    'label' => 'Item',
                    'attribute' => 'eshopItem.display_name'
                ],
                'quantity' => [
                    'attribute' => 'quantity',
                    'pageSummary' => 'Total',
                    'pageSummaryOptions' => ['class'=>'text-right text-warning']
                ],
                'coin' => [
                    'label' => 'Flamez Coins',
                    'attribute' => 'eshopItem.coin',
                    'pageSummary' => true,
                    'pageSummaryFunc' => GridView::F_SUM,
                    'value' => function ($model) {
                        return ($model->eshopItem->coin != -1)?$model->eshopItem->coin*$model->quantity:'N/A';
                    }
                ],
                'cash' => [
                    'label' => 'Flamez Cash',
                    'attribute' => 'eshopItem.cash',
                    'pageSummary' => true,
                    'pageSummaryFunc' => GridView::F_SUM,
                    'value' => function ($model) {
                        return ($model->eshopItem->cash != -1)?$model->eshopItem->cash*$model->quantity:'N/A';
                    }
                ],
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
                                    'data-url' => Url::to(['add-to-cart']),
                                    'data-toggle' => "tooltip",
                                    'title' => 'Increase Count',
                                    'data-item' => $model->eshop_item_id,
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
                                    'data-url' => Url::to(['remove-from-cart']),
                                    'data-toggle' => "tooltip",
                                    'title' => 'Decrease Count',
                                    'data-item' => $model->eshop_item_id,
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
                                    'data-url' => Url::to(['remove-from-cart']),
                                    'data-toggle' => "tooltip",
                                    'title' => 'Remove',
                                    'data-item' => $model->eshop_item_id,
                                    'data-pjax' => 0
                                ]
                            );
                        },
                    ]
                ]
            ],
            'containerOptions'=>['style'=>'overflow: auto'],
            'headerRowOptions'=>['class'=>'kartik-sheet-style'],
            'filterRowOptions'=>['class'=>'kartik-sheet-style'],
            'bordered' => true,
            'responsive' => true,
            'pjax' => true,
            'toolbar' => false,
            'export' => false,
            'panel'=>[
                'type' => GridView::TYPE_PRIMARY,
                'heading' => Icon::show('shopping-cart').'Shopping Cart',
            ],
            'persistResize' => false,
            'summary' => false
        ]); ?>
    </div>
</div>
