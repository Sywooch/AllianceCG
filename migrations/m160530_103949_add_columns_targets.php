<?php

use yii\db\Migration;

class m160530_103949_add_columns_targets extends Migration
{
    public function up()
    {
        $this->addColumn('{{%targets}}', 'created_at', $this->integer()->notNull());
        $this->addColumn('{{%targets}}', 'updated_at', $this->integer()->notNull());
        $this->addColumn('{{%targets}}', 'author', $this->string());
    }

    public function down()
    {
        echo "m160530_103949_add_columns_targets cannot be reverted.\n";

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
