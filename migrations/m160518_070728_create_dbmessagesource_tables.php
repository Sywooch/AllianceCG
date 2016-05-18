<?php

use yii\db\Migration;

/**
 * Handles the creation for table `dbmessagesource_tables`.
 */
class m160518_070728_create_dbmessagesource_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%source_message}}', [
            'id' => 'INT(11) AUTO_INCREMENT',
            'category' => 'VARCHAR(32)',
            'message' => 'TEXT',
            'PRIMARY KEY (id)',
        ]);
        $this->createTable('{{%message}}', [
            'id' => 'INT(11)',
            'language' => 'VARCHAR(16)',
            'translation' => 'TEXT',
            'PRIMARY KEY (id,language)',
        ]);

        $this->addForeignKey('fk_message_source_message', '{{%message}}', 'id', '{{%source_message}}', 'id','CASCADE','RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%source_message}}');
        $this->dropTable('{{%message}}');
    }
}
