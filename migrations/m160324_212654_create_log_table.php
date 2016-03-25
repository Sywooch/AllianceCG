<?php

use yii\db\Migration;

class m160324_212654_create_log_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%logging}}', [
            'id' => $this->bigPrimaryKey(),
            'level' => $this->integer(),
            'category' => $this->string(),
            'log_time' => $this->double(),
            'prefix' => $this->text(),
            'message' => $this->text(),
        ], $tableOptions);

        $this->createIndex('idx_log_level', '{{%logging}}', 'level');
        $this->createIndex('idx_log_category', '{{%logging}}', 'category');
    }

    public function down()
    {
        $this->dropTable('{{%logging}}');
    }
}