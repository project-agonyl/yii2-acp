<?php

/* @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $searchModel backend\modules\database\models\TransferSearch
 */

use kartik\grid\GridView;
use kartik\icons\Icon;

$this->title = 'Transfer Old Account Requests';
?>
<?= GridView::widget([
    'id' => 'char-grid',
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
        'heading' => Icon::show('exchange').'Transfer Old Account Requests',
    ],
    'persistResize' => false,
]); ?>