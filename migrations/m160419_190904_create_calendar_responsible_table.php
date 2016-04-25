<?php

use yii\db\Migration;

class m160419_190904_create_calendar_responsible_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%calendar_responsibles}}', [
            'id' => $this->primaryKey(),
            'calendar_id' => $this->integer()->notNull(),
            'responsible_id' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx_calendar_responsible_id', '{{%calendar_responsibles}}', 'calendar_id');
        $this->addForeignKey('calendar_responsible_id', '{{%calendar_responsibles}}', 'calendar_id', '{{%calendar}}', 'id','CASCADE','CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%calendar_responsibles}}');
    }
}
