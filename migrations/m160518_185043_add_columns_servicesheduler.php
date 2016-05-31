<?php

use yii\db\Migration;

class m160518_185043_add_columns_servicesheduler extends Migration
{
    public function up()
    {
        // $this->addColumn('{{%servicesheduler}}', 'state', $this->integer()->notNull()->defaultValue(0));
        // $this->addColumn('{{%servicesheduler}}', 'created_at', $this->integer()->notNull());
        // $this->addColumn('{{%servicesheduler}}', 'updated_at', $this->integer()->notNull());
        // $this->addColumn('{{%servicesheduler}}', 'author', $this->string());
    }

    public function down()
    {
        echo "m160518_185043_add_columns_servicesheduler cannot be reverted.\n";

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
