<?php

/* @var $this yii\web\View
 * @var $searchModel frontend\models\EshopItemSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */
use kartik\icons\Icon;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->title = Inflector::pluralize(ArrayHelper::getValue($searchModel->getCategoryList(), $searchModel->category, 'Item'));
?>
<style>
    .caption {
        height: 130px;
        overflow: hidden;
    }

    .caption h4 {
        white-space: nowrap;
    }

    .thumbnail img {
        width: 100%;
    }

    .ratings {
        padding-right: 10px;
        padding-left: 10px;
        color: #d17581;
    }

    .thumbnail {
        padding: 0;
    }

    .thumbnail .caption-full {
        padding: 9px;
        color: #333;
    }

    footer {
        margin: 50px 0;
    }
</style>
<div class="row">
    <?php Pjax::begin([
        'id' => "eshop-pjax-container",
        'enablePushState' => false,
        'timeout' => 4000,
    ]); ?>
    <div class="col-md-3">
        <p class="lead"><?= ArrayHelper::getValue(\Yii::$app->params, 'server-name', 'A3'); ?> E-Shop</p>
        <div class="list-group">
            <a href="<?= Url::to(['/eshop']); ?>" class="list-group-item <?= ($searchModel->category == null)?'active':'';?>">All Items</a>
            <?php foreach ($searchModel->AvailableCategoryNavs() as $id => $name): ?>
                <a href="<?= Url::to(['/eshop', 'category' => $id]); ?>" class="list-group-item <?= ($id == $searchModel->category)?'active':'';?>"><?=$name; ?></a>
            <?php endforeach; ?>
        </div>
        <a class="btn btn-success pull-right" id="show-cart-btn" href="<?= Url::to(['cart']);?>" data-pjax="0"><?= Icon::show('shopping-cart');?>Show cart</a>
    </div>
    <div class="col-md-9">
        <legend><?= Inflector::pluralize(ArrayHelper::getValue($searchModel->getCategoryList(), $searchModel->category, 'All Item')); ?></legend>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => [
                'tag' => 'div',
                'class' => 'row',
            ],
            'itemOptions' => [
                'tag' => false,
            ],
            'layout' => "{items}\n<div class='col-sm-12'>{pager}</div>",
            'itemView' => '_item',
            'emptyText' => 'Not items found'
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
