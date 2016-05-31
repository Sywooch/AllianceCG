<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `clientcirculationcomment`.
 */
class m160531_115313_add_columns_to_clientcirculationcomment extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%clientcirculationcomment}}', 'sales_manager_id', $this->integer()->notNull());
        $this->addColumn('{{%clientcirculationcomment}}', 'credit_manager_id', $this->integer()->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
    }
}
