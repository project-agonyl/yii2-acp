<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\virtual\LoginForm */

use common\models\Charloginlog;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

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
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?><br>
        </div>
    </div>
    <div class="col-sm-6">
        <a class="btn btn-success" href="<?= Url::to(['signup']); ?>">Sign Up</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <span style="font-weight:bold">
            Online Players : <span style="color:rgb(173, 52, 52);"><?= Charloginlog::onlinePlayerCount();?></span>
        </span>
    </div>
    <div class="col-sm-6">
        <a class="btn btn-warning" href="<?= Url::to(['forgot-password']); ?>">Forgot Password</a>
    </div>
</div>
<?php ActiveForm::end(); ?>
