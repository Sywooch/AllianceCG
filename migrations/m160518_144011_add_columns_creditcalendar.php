<?php

use yii\db\Migration;

class m160518_144011_add_columns_creditcalendar extends Migration
{
    public function up()
    {
        $this->addColumn('{{%statusmonitor}}', 'state', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('{{%statusmonitor}}', 'created_at', $this->integer()->notNull());
        $this->addColumn('{{%statusmonitor}}', 'updated_at', $this->integer()->notNull());
        $this->addColumn('{{%statusmonitor}}', 'author', $this->string());
    }

    public function down()
    {
        echo "m160518_144011_add_columns_creditcalendar cannot be reverted.\n";

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
