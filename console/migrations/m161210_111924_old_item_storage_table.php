<?php

use yii\db\Migration;

class m161210_111924_old_item_storage_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('old_itemstorage0',[
            'c_id'                      => $this->char(20)->notNull(),
            'c_sheadera'                => $this->char(255)->notNull(),
            'c_sheaderb'                => $this->char(255)->notNull(),
            'c_sheaderc'                => $this->char(255)->notNull(),
            'c_headera'                 => $this->char(255)->notNull(),
            'c_headerb'                 => $this->char(255)->notNull(),
            'c_headerc'                 => $this->char(255)->notNull(),
            'd_cdate'                   => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'd_udate'                   => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'c_status'                  => $this->char(1),
            'm_body'                    => $this->text()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('old_itemstorage0');
    }
}
