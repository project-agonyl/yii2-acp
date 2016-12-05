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
<h1>Account Details <span class="pull-right"><?= Html::a('Back', Url::previous(), ['class' => 'btn btn-info']);?></span></h1>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name' => [
            'attribute' => 'c_id',
            'label' => 'Name'
        ],
        'email' => [
            'attribute' => 'c_headerb',
            'label' => 'E-mail'
        ],
        'wallet_cash' => [
            'attribute' => 'cash',
            'label' => 'Flamez Cash'
        ],
        'wallet_coins' => [
            'attribute' => 'coin',
            'label' => 'Flamez Coins'
        ],
        'created' => [
            'attribute' => 'd_cdate',
            'label' => 'Created',
            'format' => 'datetime'
        ],
        'updated' => [
            'attribute' => 'd_udate',
            'label' => 'Last Updated',
            'format' => 'datetime'
        ],
    ],
]); ?>
<div class="row">
    <div class="col-sm-6">
        <table class="table table-striped table-bordered detail-view">
            <legend>Storage</legend>
            <thead>
            <tr>
                <th>Slot</th>
                <th>Item</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model->parsedStorage as $slot => $item): ?>
                <tr>
                    <td><?= $slot + 1; ?></td>
                    <td><?= ArrayHelper::getValue($item, 'full_item_name'); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= Html::a('Back', Url::previous(), ['class' => 'btn btn-info']);?>
