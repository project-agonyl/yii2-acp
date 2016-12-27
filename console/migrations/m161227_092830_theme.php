<?php

use yii\db\Migration;

class m161227_092830_theme extends Migration
{
    public function safeUp()
    {
        $this->addColumn('AccountInfo', 'theme', $this->text()->defaultValue('default'));
    }

    public function safeDown()
    {
        $this->dropColumn('AccountInfo', 'theme');
    }
}