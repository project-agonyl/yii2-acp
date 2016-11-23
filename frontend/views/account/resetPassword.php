<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use common\models\Charloginlog;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'ACP Login';
?>
<?php $form = ActiveForm::begin([
    'id' => 'reset-form',
    'options' => [ 'class' => 'form-signin']
]); ?>
<h2 class="form-signin-heading">Reset Password</h2>
<?= $form->field($model, 'password')->passwordInput(['autofocus' => true])->label('New Password') ?>
<?= $form->field($model, 'repeatPassword')->passwordInput() ?>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?><br>
        </div>
    </div>
    <div class="col-sm-6">
        <a class="btn btn-danger" href="<?= Url::to(['login']); ?>">Cancel</a>
    </div>
</div>
<?php ActiveForm::end(); ?>
