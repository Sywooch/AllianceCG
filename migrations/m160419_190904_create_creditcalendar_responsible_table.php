<?php

use yii\db\Migration;

class m160419_190904_create_creditcalendar_responsible_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%creditcalendar_responsibles}}', [
            'id' => $this->primaryKey(),
            'creditcalendar_id' => $this->integer()->notNull(),
            'responsible' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx_creditcalendar_responsible_id', '{{%creditcalendar_responsibles}}', 'creditcalendar_id');
        $this->addForeignKey('creditcalendar_responsible_id', '{{%creditcalendar_responsibles}}', 'creditcalendar_id', '{{%creditcalendar}}', 'id','CASCADE','CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%creditcalendar_responsibles}}');
    }
}
