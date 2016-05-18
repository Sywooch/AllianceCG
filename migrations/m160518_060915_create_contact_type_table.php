<?php

use yii\db\Migration;

/**
 * Handles the creation for table `contact_type_table`.
 */
class m160518_060915_create_contact_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%contact_type}}', [
            'id' => $this->primaryKey(),
            'contact_type' => $this->string(),
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
        $this->dropTable('{{%contact_type}}');
    }
}
