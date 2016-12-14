<?php

/* @var $this yii\web\View
 * @var $model backend\modules\database\models\BundleForm
 */
use common\models\Item;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'E-shop bundle '.$model->id.' Details';
?>
<div class="row">
    <div class="col-sm-12">
        <div class="col-sm-4">
        <?= Html::dropDownList('item', null,
            ArrayHelper::map(Item::find()->where('id IS NOT NULL')->orderBy('name')->all(), 'item_id', 'name'),
            [
                'prompt' => '-- Select Item --',
                'class' => 'form-control',
                'id' => 'item'
            ]); ?>
        </div>
        <div class="col-sm-3">
            <?= Html::a(Icon::show('plus-circle').'Add', '#', ['data-url' => Url::to(['add-to-bundle', 'id' => $model->id]), 'class' => 'btn btn-success', 'data-pjax' => 0, 'data-toggle' => 'tooltip', 'title' => 'Add Item', 'id' => 'add-item-btn']); ?>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12">
        <?= GridView::widget([
            'id' => 'bundle-grid',
            'dataProvider' => $dataProvider,
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
                'heading' => Icon::show('shopping-basket').'E-shop Bundle '.$model->name.' Items',
            ],
            'persistResize' => false,
        ]); ?>
    </div>
</div>
<?= Html::a('Back', Url::previous(), ['class' => 'btn btn-info']);?>
