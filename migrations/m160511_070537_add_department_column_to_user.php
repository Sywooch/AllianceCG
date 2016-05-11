<?php

use yii\db\Migration;

/**
 * Handles adding department_column to table `user`.
 */
class m160511_070537_add_department_column_to_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%user}}', 'department', $this->integer()->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%user}}', 'department');
    }
}
