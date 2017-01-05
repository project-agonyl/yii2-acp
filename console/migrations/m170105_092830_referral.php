<?php

use yii\db\Migration;

class m170105_092830_referral extends Migration
{
    public function safeUp()
    {
        $this->addColumn('AccountInfo', 'referred_by', $this->text());
        $this->addColumn('AccountInfo', 'meta', $this->text());
    }

    public function safeDown()
    {
        $this->dropColumn('AccountInfo', 'meta');
        $this->dropColumn('AccountInfo', 'referred_by');
    }
}