<?php

use yii\db\Migration;

class m160421_200659_create_userroles_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%userroles}}', [
            'id' => $this->primaryKey(),
            'role' => $this->string()->notNull(),
            'role_description' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'author' => $this->string(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%userroles}}');
    }
}
