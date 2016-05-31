<?php

use yii\db\Migration;

/**
 * Handles the creation for table `clientcirculationcomment_table`.
 */
class m160518_102534_create_clientcirculationcomment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%clientcirculationcomment}}', [
            'id' => $this->primaryKey(),
            'clientcirculation_id' => $this->integer()->notNull(),
            'contact_type' => $this->string(),
            'target' => $this->string(),
            'car_model' => $this->string(),
            'sales_manager_id' => $this->integer()->notNull(),
            'credit_manager_id' => $this->integer()->notNull()
            'comment' => $this->text(),
            'state' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'sales_manager_id' => $this->integer()->notNull(),
            'credit_manager_id' => $this->integer()->notNull(),
            'author' => $this->string(255),
        ]);

        $this->createIndex('idx-clientctid', '{{%clientcirculationcomment}}', 'clientcirculation_id');

        $this->addForeignKey('fk-clientctid', '{{%clientcirculationcomment}}', 'clientcirculation_id', '{{%client_circulation}}', 'id','CASCADE','RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%clientcirculationcomment}}');
    }
}
