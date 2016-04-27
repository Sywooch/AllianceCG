<?php

use yii\db\Migration;

class m160427_202141_create_calendar_location_table extends Migration
{
    /**
     *
     */
    public function up()
    {
        /** @var TYPE_NAME $tableOptions */
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        /** @var TYPE_NAME $this */
        $this->createTable('{{%calendar_locations}}', [
            'id' => $this->primaryKey(),
            'calendar_id' => $this->integer()->notNull(),
            'company_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-loc-calid', '{{%calendar_locations}}', 'calendar_id');
        $this->createIndex('idx-loc-callocid', '{{%calendar_locations}}', 'company_id');

        $this->addForeignKey('fk-loc-calid', '{{%calendar_locations}}', 'calendar_id', '{{%calendar}}', 'id','CASCADE','RESTRICT');
        $this->addForeignKey('fk-oc-callocid', '{{%calendar_locations}}', 'company_id', '{{%companies}}', 'id','RESTRICT','RESTRICT');
    }

    /**
     *
     */
    public function down()
    {
        $this->dropTable('{{%calendar_locations}}');
    }
}
