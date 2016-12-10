<?php

/* @var $this yii\web\View
 * @var $model frontend\models\UpdatePassword
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Transfer Request';
?>
<h1>Update account password</h1>
<br>
<div class="row">
    <div class="col-sm-4 col-sm-offset-2">
        <?php $form = ActiveForm::begin([
            'id' => 'update-pass-form'
        ]); ?>
        <?= $form->field($model, 'oldPassword')->passwordInput(['autofocus' => true]); ?>
        <?= $form->field($model, 'newPassword')->passwordInput(); ?>
        <?= $form->field($model, 'repeatPassword')->passwordInput(); ?>
        <button class="btn btn-success" type="submit">Update</button>
        <a href="<?= Url::to(['/dashboard']);?>" class="btn btn-danger">Cancel</a>
        <?php ActiveForm::end(); ?>
    </div>
</div>
