<?php

use yii\db\Migration;

class m160418_062030_create_calendar_comment_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%calendar_comments}}', [
            'id' => $this->primaryKey(),
            'calendar_id' => $this->integer()->notNull(),
            'comment_author' => $this->string(),
            'comment_text' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx_calendar_id', '{{%calendar_comments}}', 'calendar_id');
        $this->addForeignKey('calendar_id', '{{%calendar_comments}}', 'calendar_id', '{{%calendar}}', 'id','CASCADE','CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%calendar_comments}}');
    }
}
