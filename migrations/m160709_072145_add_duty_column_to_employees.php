<?php

use yii\db\Migration;

/**
 * Handles adding duty_column to table `employees`.
 */
class m160709_072145_add_duty_column_to_employees extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%employees}}', 'duty_status', $this->boolean());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
    }
}
