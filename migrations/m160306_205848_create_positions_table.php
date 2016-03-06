<?php

use yii\db\Migration;

class m160306_205848_create_positions_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%positions}}', [
            'id' => $this->primaryKey(),
            'position' => $this->string(255),
            'description' => $this->text(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%positions}}');
    }
}
