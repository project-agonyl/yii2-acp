<?php

use yii\db\Migration;

class m170102_152931_submission_tables extends Migration
{
    public function safeUp()
    {
        $this->createTable('event_points',[
            'id'                                => $this->primaryKey(),
            'account'                           => $this->text()->notNull(),
            'type'                              => $this->integer()->notNull(),
            'points'                            => $this->integer()->defaultValue(0)->notNull(),
            'meta'                              => $this->text(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('event_points');
    }
}
