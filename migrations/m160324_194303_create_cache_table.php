<?php

use yii\db\Migration;

class m160324_194303_create_cache_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cache}}', [
            'id' => $this->primaryKey(),
            'expire' => $this->integer(11),
            'data' => $this->binary(),
        ], $tableOptions);

        $this->createIndex('idx_cache_expire', '{{%cache}}', 'expire');
    }

    public function down()
    {
        $this->dropTable('{{%cache}}');
    }
}
