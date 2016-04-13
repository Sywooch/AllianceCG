<?php

use yii\db\Migration;

class m160413_093548_create_credit_calendar extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%creditcalendar}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'date_from' => $this->date(),
            'time_from' => $this->time(),
            'date_to' => $this->date(),
            'time_to' => $this->time(),
            'description' => $this->text(),
            'location' => $this->string(255),
            'is_task' => $this->boolean(),
            'is_repeat' => $this->boolean(),
            'author' => $this->string(255),
            'created_at' => $this->smallInteger()->notNull()->defaultValue(0),
            'updated_at' => $this->smallInteger()->notNull()->defaultValue(0),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%creditcalendar}}');
    }
}
