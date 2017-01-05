<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'ACP Login';
?>
<?php $form = ActiveForm::begin([
    'id' => 'signup-form',
    'options' => [ 'class' => 'form-signin', 'style' => 'max-width: 600px']
]); ?>
    <h2 class="form-signin-heading">ACP Sign Up</h2>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'c_id')->textInput(['autofocus' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'c_headerb')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'c_headera')->passwordInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'repeatPassword')->passwordInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'name')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'phone')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'referredBy')->textInput(['disabled' => 'disabled']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <?= Html::submitButton('Sign Up', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
        </div>
        <div class="col-sm-6">
            <a class="btn btn-danger" href="<?= Url::to(['login']); ?>">Cancel</a>
        </div>
    </div>
<?php ActiveForm::end(); ?>