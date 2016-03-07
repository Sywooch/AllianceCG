<?php

use yii\db\Migration;

class m160307_125127_create_user_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
 
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'name' => $this->string(255),
            'surname' => $this->string(255),
            'patronymic' => $this->string(255),
            'full_name' => $this->string(255),
            'photo' => $this->string(255),
            'position' => $this->string(255),
            'role' => $this->string(255),
            'username' => $this->string()->notNull(),
            'auth_key' => $this->string(32),
            'email_confirm_token' => $this->string(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'email' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
        ], $tableOptions);
 
        $this->createIndex('idx_user_username', '{{%user}}', 'username');
        $this->createIndex('idx_user_email', '{{%user}}', 'email');
        $this->createIndex('idx_user_status', '{{%user}}', 'status');
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
