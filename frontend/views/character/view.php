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