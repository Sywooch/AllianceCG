<?php

use yii\db\Migration;

/**
 * Handles the creation for table `bodytypes_table`.
 */
class m160514_083501_create_bodytypes_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%bodytypes}}', [
            'id' => $this->primaryKey(),
            'body_type' => $this->string(),
            'description' => $this->text(),
            'state' => $this->integer()->notNull()->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%bodytypes}}');
    }
}
