<?php

/* @var $this yii\web\View
 * @var $model common\models\Charac0
 */
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->c_id.' Details';
?>
<h1>Character Details <span class="pull-right"><?= Html::a('Back', Url::previous(), ['class' => 'btn btn-info']);?></span></h1>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name' => [
            'attribute' => 'c_id',
            'label' => 'Name'
        ],
        'account' => [
            'attribute' => 'c_sheadera',
            'label' => 'Account'
        ],
        'type' => [
            'attribute' => 'c_sheaderb',
            'label' => 'Type',
            'value' => $model->typeString
        ],
        'level' => [
            'attribute' => 'c_sheaderc',
            'label' => 'Level'
        ],
        'exp' => [
            'attribute' => 'exp',
            'label' => 'Experience'
        ],
        'rb' => [
            'attribute' => 'rb',
            'label' => 'Rebirth'
        ],
        'lore',
        'updated' => [
            'attribute' => 'd_udate',
            'label' => 'Last Updated',
            'format' => 'datetime'
        ]
    ],
]); ?>
<div class="row">
    <div class="col-sm-6">
        <table class="table table-striped table-bordered detail-view">
            <legend>Inventory</legend>
            <thead>
            <tr>
                <th>Slot</th>
                <th>Item</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model->parsedInventory as $slot => $item): ?>
                <tr>
                    <td><?= $slot + 1; ?></td>
                    <td><?= ArrayHelper::getValue($item, 'full_item_name'); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="col-sm-6">
        <table class="table table-striped table-bordered detail-view">
            <legend>Wear</legend>
            <thead>
            <tr>
                <th>#</th>
                <th>Item</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model->parsedWear as $num => $item): ?>
                <tr>
                    <td><?= $num + 1; ?></td>
                    <td><?= ArrayHelper::getValue($item, 'full_item_name'); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= Html::a('Back', Url::previous(), ['class' => 'btn btn-info']);?>
