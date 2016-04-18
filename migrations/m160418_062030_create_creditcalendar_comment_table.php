<?php

use yii\db\Migration;

class m160418_062030_create_creditcalendar_comment_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%creditcalendar_comments}}', [
            'id' => $this->primaryKey(),
            'creditcalendar_id' => $this->integer()->notNull(),
            'comment_author' => $this->string(),
            'comment_text' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx_creditcalendar_id', '{{%creditcalendar_comments}}', 'creditcalendar_id');
        $this->addForeignKey('creditcalendar_id', '{{%creditcalendar_comments}}', 'creditcalendar_id', '{{%creditcalendar}}', 'id','CASCADE','CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%creditcalendar_comments}}');
    }
}
