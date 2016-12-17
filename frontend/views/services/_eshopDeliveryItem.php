<?php

/* @var $this yii\web\View
 * @var $model common\models\EshopOrder
 */
?>
<div class="panel panel-<?= ($model->currencyType == 'coins')?'info':'primary'; ?>">
    <div class="panel-heading" role="tab" id="heading<?= $model->id; ?>">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $model->id; ?>" aria-controls="collapse<?= $model->id; ?>" data-pjax="0">
                <?= $model->itemCount; ?> item(s) worth <?= $model->current_value; ?> Flamez <?= $model->currencyType; ?> delivered to <?= $model->delivered_to; ?> on <?= date(DATE_RFC822, strtotime($model->updated_at)); ?>
            </a>
        </h4>
    </div>
    <div id="collapse<?= $model->id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $model->id; ?>">
        <div class="panel-body">
            <div class="col-sm-8 col-sm-offset-1">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Count</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model->eshopOrderItems as $eshopOrderItem): ?>
                        <tr>
                            <td><?= $eshopOrderItem->eshopItem->display_name; ?></td>
                            <td><?= $eshopOrderItem->quantity; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>