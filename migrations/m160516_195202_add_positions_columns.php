<?php

use yii\db\Migration;

class m160516_195202_add_positions_columns extends Migration
{
    public function up()
    {
        $this->addColumn('{{%positions}}', 'state', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('{{%positions}}', 'created_at', $this->integer()->notNull());
        $this->addColumn('{{%positions}}', 'updated_at', $this->integer()->notNull());
        $this->addColumn('{{%positions}}', 'author', $this->string(255));
    }

    public function down()
    {
        echo "m160516_195202_add_positions_columns cannot be reverted.\n";

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
