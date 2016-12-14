<?php

use yii\db\Migration;

class m161214_145822_bundle_tables extends Migration
{
    public function safeUp()
    {
        $this->createTable('bundle',[
            'id'                                => $this->primaryKey(),
            'is_deleted'                        => $this->boolean()->defaultValue('FALSE')->notNull(),
            'name'                              => $this->text()->notNull(),
            'meta'                              => $this->text(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
        $this->createTable('bundle_item',[
            'id'                                => $this->primaryKey(),
            'is_deleted'                        => $this->boolean()->defaultValue('FALSE')->notNull(),
            'bundle_id'                         => $this->integer()->notNull(),
            'item_id'                           => $this->integer()->notNull(),
            'quantity'                          => $this->integer()->defaultValue(1)->notNull(),
            'meta'                              => $this->text(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
        $this->addForeignKey('fk_bundle_item_bundle', 'bundle_item', 'bundle_id', 'bundle', 'id');
        $this->addForeignKey('fk_bundle_item_item', 'bundle_item', 'item_id', 'item', 'item_id');
        $this->addColumn('eshop_item', 'bundle_id', $this->integer());
        $this->addForeignKey('fk_eshop_item_bundle', 'eshop_item', 'bundle_id', 'bundle', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_eshop_item_bundle', 'eshop_item');
        $this->dropColumn('eshop_item', 'bundle_id');
        $this->dropForeignKey('fk_bundle_item_item', 'bundle_item');
        $this->dropForeignKey('fk_bundle_item_bundle', 'bundle_item');
        $this->dropTable('bundle_item');
        $this->dropTable('bundle');
    }
}
