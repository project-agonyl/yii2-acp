<?php

/* @var $this yii\web\View
 * @var $searchModel frontend\models\EshopDeliverySearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->title = 'E-shop Deliveries';
?>
<?php Pjax::begin([
    'id' => "eshop-delivery-container",
    'enablePushState' => false,
    'timeout' => 4000,
]); ?>
<div class="col-sm-10 col-sm-offset-1">
    <legend>E-shop Deliveries</legend>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
            'tag' => 'div',
            'class' => 'panel-group',
            'role' => 'tablist',
            'aria-multiselectable' => true
        ],
        'itemOptions' => [
            'tag' => false,
        ],
        'layout' => "{items}\n<div class='col-sm-12'>{pager}</div>",
        'itemView' => '_eshopDeliveryItem',
        'emptyText' => 'Not deliveries found'
    ]); ?>
</div>
<?php Pjax::end(); ?>
