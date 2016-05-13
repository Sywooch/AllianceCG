<?php

use yii\db\Migration;

/**
 * Handles the creation for table `models_table`.
 */
class m160513_194235_create_models_table extends Migration
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

        $this->createTable('{{%models}}', [
            'id' => $this->primaryKey(),
            'brand_id' => $this->integer()->notNull(),
            'model_name' => $this->string(),
            'body_type' => $this->string(),
        ], $tableOptions);

        $this->createIndex('idx-models-brandid', '{{%models}}', 'brand_id');
        $this->addForeignKey('fk-models-brandid', '{{%models}}', 'brand_id', '{{%brands}}', 'id','CASCADE','RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%%models}}');
    }
}
