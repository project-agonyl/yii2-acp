<?php

/* @var $this yii\web\View
 * @var $model common\models\EshopOrder
 */
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = 'E-shop delivery '.$model->id.' Details';
?>
<div class="row">
    <div class="col-sm-12">
        <h4>Details of e-shop items worth <?= $model->current_value; ?> Flamez <?= $model->currencyType; ?> delivered to <?= $model->delivered_to; ?><span class="pull-right"><?= Html::a('Back', Url::previous(), ['class' => 'btn btn-info']);?></span></h4>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12">
        <?= GridView::widget([
            'id' => 'delivered-items-grid',
            'dataProvider' => $dataProvider,
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
                'heading' => Icon::show('shopping-cart').'Delivered Items',
            ],
            'persistResize' => false,
            'summary' => false
        ]); ?>
    </div>
</div>
<?= Html::a('Back', Url::previous(), ['class' => 'btn btn-info']);?>
