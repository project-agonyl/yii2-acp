<?php

/* @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $searchModel backend\modules\database\models\EshopDeliverySearch
 */

use kartik\grid\GridView;
use kartik\icons\Icon;

$this->title = 'E-shop Deliveries';
?>
<?= GridView::widget([
    'id' => 'delivery-grid',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $searchModel->columnMap,
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
        'heading' => Icon::show('shopping-cart').'E-shop Deliveries',
    ],
    'persistResize' => false,
]); ?>