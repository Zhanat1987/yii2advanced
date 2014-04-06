<?php

use yii\db\Schema;

class m140406_111417_rights extends \yii\db\Migration
{
    public function up()
    {
        /**
         * https://github.com/yiisoft/yii2/blob/master/framework/rbac/schema-mysql.sql
         */
        $sql = <<<TABLES_CREATE
drop table if exists `auth_assignment`;
drop table if exists `auth_item_child`;
drop table if exists `auth_item`;
drop table if exists `auth_rule`;
create table `auth_rule`
(
    `name` varchar(64) not null,
    `data` text,
    primary key (`name`)
) engine InnoDB;
create table `auth_item`
(
   `name` varchar(64) not null,
   `type` integer not null,
   `description` text,
   `rule_name` varchar(64),
   `data` text,
   primary key (`name`),
   foreign key (`rule_name`) references `auth_rule` (`name`)
   on delete set null on update cascade,
   key `type` (`type`)
) engine InnoDB;
create table `auth_item_child`
(
   `parent` varchar(64) not null,
   `child` varchar(64) not null,
   primary key (`parent`, `child`),
   foreign key (`parent`) references `auth_item` (`name`)
   on delete cascade on update cascade,
   foreign key (`child`) references `auth_item` (`name`)
   on delete cascade on update cascade
) engine InnoDB;
create table `auth_assignment`
(
   `item_name` varchar(64) not null,
   `user_id` varchar(64) not null,
   `rule_name` varchar(64),
   `data` text,
   primary key (`item_name`, `user_id`),
   foreign key (`item_name`) references `auth_item` (`name`)
   on delete cascade on update cascade,
   foreign key (`rule_name`) references `auth_rule` (`name`)
   on delete set null on update cascade
) engine InnoDB;
TABLES_CREATE;
        $this->execute($sql);
    }

    public function down()
    {
        $sql = <<<TABLES_DROP
drop table if exists `auth_assignment`;
drop table if exists `auth_item_child`;
drop table if exists `auth_item`;
drop table if exists `auth_rule`;
TABLES_DROP;
        $this->execute($sql);
    }
}
