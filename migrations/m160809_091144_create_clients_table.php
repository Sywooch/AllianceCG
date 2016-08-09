<?php

use yii\db\Migration;

/**
 * Handles the creation for table `clients`.
 */
class m160809_091144_create_clients_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%clients}}', [
            'id' => $this->primaryKey(),
            'clientName' => $this->string(),
            'clientSurname' => $this->string(),
            'clientPatronymic' => $this->string(),
            'clientPhone' => $this->string(),
            'clientEmail' => $this->string(),
            'clientRegion' => $this->text(),
            'clientDepartment' => $this->integer(),
            'clientBithdayDate' => $this->date(),
            'state' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'author' => $this->string(255),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%clients}}');
    }
}
