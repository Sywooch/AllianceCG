<?php

use yii\db\Schema;
use yii\db\Migration;

class m160228_061325_create_position_table extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
 
        $this->createTable('{{%positions}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'position' => $this->string(),
            'description' => text(),
        ], $tableOptions);
 
        // $this->createIndex('idx_user_username', '{{%user}}', 'username');
        // $this->createIndex('idx_user_email', '{{%user}}', 'email');
        // $this->createIndex('idx_user_status', '{{%user}}', 'status');
    }

    public function down()
    {
        $this->dropTable('{{%positions}}');
    }
}
