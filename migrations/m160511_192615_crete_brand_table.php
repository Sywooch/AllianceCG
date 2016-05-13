<?php

use yii\db\Migration;

class m160511_192615_crete_brand_table extends Migration
{
    public function up()
    {        
        /** @var TYPE_NAME $tableOptions */
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%brands}}', [
            'id' => $this->primaryKey(),
            'brand' => $this->string(),
            'brand_logo' => $this->string(),
            'description' => $this->text(),
            'state' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'author' => $this->string(255),
        ], $tableOptions);

        $this->createIndex('idx_brand_id', '{{%brands}}', 'id');

    }

    public function down()
    {
        $this->dropTable('{{%brands}}');
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
