<?php

use yii\db\Migration;

class m161217_161857_daily_quest_tables extends Migration
{
    public function safeUp()
    {
        $this->createTable('character_spree',[
            'id'                                => $this->primaryKey(),
            'is_deleted'                        => $this->boolean()->defaultValue('FALSE')->notNull(),
            'character'                         => $this->char(20)->notNull(),
            'type'                              => $this->integer()->defaultValue(1)->notNull(),
            'count'                             => $this->integer()->defaultValue(0)->notNull(),
            'meta'                              => $this->text(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
        $this->createTable('daily_quest',[
            'id'                                => $this->primaryKey(),
            'is_deleted'                        => $this->boolean()->defaultValue('FALSE')->notNull(),
            'character'                         => $this->char(20)->notNull(),
            'taken_at'                          => $this->date(),
            'submitted_at'                      => $this->date(),
            'meta'                              => $this->text(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
        $this->createTable('gift',[
            'id'                                => $this->primaryKey(),
            'is_deleted'                        => $this->boolean()->defaultValue('FALSE')->notNull(),
            'character'                         => $this->char(20)->notNull(),
            'type'                              => $this->integer(),
            'eshop_item_id'                     => $this->integer(),
            'coins'                             => $this->integer()->defaultValue(0)->notNull(),
            'cash'                              => $this->integer()->defaultValue(0)->notNull(),
            'eshop_coupon_id'                   => $this->integer(),
            'is_taken'                          => $this->boolean()->defaultValue('FALSE')->notNull(),
            'meta'                              => $this->text(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
        $this->addForeignKey('fk_gift_eshop_item', 'gift', 'eshop_item_id', 'eshop_item', 'id');
        $this->addForeignKey('fk_gift_eshop_coupon_id', 'gift', 'eshop_coupon_id', 'eshop_coupon', 'id');
        $this->addColumn('eshop_coupon', 'minimum_coins', $this->integer()->defaultValue(0));
        $this->addColumn('eshop_coupon', 'minimum_cash', $this->integer()->defaultValue(0));
        $this->addColumn('eshop_coupon', 'minimum_credit', $this->integer()->defaultValue(0));
    }

    public function safeDown()
    {
        $this->dropColumn('eshop_coupon', 'minimum_coins');
        $this->dropColumn('eshop_coupon', 'minimum_cash');
        $this->dropColumn('eshop_coupon', 'minimum_credit');
        $this->dropForeignKey('fk_gift_eshop_item', 'gift');
        $this->dropForeignKey('fk_gift_eshop_coupon_id', 'gift');
        $this->dropTable('gift');
        $this->dropTable('daily_quest');
        $this->dropTable('character_spree');
    }
}
