<?php

use yii\db\Migration;

class m160410_194028_create_default_positions extends Migration
{   
    public function up()
    { 
        $table = Yii::$app->db->schema->getTableSchema('{{%positions}}');
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        if (!empty($table)) {
            $this->insert('{{%positions}}', [
                'position' => 'Мастер-консультант',
            ]); 
            $this->insert('{{%positions}}', [
                'position' => 'Администратор',
            ]);  
        }
        else
        {        
            $this->createTable('{{%positions}}', [
                'id' => $this->primaryKey(),
                'position' => $this->string(255),
                'description' => $this->text(),
            ], $tableOptions);

            $this->insert('{{%positions}}', [
                'position' => 'Мастер-консультант',
            ]); 
            $this->insert('{{%positions}}', [
                'position' => 'Администратор',
            ]);             
        }
    }

    public function down()
    {
        $this->dropTable('{{%positions}}');
    }    
    
}
