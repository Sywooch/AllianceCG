<?php

use yii\db\Migration;

class m160517_080017_add_companies_column extends Migration
{
    public function up()
    {
        $this->addColumn('{{%companies}}', 'state', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('{{%companies}}', 'created_at', $this->integer()->notNull());
        $this->addColumn('{{%companies}}', 'updated_at', $this->integer()->notNull());
        $this->addColumn('{{%companies}}', 'author', $this->string(255));
    }

    public function down()
    {
        echo "m160517_080017_add_companies_column cannot be reverted.\n";

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
