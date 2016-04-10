<?php

use yii\db\Migration;

class m160410_192943_create_privileged_users extends Migration
{
    public function up()
    {
        $table = Yii::$app->db->schema->getTableSchema('{{%user}}');
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        if (!empty($table)) {
            $this->insert('{{%user}}', [
                'created_at' => time(),
                'updated_at' => time(),
                'position' => 'Администратор',
                'email' => 'changeme',
                'role' => 'admin',
                'username' => 'admin',
                'status' => '1',
                'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
            ]); 
            $this->insert('{{%user}}', [
                'created_at' => time(), 
                'updated_at' => time(),
//                'email' => 'info@admin.org',
                'email' => 'changeme',
                'position' => 'Суперпользователь',
                'role' => 'root',
                'username' => 'root',
                'status' => '1',
                'password_hash' => Yii::$app->security->generatePasswordHash('root'),
            ]);                       
        }
        else
        {
            echo 'Users table are not exist in database!\n';
            return true;
        }
    }

    public function down()
    {
        echo 'Privileged users cannot be droped!\n';
        return true;
    }
}
