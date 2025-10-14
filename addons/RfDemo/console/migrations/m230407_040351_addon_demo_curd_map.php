<?php

use yii\db\Migration;

class m230407_040351_addon_demo_curd_map extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');

        /* 创建表 */
        $this->createTable('{{%addon_demo_curd_map}}', [
            'id' => "int(11) NOT NULL AUTO_INCREMENT",
            'merchant_id' => "int(10) unsigned NULL DEFAULT '0' COMMENT '商户id'",
            'curd_id' => "int(11) NULL DEFAULT '0'",
            'name' => "varchar(100) NULL DEFAULT '' COMMENT '名称'",
            'shipping_fee' => "decimal(10,2) unsigned NULL DEFAULT '0.00' COMMENT '运费'",
            'type' => "varchar(50) NULL DEFAULT '' COMMENT '类型'",
            'path' => "json NULL COMMENT '覆盖范围'",
            'polygon' => "polygon NOT NULL",
            'radius' => "decimal(10,2) NULL COMMENT '半径'",
            'status' => "tinyint(4) NULL DEFAULT '1' COMMENT '状态'",
            'created_at' => "int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间'",
            'updated_at' => "int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间'",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4");

        /* 索引设置 */
        $this->createIndex('curd_id','{{%addon_demo_curd_map}}','curd_id',0);

        /* 表数据 */

        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%addon_demo_curd_map}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

