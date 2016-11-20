<?php

/* @var $this yii\web\View
 * @var $model backend\modules\database\models\TransferCash
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Transfer Cash';
?>
<h1>Transfer wallet cash to account <span class="text-info"><?= Html::encode(trim($model->toModel->c_id)); ?></span></h1>
<br>
<div class="row">
    <div class="col-sm-4">
        <?php $form = ActiveForm::begin([
            'id' => 'transfer-form'
        ]); ?>
            <?= $form->field($model, 'toTransfer')->textInput(['autofocus' => true])->label('Amount'); ?>
            <button class="btn btn-success" type="submit">Transfer</button>
            <a href="<?= Url::previous();?>" class="btn btn-danger">Cancel</a>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-sm-4 col-sm-offset-2">
        <h3>Your balance: <b><?= $model->fromModel->cash; ?></b></h3>
    </div>
</div>
