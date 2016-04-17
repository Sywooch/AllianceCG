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
            $this->insert('{{%positions}}', [
                'position' => 'Кредитный специалист',
            ]);  
            $this->insert('{{%positions}}', [
                'position' => 'Руководитель отдела кредитования',
            ]); 
            $this->insert('{{%positions}}', [
                'position' => 'Руководитель отдела сервиса',
            ]);   
            $this->insert('{{%positions}}', [
                'position' => 'Директор',
            ]);   
            $this->insert('{{%positions}}', [
                'position' => 'Ассистент сервиса',
            ]);    
            $this->insert('{{%positions}}', [
                'position' => 'Системный администратор',
            ]);   
            $this->insert('{{%positions}}', [
                'position' => 'Руководитель отдела IT',
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
            $this->insert('{{%positions}}', [
                'position' => 'Кредитный специалист',
            ]);  
            $this->insert('{{%positions}}', [
                'position' => 'Руководитель отдела кредитования',
            ]);   
            $this->insert('{{%positions}}', [
                'position' => 'Руководитель отдела сервиса',
            ]);   
            $this->insert('{{%positions}}', [
                'position' => 'Директор',
            ]);   
            $this->insert('{{%positions}}', [
                'position' => 'Ассистент сервиса',
            ]);    
            $this->insert('{{%positions}}', [
                'position' => 'Системный администратор',
            ]);   
            $this->insert('{{%positions}}', [
                'position' => 'Руководитель отдела IT',
            ]);                     
        }
    }

    public function down()
    {
        $this->dropTable('{{%positions}}');
    }    
    
}
