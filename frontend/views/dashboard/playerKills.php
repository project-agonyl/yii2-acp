<?php
use yii\widgets\ListView;

$this->title = 'Recent Player Kills';
?>
<div class="col-md-9">
    <legend>Recent Player Kills</legend>
    <?= ListView::widget([
        'dataProvider' => $characterDataProvider,
        'options' => [
            'tag' => 'div',
            'class' => 'row',
        ],
        'itemOptions' => [
            'tag' => false,
        ],
        'layout' => "{items}",
        'itemView' => '_playerKill',
        'emptyText' => 'No player kills found'
    ]); ?>
</div>