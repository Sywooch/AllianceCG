<?php

use yii\db\Migration;

class m160413_113810_create_statuses_table extends Migration
{
    public function up()
    {
        $this->createTable('statuses_table', [
            'id' => $this->primaryKey()
        ]);
    }

    public function down()
    {
        $this->dropTable('statuses_table');
    }
}
