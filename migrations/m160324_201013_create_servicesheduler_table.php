<?php

use yii\db\Migration;

class m160324_201013_create_servicesheduler_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%servicesheduler}}', [
            'id' => $this->primaryKey(),
            'date' => $this->date(),
            'responsible' => $this->integer()->notNull(),
            'state' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'author' => $this->string(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%servicesheduler}}');
    }
}
