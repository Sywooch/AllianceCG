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
        $items = Yii::$app->db->createCommand("SELECT DISTINCT(`responsible`) AS worker, COUNT(sk_statusmonitor.regnumber) AS carcount FROM sk_servicesheduler INNER JOIN sk_statusmonitor ON date = DATE_FORMAT(`to`, '%Y-%m-%d') AND YEAR(date) = YEAR(NOW()) AND MONTH(date) = MONTH(NOW()) GROUP BY worker")->queryAll();
        foreach ($items as $row){
            $data_worker[] = [$row['worker'],(int)$row['carcount']];
        }
        return Json::encode($data_worker);
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
        $items = Yii::$app->db->createCommand("SELECT DATE_FORMAT(`to`, '%Y-%m-%d') as date, COUNT(`regnumber`) AS car FROM sk_statusmonitor WHERE MONTH(DATE_FORMAT(`to`, '%Y-%m-%d')) = MONTH(CURDATE()) GROUP BY date")->queryAll();
        foreach ($items as $row){
             $data_car[] = [$row['date'],(int)$row['car']];
        }
        return Json::encode($data_car);
    }


}
