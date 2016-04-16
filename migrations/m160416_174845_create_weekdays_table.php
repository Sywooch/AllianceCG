<?php

use yii\db\Migration;

class m160416_174845_create_weekdays_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%weekdays}}', [
            'id' => $this->primaryKey(),
            'daynumber' => $this->smallInteger(1),
            'dayname' => $this->string(),
        ]);
        $this->insert('{{%weekdays}}', [
            'daynumber' => '1',
            'dayname' => 'Пн',
        ]);
        $this->insert('{{%weekdays}}', [
            'daynumber' => '2',
            'dayname' => 'Вт',
        ]);
        $this->insert('{{%weekdays}}', [
            'daynumber' => '3',
            'dayname' => 'Ср',
        ]);
        $this->insert('{{%weekdays}}', [
            'daynumber' => '4',
            'dayname' => 'Чт',
        ]);
        $this->insert('{{%weekdays}}', [
            'daynumber' => '5',
            'dayname' => 'Пт',
        ]);
        $this->insert('{{%weekdays}}', [
            'daynumber' => '6',
            'dayname' => 'Сб',
        ]);
        $this->insert('{{%weekdays}}', [
            'daynumber' => '7',
            'dayname' => 'Вс',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%weekdays}}');
    }
}
