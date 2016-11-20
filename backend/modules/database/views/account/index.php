<?php

/* @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $searchModel backend\modules\database\models\CharacterSearch
 */

use kartik\grid\GridView;
use kartik\icons\Icon;

$this->title = 'Accounts';
?>
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
        'heading' => Icon::show('users').'Active Accounts',
    ],
    'persistResize' => false,
]); ?>