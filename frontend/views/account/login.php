<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'ACP Login';
?>
<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => [ 'class' => 'form-signin']
]); ?>
<h2 class="form-signin-heading">ACP Sign In</h2>
<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'rememberMe')->checkbox() ?>
<div class="form-group">
    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
</div>
<?php ActiveForm::end(); ?>
