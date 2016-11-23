<?php

/* @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $searchModel backend\modules\database\models\CharacterSearch
 */

use kartik\grid\GridView;
use kartik\icons\Icon;

$this->title = 'E-mails';
?>
<?= GridView::widget([
    'id' => 'email-grid',
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
        'heading' => Icon::show('envelope').'E-mails',
    ],
    'persistResize' => false,
]); ?>