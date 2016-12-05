<?php

/* @var $this yii\web\View
 * @var $model frontend\models\OldAccountTransfer
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Transfer Request';
?>
<h1>Transfer old account request</h1>
<br>
<div class="row">
    <div class="col-sm-4 col-sm-offset-2">
        <?php $form = ActiveForm::begin([
            'id' => 'transfer-form'
        ]); ?>
        <?= $form->field($model, 'old_account')->textInput(['autofocus' => true])->label('Old Account Username'); ?>
        <button class="btn btn-success" type="submit">Request Transfer</button>
        <a href="<?= Url::to(['/']);?>" class="btn btn-danger">Cancel</a>
        <?php ActiveForm::end(); ?>
    </div>
</div>
