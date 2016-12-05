<?php

use yii\db\Migration;

class m161205_143719_old_tables extends Migration
{
    public function safeUp()
    {
        $this->createTable('old_account',[
            'c_id'                      => $this->char(20)->notNull(),
            'c_sheadera'                => $this->text()->notNull(),
            'c_sheaderb'                => $this->text()->notNull(),
            'c_sheaderc'                => $this->text()->notNull(),
            'c_headera'                 => $this->text()->notNull(),
            'c_headerb'                 => $this->text()->notNull(),
            'c_headerc'                 => $this->text()->notNull(),
            'd_cdate'                   => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'd_udate'                   => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'c_status'                  => $this->char(1)->notNull(),
            'm_body'                    => $this->text(),
            'acc_status'                => $this->text()->notNull(),
            'salary'                    => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'last_salary'               => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
        $this->addPrimaryKey('pk_old_account', 'old_account', 'c_id');
        $this->createTable('old_charac0',[
            'c_id'                      => $this->char(20)->notNull(),
            'c_sheadera'                => $this->text()->notNull(),
            'c_sheaderb'                => $this->text()->notNull(),
            'c_sheaderc'                => $this->text()->notNull(),
            'c_headera'                 => $this->text()->notNull(),
            'c_headerb'                 => $this->text()->notNull(),
            'c_headerc'                 => $this->text()->notNull(),
            'd_cdate'                   => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'd_udate'                   => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'c_status'                  => $this->char(1)->notNull(),
            'm_body'                    => $this->string(4000),
            'rb'                        => $this->integer()->defaultValue(0)->notNull(),
            'set_gift'                  => $this->integer()->defaultValue(0)->notNull(),
            'online'                    => $this->char(10),
            'c_reset'                   => $this->integer()->defaultValue(0)->notNull(),
            'rc_event'                  => $this->integer()->defaultValue(0)->notNull()
        ]);
        $this->addPrimaryKey('pk_old_character', 'old_charac0', 'c_id');
        $this->createTable('connect_old_account',[
            'id'                                => $this->primaryKey(),
            'current_account'                   => $this->char(20)->notNull(),
            'old_account'                       => $this->char(20)->notNull(),
            'coin_given'                        => $this->integer()->defaultValue(0)->notNull(),
            'status'                            => $this->integer()->defaultValue(1)->notNull(),
            'meta'                              => $this->text(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
        $this->createTable('connect_old_account_request',[
            'id'                                => $this->primaryKey(),
            'connect_old_account_id'            => $this->integer()->notNull(),
            'token'                             => $this->text()->notNull(),
            'meta'                              => $this->text(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
        $this->addForeignKey('fk_connect_old_account_request_connect_old_account', 'connect_old_account_request', 'connect_old_account_id', 'connect_old_account', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_connect_old_account_request_connect_old_account', 'connect_old_account_request');
        $this->dropTable('connect_old_account_request');
        $this->dropTable('connect_old_account');
        $this->dropPrimaryKey('pk_old_character', 'old_charac0');
        $this->dropTable('old_charac0');
        $this->dropPrimaryKey('pk_old_account', 'old_account');
        $this->dropTable('old_account');
    }
}
