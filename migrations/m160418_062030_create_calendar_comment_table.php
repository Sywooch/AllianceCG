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
            'user_id' => $this->integer()->notNull(),
            'comment_text' => $this->text()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx-com-calid', '{{%calendar_comments}}', 'calendar_id');
        $this->createIndex('idx-com-caluserid', '{{%calendar_comments}}', 'user_id');

        $this->addForeignKey('fk-com-calid', '{{%calendar_comments}}', 'calendar_id', '{{%calendar}}', 'id','CASCADE','RESTRICT');
        $this->addForeignKey('fk-com-caluserid', '{{%calendar_comments}}', 'user_id', '{{%user}}', 'id','CASCADE','RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%calendar_comments}}');
    }
}
