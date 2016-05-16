<?php

use yii\db\Migration;

/**
 * Handles the creation for table `client_circulation_table`.
 */
class m160516_063756_create_client_circulation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%client_circulation}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'phone' => $this->string('16'),
            'email' => $this->string(),
            // 'region' => $this->string(),
            'state' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'author' => $this->string(255),
            'region_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%client_circulation}}');
    }
}
