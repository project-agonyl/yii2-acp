<?php
use common\models\Item;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;

$this->title = 'Rebirth Guide';
$rebirth = ArrayHelper::getValue(ArrayHelper::getValue(\Yii::$app->params, 'rebirth', []), 'character', []);
$items = [];
?>
<?php foreach ($rebirth as $rb => $info): ?>
    <div class="row">
        <div class="col-sm-12">
            <h3>Rebirth <?= $rb ?></h3>
            <div class="col-sm-6">
                <h4>Requirements</h4>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Requirement</th>
                        <th>Fulfillment Criteria</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $req = ArrayHelper::getValue($info, 'requirements', []); ?>
                    <?php foreach ($req as $label => $fulfillment): ?>
                        <?php if ($label == 'items'): ?>
                            <?php for ($i = 0; $i < count($fulfillment); $i++): ?>
                                <tr>
                                <?php
                                if (isset($items[$fulfillment[$i]])) {
                                    $item = $items[$fulfillment[$i]];
                                } else {
                                    $item = Item::find()
                                        ->where(['item_id' => $fulfillment[$i]])
                                        ->one();
                                }
                                if ($item != null) {
                                    $items[$fulfillment[$i]] = $item;
                                    ?>
                                    <td>Inventory Slot <?= $i + 1 ?></td>
                                    <td><?= $item->name ?></td>
                                    <?php
                                }
                                ?>
                                </tr>
                            <?php endfor; ?>
                        <?php else: ?>
                            <tr>
                                <td><?= Inflector::humanize($label); ?></td>
                                <td><?= $fulfillment; ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-6">
                <h4>Gifts</h4>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Label</th>
                        <th>Gift</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $gifts = ArrayHelper::getValue($info, 'gifts', []); ?>
                    <?php foreach ($gifts as $label => $gift): ?>
                        <tr>
                            <td><?= Inflector::humanize($label); ?></td>
                            <td><?= $gift; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr>
<?php endforeach; ?>
