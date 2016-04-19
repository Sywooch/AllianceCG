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
//            'responsible' => $this->string(255),
            'is_task' => $this->boolean()->notNull()->defaultValue(0),
//            'is_repeat' => $this->boolean(),
            'dow' => $this->string(255),
            'allday' => $this->smallInteger()->notNull()->defaultValue(0),
            'author' => $this->string(255),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'is_chief_task' => $this->smallInteger()->notNull()->defaultValue(0),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%creditcalendar}}');
    }
}
