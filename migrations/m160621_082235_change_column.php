<?php

use yii\db\Migration;

class m160621_082235_change_column extends Migration
{
    public function up()
    {
         $this->alterColumn('{{%audisummertable}}', 'discount_percent', $this->string());
    }

    public function down()
    {
        echo "m160621_082235_change_column cannot be reverted.\n";

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
