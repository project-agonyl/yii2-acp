<?php

use yii\db\Migration;

class m161208_161635_old_merc_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('old_hstable',[
            'HSID'                      => $this->integer()->notNull(),
            'HSName'                    => $this->char(21)->notNull(),
            'MasterName'                => $this->char(21)->notNull(),
            'Type'                      => $this->smallInteger()->notNull(),
            'HSLevel'                   => $this->smallInteger()->notNull(),
            'HSExp'                     => $this->integer()->notNull(),
            'Ability'                   => $this->text()->notNull(),
            'CreateDate'                => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'SaveDate'                  => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'HSState'                   => $this->smallInteger(),
            'DelDate'                   => $this->dateTime(),
            'HSBody'                    => $this->text()->notNull()
        ]);
        $this->addPrimaryKey('pk_old_hstable', 'old_hstable', 'HSID');
    }

    public function safeDown()
    {
        $this->dropPrimaryKey('pk_old_hstable', 'old_hstable');
        $this->dropTable('old_hstable');
    }
}
