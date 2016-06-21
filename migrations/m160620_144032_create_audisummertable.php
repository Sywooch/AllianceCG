<?php

use yii\db\Migration;

/**
 * Handles the creation for table `audisummertable`.
 */
class m160620_144032_create_audisummertable extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%audisummertable}}', [
            'id' => $this->primaryKey(),
            'model' => $this->string(),
            'body_color' => $this->string(),
            'discount_percent' => $this->integer(),
            'price' => $this->integer(),
            // 'discount_price' => $this->integer(),
            'payment' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%audisummertable}}');
    }
}
