<?php

use yii\db\Schema;

class m140329_142517_caching_table extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('caching', [
            'id' => 'pk',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'content' => Schema::TYPE_TEXT,
        ]);
    }

    public function down()
    {
        $this->dropTable('caching');
    }
}
