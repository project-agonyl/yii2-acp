<?php

/* @var $this yii\web\View
 * @var $cart frontend\models\Cart
 */
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'E-shop Checkout';
?>
<div class="row">
    <div class="col-sm-12">
        <div class="col-md-9">
            <legend>E-shop Checkout</legend>
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
                    'pageSummaryOptions' => ['class'=>'text-right text-black']
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
            <h2>
                <?= Html::a(Icon::show('arrow-circle-left').'Shop More', Url::to(['/eshop']), ['class' => 'btn btn-info']);?>
                <span class="pull-right">
                    <?= Html::button(
                        Icon::show('truck').'Buy with Coins',
                        [
                            'class' => 'btn btn-primary buy-btn',
                            'id' => 'coin-buy-btn',
                            'data-purl' => Url::to(['can-buy-using-coins']),
                            'data-curl' => Url::to(['list-deliverable-characters']),
                            'data-burl' => Url::to(['deliver-using-coins']),
                            'data-loading-text' => 'Processing...'
                        ]
                    );?>
                    <?= Html::button(
                        Icon::show('truck').'Buy with Cash',
                        [
                            'class' => 'btn btn-primary buy-btn',
                            'id' => 'cash-buy-btn',
                            'data-purl' => Url::to(['can-buy-using-cash']),
                            'data-curl' => Url::to(['list-deliverable-characters']),
                            'data-burl' => Url::to(['deliver-using-cash']),
                            'data-loading-text' => 'Processing...'
                        ]
                    );?>
                </span>
            </h2>
        </div>
        <div class="col-md-3">
            <legend>Account Balance</legend>
            <?php Pjax::begin([
                'id' => "balance-pjax",
                'enablePushState' => false,
                'timeout' => 4000,
            ]); ?>
            <div class="row">
                <div class="col-sm-12">
                    <h4>Flamez Coins <span class="badge"><?= $cart->accountModel->coin; ?></span></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h4>Flamez Cash <span class="badge"><?= $cart->accountModel->cash; ?></span></h4>
                </div>
            </div>
            <?php Pjax::end(); ?>
            <h2>
                <span class="pull-right">
                    <?= Html::button(
                        Icon::show('truck').'Buy with Coins',
                        [
                            'class' => 'btn btn-primary buy-btn btn-sm',
                            'data-purl' => Url::to(['can-buy-using-coins']),
                            'data-curl' => Url::to(['list-deliverable-characters']),
                            'data-burl' => Url::to(['deliver-using-coins']),
                            'data-loading-text' => 'Processing...'
                        ]
                    );?>
                    <?= Html::button(
                        Icon::show('truck').'Buy with Cash',
                        [
                            'class' => 'btn btn-primary buy-btn btn-sm',
                            'data-purl' => Url::to(['can-buy-using-cash']),
                            'data-curl' => Url::to(['list-deliverable-characters']),
                            'data-burl' => Url::to(['deliver-using-cash']),
                            'data-loading-text' => 'Processing...'
                        ]
                    );?>
                </span>
            </h2>
        </div>
    </div>
</div>
