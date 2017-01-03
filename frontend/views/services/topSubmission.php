<?php
use common\models\Charac0;
use kartik\grid\GridView;
use kartik\icons\Icon;

$this->title = 'Top 10 Pumpkin Submitters';
?>
<?= GridView::widget([
    'id' => 'char-grid',
    'dataProvider' => $dataProvider,
    'columns' => [
        'serial' => [
            'class' => '\kartik\grid\SerialColumn'
        ],
        'player' => [
            'label' => 'Player',
            'value' => function ($model) {
                $topChar = Charac0::find()
                    ->where([
                        'c_status' => Charac0::STATUS_ACTIVE,
                        'c_sheadera' => $model->account
                    ])
                    ->orderBy([
                        'rb' => SORT_DESC,
                        'CAST(c_sheaderc AS int)' => SORT_DESC,
                        'd_udate' => SORT_DESC
                    ])
                    ->one();
                return $topChar->c_id;
            }
        ],
        'count' => [
            'label' => 'Submission Count',
            'attribute' => 'points'
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
    'panel' => [
        'type' => GridView::TYPE_INFO,
        'heading' => Icon::show('share').'Top 10 Pumpkin Submitters',
    ],
    'persistResize' => false,
    'summary' => false
]); ?>