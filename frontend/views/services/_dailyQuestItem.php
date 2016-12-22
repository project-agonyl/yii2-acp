<?php
/**
 * @var $this yii\web\View
 * @var $model \common\models\Charac0
 */
use kartik\grid\GridView;

?>
<div class="panel panel-info">
    <div class="panel-heading" role="tab" id="heading<?= md5($model->c_id); ?>">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= md5($model->c_id); ?>" aria-controls="collapse<?= md5($model->c_id); ?>" data-pjax="0">
                <?= md5($model->c_id); ?>
            </a>
        </h4>
    </div>
    <div id="collapse<?= md5($model->c_id); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= md5($model->c_id); ?>">
        <div class="panel-body">
            <div class="col-sm-12">
                <?= GridView::widget([
                    'id' => 'daily-quest-grid-'.md5($model->c_id),
                    'showPageSummary' => true,
                    'dataProvider' => $model->dailyQuestDataProvider,
                    'columns' => [
                        'serial' => [
                            'class' => '\kartik\grid\SerialColumn'
                        ],
                        'taken' => [
                            'attribute' => 'taken_at',
                            'format' => 'date'
                        ],
                        'submitted' => [
                            'attribute' => 'submitted_at',
                            'format' => 'date'
                        ]
                    ],
                    'containerOptions'=>['style'=>'overflow: auto'],
                    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
                    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
                    'bordered' => true,
                    'responsive' => true,
                    'pjax' => true,
                    'pjaxSettings' => [
                        'options' => [
                            'enablePushState' => false
                        ]
                    ],
                    'toolbar' => false,
                    'export' => false,
                    'panel'=> false,
                    'persistResize' => false,
                    'summary' => false
                ]); ?>
            </div>
        </div>
    </div>
</div>