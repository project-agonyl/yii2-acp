<?php

/* @var $this yii\web\View
 * @var $model backend\modules\admin\models\EshopItem
 */
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = 'E-shop item '.$model->id.' Details';
?>
<h1>E-shop Item Details</h1>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'category' => [
            'attribute' => 'category',
            'label' => 'Category',
            'value' => $model->categoryString
        ],
        'item_id',
        'display_name',
        'original_name' => [
            'attribute' => 'item.name',
            'label' => 'Original Item Name',
            'value' => $model->item->name
        ],
        'description',
        'image_url',
        'coin',
        'cash',
        'credit',
        'created_at',
        'updated_at',
    ],
]); ?>
<?= Html::a('Back', Url::previous(), ['class' => 'btn btn-info']);?>
