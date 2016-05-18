<?php

use yii\db\Migration;

class m160518_202722_add_ts_columns extends Migration
{
    public function up()
    {
        $this->addColumn('{{%companies}}', 'created_at', $this->integer()->notNull());
        $this->addColumn('{{%companies}}', 'updated_at', $this->integer()->notNull());

    }

    public function down()
    {
        echo "m160518_202722_add_ts_columns cannot be reverted.\n";

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
