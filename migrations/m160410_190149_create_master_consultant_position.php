<?php

use yii\db\Migration;

class m160410_190149_create_master_consultant_position extends Migration
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
        }
    }

    public function down()
    {
        $this->dropTable('{{%positions}}');
    }    
    
}
