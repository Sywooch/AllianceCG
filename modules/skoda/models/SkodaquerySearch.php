<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\skoda\models;

use Yii;
use yii\base\Model;
use yii\helpers\Json;

/**
 * DefaultSearch represents the model behind the search form about `app\modules\status\models\DefaultSearch`.
 */
class SkodaquerySearch extends Model
{

    public $workerload;
    public $data_worker;
    public $cata_car;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return $items
     */
    public function serviceworkerloadquery()
    {
//        $items = Yii::$app->db->createCommand("SELECT DISTINCT(`responsible`) AS worker, COUNT(all_statusmonitor.regnumber) AS carcount FROM all_servicesheduler INNER JOIN all_statusmonitor ON date = DATE_FORMAT(`to`, '%Y-%m-%d') AND YEAR(date) = YEAR(NOW()) AND MONTH(date) = MONTH(NOW()) GROUP BY worker")->queryAll();
//        
    // $query = "SELECT DISTINCT(`responsible`) AS worker, COUNT({{%statusmonitor.regnumber}}) AS carcount FROM {{%servicesheduler}} INNER JOIN {{%statusmonitor}} ON date = DATE_FORMAT(`to`, '%Y-%m-%d') AND YEAR(date) = YEAR(NOW()) AND MONTH(date) = MONTH(NOW()) GROUP BY worker";
    $query = "SELECT
                DISTINCT(CONCAT({{%employees}}.`name`, ' ', {{%employees}}.`surname`)) AS `worker`,
                COUNT({{%statusmonitor}}.`regnumber`) AS carcount 
            FROM 
                {{%servicesheduler}}
            INNER JOIN 
                {{%statusmonitor}}
            ON 
                date = DATE_FORMAT(`to`, '%Y-%m-%d')
            AND
                YEAR(date) = YEAR(NOW()) 
            AND
                MONTH(date) = MONTH(NOW())
            LEFT JOIN
                {{%employees}}
            ON 
                {{%employees}}.`id` = {{%servicesheduler}}.`responsible`
            GROUP BY
                `worker`";

        $items = Yii::$app->db->createCommand($query)->queryAll();
        foreach ($items as $row){
            $data_worker[] = [$row['worker'],(int)$row['carcount']];
        }
        if(!empty($data_worker)){
            return Json::encode($data_worker);            
        }
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return $items
     */
    public function statusmonitorquery()
    {
        $items = Yii::$app->db->createCommand("SELECT DATE_FORMAT(`to`, '%Y-%m-%d') as date, COUNT(`regnumber`) AS car FROM {{%statusmonitor}} WHERE MONTH(DATE_FORMAT(`to`, '%Y-%m-%d')) = MONTH(CURDATE()) GROUP BY date")->queryAll();
        foreach ($items as $row){
             $data_car[] = [$row['date'],(int)$row['car']];
        }
        if(!empty($data_car)){
            return Json::encode($data_car);
        }
    }


}
