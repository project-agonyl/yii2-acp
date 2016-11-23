<?php

use yii\db\Migration;

class m161123_184816_item_additional extends Migration
{
    public function safeUp()
    {
        $this->addColumn('item', 'woonz', $this->integer()->defaultValue(1));
        $this->addColumn('item', 'item_id', $this->integer()->unique()->notNull());
    }

    public function safeDown()
    {
        $this->dropColumn('item', 'item_id');
        $this->dropColumn('item', 'woonz');
    }
}
