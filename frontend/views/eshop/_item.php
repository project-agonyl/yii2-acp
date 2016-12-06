<?php

/* @var $this yii\web\View
 * @var $model common\models\EshopItem
 */
use kartik\icons\Icon;

?>
<div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">
        <img src="http://placehold.it/320x150" alt="">
        <div class="caption">
            <h4 style="cursor: pointer">
                <span class="text-info cursor" <?= ($model->description)?'data-toggle="tooltip" title="'.$model->description.'"':'';?>><?= $model->display_name; ?></span>
            </h4>
            <h5 style="font-weight: bolder">Flamez Cash: <span class="text-success"><?= ($model->cash == -1)?'N/A':$model->cash; ?></span></h5>
            <h5 style="font-weight: bolder">Flamez Coins: <span class="text-warning"><?= ($model->coin == -1)?'N/A':$model->coin; ?></span></h5>
        </div>
        <div class="ratings">
            <p><button class="btn btn-primary add-to-cart-btn" data-key="<?= $model->id; ?>"><?= Icon::show('shopping-cart');?> Add to cart</button></p>
        </div>
    </div>
</div>