<?php

use yii\db\Migration;

class m160306_204740_create_companies_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%companies}}', [
            'id' => $this->primaryKey(),
            'company_name' => $this->string(255),
            'company_logo' => $this->string(255),
            'company_description' => $this->text(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%companies}}');
    }
}
