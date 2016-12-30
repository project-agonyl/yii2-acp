<?php

/* @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $searchModel frontend\models\MonsterItemSearch
 */
use kartik\grid\GridView;
use kartik\icons\Icon;

$this->title = 'Item Drops';
?>
<div class="row">
    <div class="col-sm-8">
        <?= GridView::widget([
            'id' => 'account-grid',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $searchModel->columnMap,
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
            'panel'=>[
                'type' => GridView::TYPE_PRIMARY,
                'heading' => Icon::show('tint').'Item Drop Search',
            ],
            'persistResize' => false,
            'summary' => false
        ]); ?>
    </div>
</div>
