<?php

use yii\db\Migration;

class m160621_080200_change_audisummertable_percent_column_type extends Migration
{
    public function up()
    {
         $this->alterColumn('{{%audisummertable}}', 'discount_percent', $this->decimal());
    }

    public function down()
    {
        echo "m160621_080200_change_audisummertable_percent_column_type cannot be reverted.\n";

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
