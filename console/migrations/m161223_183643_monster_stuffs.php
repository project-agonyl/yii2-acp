<?php

use yii\db\Migration;

class m161223_183643_monster_stuffs extends Migration
{
    public function safeUp()
    {
        $this->createTable('monster',[
            'id'                                => $this->primaryKey(),
            'name'                              => $this->text()->notNull(),
            'monster_id'                        => $this->integer()->unique()->notNull(),
            'respawn_time'                      => $this->integer()->defaultValue(0),
            'level'                             => $this->integer()->defaultValue(0),
            'attack'                            => $this->integer()->defaultValue(0),
            'defense'                           => $this->integer()->defaultValue(0),
            'hp'                                => $this->integer()->defaultValue(0),
            'meta'                              => $this->text(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
        $this->createTable('map',[
            'id'                                => $this->primaryKey(),
            'name'                              => $this->text()->notNull(),
            'map_id'                            => $this->integer()->unique()->notNull(),
            'zone'                              => $this->integer()->defaultValue(0),
            'meta'                              => $this->text(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
        $this->createTable('map_monster',[
            'id'                                => $this->primaryKey(),
            'map_id'                            => $this->integer()->notNull(),
            'monster_id'                        => $this->integer()->notNull(),
            'meta'                              => $this->text(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
        $this->addForeignKey('fk_map_monster_map', 'map_monster', 'map_id', 'map', 'map_id');
        $this->addForeignKey('fk_map_monster_monster', 'map_monster', 'monster_id', 'monster', 'monster_id');
        $this->createTable('monster_item',[
            'id'                                => $this->primaryKey(),
            'monster_id'                        => $this->integer()->notNull(),
            'item_id'                           => $this->integer()->notNull(),
            'drop_rate'                         => $this->integer()->defaultValue(0),
            'meta'                              => $this->text(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
        $this->addForeignKey('fk_monster_item_item', 'monster_item', 'item_id', 'item', 'item_id');
        $this->addForeignKey('fk_monster_item_monster', 'monster_item', 'monster_id', 'monster', 'monster_id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_monster_item_monster', 'monster_item');
        $this->dropForeignKey('fk_monster_item_item', 'monster_item');
        $this->dropTable('monster_item');
        $this->dropForeignKey('fk_map_monster_monster', 'map_monster');
        $this->dropForeignKey('fk_map_monster_map', 'map_monster');
        $this->dropTable('map_monster');
        $this->dropTable('map');
        $this->dropTable('monster');
    }
}
