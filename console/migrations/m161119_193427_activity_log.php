<?php

use yii\db\Migration;

class m161119_193427_activity_log extends Migration
{
    public function safeUp()
    {
        $this->addPrimaryKey('pk_account', 'account', 'c_id');
        $this->addPrimaryKey('pk_character', 'charac0', 'c_id');
        $this->createTable('activity_log',[
            'id'                                => $this->bigPrimaryKey(),
            'is_visible'                        => $this->boolean()->defaultValue('TRUE')->notNull(),
            'account'                           => $this->char(20)->notNull(),
            'character'                         => $this->char(20),
            'event'                             => $this->integer()->notNull(),
            'description'                       => $this->text(),
            'browser'                           => $this->text(),
            'operating_system'                  => $this->text(),
            'ip_address'                        => $this->text(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('activity_log');
        $this->dropPrimaryKey('pk_character', 'charac0');
        $this->dropPrimaryKey('pk_account', 'account');
    }
}
