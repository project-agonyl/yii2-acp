<?php

/* @var $this yii\web\View
 * @var $model common\models\Charac0
 * @var $formModel common\models\AccountInfo
 */
use common\models\AccountInfo;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->c_id.' Details';
?>
<h1>Account Details <span class="pull-right"><?= Html::a('Back', Url::previous(), ['class' => 'btn btn-info']);?></span></h1>
<div class="row">
    <div class="col-sm-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name' => [
                    'attribute' => 'c_id',
                    'label' => 'Username'
                ],
                'email' => [
                    'attribute' => 'c_headerb',
                    'label' => 'E-mail'
                ],
                'wallet_cash' => [
                    'attribute' => 'cash',
                    'label' => 'Flamez Cash'
                ],
                'wallet_coins' => [
                    'attribute' => 'coin',
                    'label' => 'Flamez Coins'
                ],
                'pumpkins' => [
                    'attribute' => 'pumpkinSubmissionCount',
                    'label' => 'Pumpkins Submitted'
                ]
            ],
        ]); ?>
    </div>
    <div class="col-sm-4">
        <legend>Update Details</legend>
        <?php $form = ActiveForm::begin([
            'id' => 'update-account-form'
        ]); ?>
        <?= $form->field($formModel, 'name')->textInput(['autofocus' => true]); ?>
        <?= $form->field($formModel, 'contact')->textInput()->label('Phone Number'); ?>
        <?= $form->field($formModel, 'theme')->dropDownList(AccountInfo::getThemes()); ?>
        <button class="btn btn-success" type="submit">Save</button>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-6">
        <table class="table table-striped table-bordered detail-view">
            <legend>Storage</legend>
            <thead>
            <tr>
                <th>Slot</th>
                <th>Item</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model->parsedStorage as $slot => $item): ?>
                <tr>
                    <td><?= $slot + 1; ?></td>
                    <td><?= ArrayHelper::getValue($item, 'full_item_name'); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="col-sm-6">
        <legend>Daily Quest Log</legend>
        <div class="panel-group">
        <?php foreach ($model->characters as $character): ?>
            <?= $this->render('_dailyQuestItem', ['model' => $character]); ?>
        <?php endforeach; ?>
        </div>
    </div>
</div>
<?= Html::a('Back', Url::to(['/']), ['class' => 'btn btn-info']);?>
