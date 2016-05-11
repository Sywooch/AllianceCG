<?php

use yii\db\Migration;

/**
 * Handles the creation for table `departments_table`.
 */
class m160511_070638_create_departments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%departments}}', [
            'id' => $this->primaryKey(),
            'department_name' => $this->string(),
            // 'user_id' => $this->integer()->notNull(),
        ]);

        // $this->createIndex('idx-departments', '{{%departments}}', 'user_id');
        // $this->addForeignKey('fk-departments', '{{%departments}}', 'user_id', '{{%user}}', 'id','CASCADE','RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%departments}}');
    }
}
