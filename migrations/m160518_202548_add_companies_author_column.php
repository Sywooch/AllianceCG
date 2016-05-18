<?php

use yii\db\Migration;

class m160518_202548_add_companies_author_column extends Migration
{
    public function up()
    {
        $this->addColumn('{{%companies}}', 'author', $this->string());

    }

    public function down()
    {
        echo "m160518_202548_add_companies_author_column cannot be reverted.\n";

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
