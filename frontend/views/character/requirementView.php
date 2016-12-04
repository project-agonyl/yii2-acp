<?php

/* @var $this yii\web\View
 * @var $model common\models\Charac0
 */
?>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-striped table-bordered detail-view">
            <legend>Requirements</legend>
            <thead>
            <tr>
                <th>Requirement</th>
                <th>Fulfilled</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model->checkRebirthRequirements() as $requirement => $fulfilled): ?>
                <tr <?= (strtolower($fulfilled) == 'no')?'class="danger"':''; ?>>
                    <td><?= $requirement; ?></td>
                    <td><?= $fulfilled; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
