<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([
    'id' => 'forgot-form',
    'options' => [ 'class' => 'form-signin']
]); ?>
    <h4>A link will be sent to you registered email address to reset password</h4>
    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?><br>
            </div>
        </div>
        <div class="col-sm-6">
            <a class="btn btn-warning" href="<?= Url::to(['login']); ?>">Cancel</a>
        </div>
    </div>
<?php ActiveForm::end(); ?>
