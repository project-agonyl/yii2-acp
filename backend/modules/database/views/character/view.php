<?php

/* @var $this yii\web\View
 * @var $model common\models\Charac0
 */
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->c_id.' Details';
?>
<h1>Character Details</h1>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name' => [
            'attribute' => 'c_id',
            'label' => 'Name'
        ],
        'account' => [
            'attribute' => 'c_sheadera',
            'label' => 'Account'
        ],
        'type' => [
            'attribute' => 'c_sheaderb',
            'label' => 'Type',
            'value' => $model->typeString
        ],
        'level' => [
            'attribute' => 'c_sheaderc',
            'label' => 'Level'
        ],
        'rb' => [
            'attribute' => 'rb',
            'label' => 'Rebirth'
        ],
        'updated' => [
            'attribute' => 'd_udate',
            'label' => 'Last Updated',
            'format' => 'datetime'
        ]
    ],
]); ?>
<?= Html::a('Back', Url::to(['/database/character'], ['class' => 'btn btn-info']));?>
