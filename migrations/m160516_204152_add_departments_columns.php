<?php

use yii\db\Migration;

class m160516_204152_add_departments_columns extends Migration
{
    public function up()
    {
        $this->addColumn('{{%departments}}', 'state', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('{{%departments}}', 'created_at', $this->integer()->notNull());
        $this->addColumn('{{%departments}}', 'updated_at', $this->integer()->notNull());
        $this->addColumn('{{%departments}}', 'author', $this->string(255));
    }

    public function down()
    {
        echo "m160516_204152_add_departments_columns cannot be reverted.\n";

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
