<?php

/* @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $searchModel backend\modules\database\models\CharacterSearch
 */

use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'E-shop Bundles';
?>
<div class="row">
    <div class="col-sm-12">
        <?= Html::a(Icon::show('plus-circle').'Add', Url::to(['create']), ['class' => 'btn btn-success pull-right', 'data-pjax' => 0, 'data-toggle' => 'tooltip', 'title' => 'Add Item']); ?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12">
        <?= GridView::widget([
            'id' => 'bundle-grid',
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
                'heading' => Icon::show('shopping-basket').'E-shop Bundles',
            ],
            'persistResize' => false,
        ]); ?>
    </div>
</div>