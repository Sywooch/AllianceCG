<?php

use yii\db\Migration;

class m160518_111755_servicesheduler_change_responsible_column_type extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%servicesheduler}}', 'responsible', $this->integer()->notNull());
    }

    public function down()
    {
        echo "m160518_111755_servicesheduler_change_responsible_column_type cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
