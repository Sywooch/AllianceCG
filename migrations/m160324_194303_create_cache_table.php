<?php

//use yii\db\Migration;

use yii\base\InvalidConfigException;
use yii\caching\DbCache;
use yii\db\Migration;

class m160324_194303_create_cache_table extends Migration
{
    
    /**
     * @throws yii\base\InvalidConfigException
     * @return DbCache
     */
    protected function getCache()
    {
        $cache = Yii::$app->getCache();
        if (!$cache instanceof DbCache) {
            throw new InvalidConfigException('You should configure "cache" component to use database before executing this migration.');
        }
        return $cache;
    }

    /**
     * @inheritdoc
     */
    public function up()
    {
        $cache = $this->getCache();
        $this->db = $cache->db;

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($cache->cacheTable, [
            'id' => $this->string(128)->notNull(),
            'expire' => $this->integer(),
            'data' => $this->binary(),
            'PRIMARY KEY ([[id]])',
            ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $cache = $this->getCache();
        $this->db = $cache->db;

        $this->dropTable($cache->cacheTable);
    }    
    
//    public function up()
//    {
//        $tableOptions = null;
//        if ($this->db->driverName === 'mysql') {
//            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
//        }
//
//        $this->createTable('{{%cache}}', [
//            'id' => $this->primaryKey(),
//            'expire' => $this->integer(11),
//            'data' => $this->binary(),
//        ], $tableOptions);
//
//        $this->createIndex('idx_cache_expire', '{{%cache}}', 'expire');
//    }
//
//    public function down()
//    {
//        $this->dropTable('{{%cache}}');
//    }
}
