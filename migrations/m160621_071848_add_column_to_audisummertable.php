<?php

use yii\db\Migration;

/**
 * Handles adding column to table `audisummertable`.
 */
class m160621_071848_add_column_to_audisummertable extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%audisummertable}}', 'discount', $this->integer());
        $this->addColumn('{{%audisummertable}}', 'price_discount', $this->integer());        
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
    }
}
