<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\helpers\Json;

/**
 * DefaultSearch represents the model behind the search form about `app\modules\status\models\DefaultSearch`.
 */
class CreditcalendarquerySearch extends Model
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
    public function companyuserscount()
    {
        $items = Yii::$app->db->createCommand("SELECT DISTINCT(company) as company, COUNT(id) AS users FROM {{%user}} GROUP BY company")->queryAll();
        foreach ($items as $row){
            $data_company[] = [$row['company'],(int)$row['users']];
        }
        return Json::encode($data_company);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return $items
     */
    public function userscreated()
    {
        $items = Yii::$app->db->createCommand("SELECT DISTINCT(DATE_FORMAT(FROM_UNIXTIME(created_at), '%Y-%m-%d')) AS date, COUNT(id) AS userscount FROM {{%user}} GROUP BY date")->queryAll();
        foreach ($items as $row){
            $data_user[] = [$row['date'],(int)$row['userscount']];
        }
        return Json::encode($data_user);
    }


}
