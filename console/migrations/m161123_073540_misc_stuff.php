<?php

use yii\db\Migration;

class m161123_073540_misc_stuff extends Migration
{
    public function safeUp()
    {
        $this->addColumn('AccountInfo', 'forgot_pass_key', $this->text());
        $this->addColumn('AccountInfo', 'id', $this->primaryKey());
        $this->createTable('item',[
            'id'                                => $this->primaryKey(),
            'second_column_id'                  => $this->integer()->defaultValue(35)->notNull(),
            'is_available_eshop'                => $this->boolean()->defaultValue('FALSE')->notNull(),
            'name'                              => $this->text()->notNull(),
            'type'                              => $this->integer()->defaultValue(1)->notNull(),
            'meta'                              => $this->text(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
        $this->createTable('item_info',[
            'id'                                => $this->primaryKey(),
            'item_id'                           => $this->integer()->notNull(),
            'level'                             => $this->integer()->defaultValue(1)->notNull(),
            'strength'                          => $this->integer()->defaultValue(25)->notNull(),
            'intelligence'                      => $this->integer()->defaultValue(25)->notNull(),
            'dexterity'                         => $this->integer()->defaultValue(25)->notNull(),
            'damage'                            => $this->integer()->defaultValue(25)->notNull(),
            'incremental_damage'                => $this->integer()->defaultValue(10)->notNull(),
            'max_ice_elements'                  => $this->integer()->defaultValue(10)->notNull(),
            'max_fire_elements'                 => $this->integer()->defaultValue(10)->notNull(),
            'max_light_elements'                => $this->integer()->defaultValue(10)->notNull(),
            'additional_stats'                  => $this->integer()->defaultValue(2)->notNull(),
            'meta'                              => $this->text(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
        $this->addForeignKey('fk_item_level_item', 'item_info', 'item_id', 'item', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_item_level_item', 'item_info');
        $this->dropTable('item_info');
        $this->dropTable('item');
        $this->dropColumn('AccountInfo', 'forgot_pass_key');
    }
}
