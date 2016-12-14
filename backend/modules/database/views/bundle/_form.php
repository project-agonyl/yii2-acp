<?php

/* @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model backend\modules\database\models\BundleForm
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
?>
<div class="row">
    <div class="col-sm-4">
        <?php $form = ActiveForm::begin([
            'id' => 'eshop-bundle-form'
        ]); ?>
        <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Bundle Name'); ?>
        <button class="btn btn-success" type="submit">Save</button>
        <a href="<?= Url::previous();?>" class="btn btn-danger">Cancel</a>
        <?php ActiveForm::end(); ?>
    </div>
</div>