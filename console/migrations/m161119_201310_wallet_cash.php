<?php

use yii\db\Migration;

class m161119_201310_wallet_cash extends Migration
{
    public function safeUp()
    {
        $this->createTable('wallet',[
            'id'                                => $this->primaryKey(),
            'is_deleted'                        => $this->boolean()->defaultValue('FALSE')->notNull(),
            'account'                           => $this->char(20)->notNull(),
            'cash'                              => $this->float()->defaultValue(0)->notNull(),
            'coin'                              => $this->float()->defaultValue(0)->notNull(),
            'credit'                            => $this->float()->defaultValue(0)->notNull(),
            'created_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP",
            'updated_at'                        => $this->dateTime() . " DEFAULT CURRENT_TIMESTAMP"
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('wallet');
    }
}
