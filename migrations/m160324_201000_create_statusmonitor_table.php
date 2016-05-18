<?php

use yii\db\Migration;

class m160324_201000_create_statusmonitor_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%statusmonitor}}', [
            'id' => $this->primaryKey(),
            'regnumber' => $this->string(255),
            'from' => $this->datetime(),
            'to' => $this->datetime(),
            'state' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'author' => $this->string(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%statusmonitor}}');
    }
}
