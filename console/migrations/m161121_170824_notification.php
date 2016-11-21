<?php

use yii\db\Migration;

class m161121_170824_notification extends Migration
{
    public function safeUp()
    {
        $this->createTable('notification_log',[
            'id'                                => $this->primaryKey(),
            'status'                            => $this->smallInteger()->defaultValue(0)->notNull(),
            'is_read'                           => $this->boolean()->defaultValue('FALSE')->notNull(),
            'type'                              => $this->integer()->notNull(),
            'from_address'                      => $this->text()->notNull(),
            'reply_to_address'                  => $this->text(),
            'to_address'                        => $this->text()->notNull(),
            'cc_address'                        => $this->text(),
            'bcc_address'                       => $this->text(),
            'subject'                           => $this->text()->notNull(),
            'body'                              => $this->text(),
            'read_at'                           => $this->dateTime(),
            'read_count'                        => $this->integer()->defaultValue(0),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'scheduled_at'                      => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('notification_log');
    }
}
