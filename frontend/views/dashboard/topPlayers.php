<?php
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Top 50 Players';
?>
<?= GridView::widget([
    'id' => 'char-grid',
    'dataProvider' => $characterDataProvider,
    'columns' => $characterSearchModel->columnMap,
    'containerOptions'=>['style'=>'overflow: auto'],
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'bordered' => true,
    'responsive' => true,
    'pjax' => true,
    'toolbar' => false,
    'export' => false,
    'panel'=>[
        'type' => GridView::TYPE_INFO,
        'heading' => Icon::show('users').'Top 50 Players',
    ],
    'persistResize' => false,
    'summary' => false
]); ?>