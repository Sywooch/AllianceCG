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
            'user_id' => $this->integer()->notNull(),
        ], $tableOptions);
        
        $this->createIndex('idx-resp-calid', '{{%calendar_responsibles}}', 'calendar_id');
        $this->createIndex('idx-resp-caluserid', '{{%calendar_responsibles}}', 'user_id');

        $this->addForeignKey('fk-resp-calid', '{{%calendar_responsibles}}', 'calendar_id', '{{%calendar}}', 'id','CASCADE','RESTRICT');
        $this->addForeignKey('fk-resp-caluserid', '{{%calendar_responsibles}}', 'user_id', '{{%user}}', 'id','RESTRICT','RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%calendar_responsibles}}');
    }
}
