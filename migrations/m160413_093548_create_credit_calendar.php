<?php

use yii\db\Migration;

class m160413_093548_create_credit_calendar extends Migration
{
    public function up()
    {
        $this->createTable('credit_calendar', [
            'id' => $this->primaryKey()
        ]);
    }

    public function down()
    {
        $this->dropTable('credit_calendar');
    }
}
