<?php

use yii\db\Migration;

/**
 * Handles the creation for table `targets_table`.
 */
class m160511_134630_create_targets_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        /** @var TYPE_NAME $tableOptions */
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%targets}}', [
            'id' => $this->primaryKey(),
            'target' => $this->string(),
            'state' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%targets}}');
    }
}
