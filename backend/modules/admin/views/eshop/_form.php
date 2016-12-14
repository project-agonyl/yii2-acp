<?php

/* @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model backend\modules\admin\models\EshopItem
 */

use backend\modules\admin\models\EshopItem;
use common\models\Bundle;
use common\models\Item;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$form = ActiveForm::begin([
    'id' => 'eshop-item-form',
    'options' => [ 'class' => 'form-signin', 'style' => 'max-width: 600px']
]); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'item_id')
                ->dropDownList(
                    ArrayHelper::map(Item::find()->where('id IS NOT NULL')->orderBy('name')->all(), 'item_id', 'name'),
                    [
                        'onchange' => "$('#eshopitem-display_name').val($('#eshopitem-item_id option:selected').text());$('#eshopitem-image_url').val('/img/item/' + $(this).val() + '.jpg')",
                        'prompt' => '-- Select Item --'
                    ]
                ); ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'bundle_id')
                ->dropDownList(
                    ArrayHelper::map(Bundle::find()->where(['is_deleted' => false])->orderBy('name')->all(), 'id', 'name'),
                    [
                        'onchange' => "$('#eshopitem-display_name').val($('#eshopitem-bundle_id option:selected').text());$('#eshopitem-image_url').val('/img/bundle/' + $(this).val() + '.jpg')",
                        'prompt' => '-- Select Item --'
                    ]
                ); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'display_name')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'category')
                ->dropDownList(EshopItem::getCategoryList()); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'description')->textarea() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'coin')->textInput() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'cash')->textInput() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'credit')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <?= $form->field($model, 'image_url')->textInput(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
            </div>
        </div>
        <div class="col-sm-6">
            <a class="btn btn-danger" href="<?= Url::previous(); ?>">Cancel</a>
        </div>
    </div>
<?php ActiveForm::end(); ?>