<?php

use yii\db\Migration;

/**
 * Handles the creation for table `dutylist_table`.
 */
class m160709_071042_create_dutylist_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%dutylist}}', [
            'id' => $this->primaryKey(),
            'employee_id' =>$this->integer()->notNull(),
            'date' => $this->date(),
            'state' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'author' => $this->string(255),
        ]);

        $this->createIndex('idx-employeeid', '{{%dutylist}}', 'employee_id');

        $this->addForeignKey('fk-employeeid', '{{%dutylist}}', 'employee_id', '{{%employees}}', 'id','CASCADE','RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%dutylist}}');
    }
}
