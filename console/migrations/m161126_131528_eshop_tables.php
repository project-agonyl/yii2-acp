<?php

use yii\db\Migration;

class m161126_131528_eshop_tables extends Migration
{
    public function safeUp()
    {
        $this->createTable('eshop_item',[
            'id'                                => $this->primaryKey(),
            'is_deleted'                        => $this->boolean()->defaultValue('FALSE')->notNull(),
            'item_id'                           => $this->integer()->notNull(),
            'display_name'                      => $this->text(),
            'description'                       => $this->text(),
            'image_url'                         => $this->text(),
            'category'                          => $this->integer()->defaultValue(99)->notNull(),
            'coin'                              => $this->float()->defaultValue(0)->notNull(),
            'cash'                              => $this->float()->defaultValue(0)->notNull(),
            'credit'                            => $this->float()->defaultValue(0)->notNull(),
            'meta'                              => $this->text(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
        $this->addForeignKey('fk_eshop_item_item', 'eshop_item', 'item_id', 'item', 'item_id');
        $this->createTable('eshop_coupon',[
            'id'                                => $this->primaryKey(),
            'is_deleted'                        => $this->boolean()->defaultValue('FALSE')->notNull(),
            'code'                              => $this->char(20)->unique()->notNull(),
            'account'                           => $this->text(),
            'character'                         => $this->text(),
            'category'                          => $this->integer(),
            'eshop_item_id'                     => $this->integer(),
            'item_id'                           => $this->integer(),
            'is_used'                           => $this->boolean()->defaultValue('FALSE')->notNull(),
            'allow_multiple_use'                => $this->boolean()->defaultValue('FALSE')->notNull(),
            'allow_use_with_other_coupons'      => $this->boolean()->defaultValue('FALSE')->notNull(),
            'use_count'                         => $this->integer()->defaultValue(0)->notNull(),
            'discount'                          => $this->integer()->defaultValue(0)->notNull(),
            'minimum_amount'                    => $this->integer()->defaultValue(0)->notNull(),
            'use_before'                        => $this->dateTime(),
            'use_after'                         => $this->dateTime(),
            'meta'                              => $this->text(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
        $this->addForeignKey('fk_eshop_coupon_eshop_item', 'eshop_coupon', 'eshop_item_id', 'eshop_item', 'id');
        $this->addForeignKey('fk_eshop_coupon_item', 'eshop_coupon', 'item_id', 'item', 'item_id');
        $this->createTable('eshop_order',[
            'id'                                => $this->primaryKey(),
            'account'                           => $this->text()->notNull(),
            'is_delivered'                      => $this->boolean()->defaultValue('FALSE')->notNull(),
            'delivered_to'                      => $this->text(),
            'current_value'                     => $this->float()->defaultValue(0)->notNull(),
            'discount'                          => $this->float()->defaultValue(0)->notNull(),
            'meta'                              => $this->text(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
        $this->createTable('eshop_order_item',[
            'id'                                => $this->primaryKey(),
            'is_deleted'                        => $this->boolean()->defaultValue('FALSE')->notNull(),
            'eshop_item_id'                     => $this->integer()->notNull(),
            'eshop_order_id'                    => $this->integer()->notNull(),
            'quantity'                          => $this->integer()->defaultValue(1)->notNull(),
            'meta'                              => $this->text(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
        $this->addForeignKey('fk_eshop_order_item_eshop_item', 'eshop_order_item', 'eshop_item_id', 'eshop_item', 'id');
        $this->addForeignKey('fk_eshop_order_item_eshop_order', 'eshop_order_item', 'eshop_order_id', 'eshop_order', 'id');
        $this->createTable('eshop_order_applied_coupon',[
            'id'                                => $this->primaryKey(),
            'is_deleted'                        => $this->boolean()->defaultValue('FALSE')->notNull(),
            'eshop_coupon_id'                   => $this->integer()->notNull(),
            'eshop_order_id'                    => $this->integer()->notNull(),
            'meta'                              => $this->text(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
        $this->addForeignKey('fk_eshop_order_applied_coupon_eshop_coupon', 'eshop_order_applied_coupon', 'eshop_coupon_id', 'eshop_coupon', 'id');
        $this->addForeignKey('fk_eshop_order_applied_coupon_eshop_order', 'eshop_order_applied_coupon', 'eshop_order_id', 'eshop_order', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_eshop_order_applied_coupon_eshop_order', 'eshop_order_applied_coupon');
        $this->dropForeignKey('fk_eshop_order_applied_coupon_eshop_coupon', 'eshop_order_applied_coupon');
        $this->dropTable('eshop_order_applied_coupon');
        $this->dropForeignKey('fk_eshop_order_item_eshop_order', 'eshop_order_item');
        $this->dropForeignKey('fk_eshop_order_item_eshop_item', 'eshop_order_item');
        $this->dropTable('eshop_order_item');
        $this->dropTable('eshop_order');
        $this->dropForeignKey('fk_eshop_coupon_item', 'eshop_coupon');
        $this->dropForeignKey('fk_eshop_coupon_eshop_item', 'eshop_coupon');
        $this->dropTable('eshop_coupon');
        $this->dropForeignKey('fk_eshop_item_item', 'eshop_item');
        $this->dropTable('eshop_item');
    }
}
