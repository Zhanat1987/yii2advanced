<?php

use yii\db\Schema;

class m140405_143105_yii2translate2_db_create extends \yii\db\Migration
{
    public function up()
    {
        $sql = <<<DB_CREATE
CREATE DATABASE `yii2translate2`;
USE `yii2translate2`;
CREATE TABLE IF NOT EXISTS `test` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
USE `yii2translate`;
DB_CREATE;
        $this->execute($sql);
    }

    public function down()
    {
        $sql = 'DROP DATABASE `yii2translate2`;';
        $this->execute($sql);
    }
}
