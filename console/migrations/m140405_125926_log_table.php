<?php

use yii\db\Schema;

class m140405_125926_log_table extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('log', [
            'id' => 'pk',
            'level' => Schema::TYPE_INTEGER,
            'category' => Schema::TYPE_STRING . ' NOT NULL',
            'log_time' => Schema::TYPE_INTEGER,
            'message' => Schema::TYPE_TEXT,
        ]);
        $this->createIndex('idx_log_level', 'log', ['level']);
        $this->createIndex('idx_log_category', 'log', ['category']);
    }

    public function down()
    {
        $this->dropTable('log');
    }
}
