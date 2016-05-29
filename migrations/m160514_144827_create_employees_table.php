<?php

use yii\db\Migration;

/**
 * Handles the creation for table `employees_table`.
 */
class m160514_144827_create_employees_table extends Migration
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
        
        $this->createTable('{{%employees}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'surname' => $this->string(),
            'patronimyc' => $this->string(),
            'photo' => $this->string(),
            'company_id' => $this->integer()->notNull(),
            'department_id' => $this->integer()->notNull(),
            'position_id' => $this->integer()->notNull(),
            'brand_id' => $this->integer()->notNull(),
            'state' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'author' => $this->string(255),
        ], $tableOptions);

        $this->createIndex('idx-companyid', '{{%employees}}', 'company_id');
        $this->createIndex('idx-departmentid', '{{%employees}}', 'department_id');
        $this->createIndex('idx-positionid', '{{%employees}}', 'position_id');
        $this->createIndex('idx-brandid', '{{%employees}}', 'brand_id');

        $this->addForeignKey('fk-companyid', '{{%employees}}', 'company_id', '{{%companies}}', 'id','CASCADE','RESTRICT');
        $this->addForeignKey('fk-departmentid', '{{%employees}}', 'department_id', '{{%departments}}', 'id','CASCADE','RESTRICT');
        $this->addForeignKey('fk-positionid', '{{%employees}}', 'position_id', '{{%positions}}', 'id','CASCADE','RESTRICT');
        // $this->addForeignKey('fk-brandid', '{{%employees}}', 'brand_id', '{{%brands}}', 'id','CASCADE','RESTRICT');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%employees}}');
    }
}
