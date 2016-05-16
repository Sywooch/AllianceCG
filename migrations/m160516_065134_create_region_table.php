<?php

use yii\db\Migration;

/**
 * Handles the creation for table `region_table`.
 */
class m160516_065134_create_region_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%regions}}', [
            'id' => $this->primaryKey(),
            'region_name' => $this->string(),
            'region_code' => $this->integer('5'),
            'state' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'author' => $this->string(255),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%regions}}');
    }
}
