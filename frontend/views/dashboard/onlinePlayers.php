<?php
use kartik\grid\GridView;
use kartik\icons\Icon;

$this->title = 'Online Players';
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
        'heading' => Icon::show('users').'Online Players',
    ],
    'persistResize' => false,
    'summary' => false
]); ?>