<?php

namespace app\modules\alliance\models;

use Yii;
use yii\base\Model;
use yii\helpers\Json;
use app\modules\alliance\models\Creditcalendar;
use app\modules\alliance\models\ClientCirculation;
use app\modules\alliance\models\Clientcirculationcomment;

// use app\modules\admin\models\User;
// use yii\behaviors\TimestampBehavior;
// use yii\helpers\ArrayHelper;
// use app\modules\references\models\Regions;
// use yii\helpers\Html;
// use app\modules\alliance\models\Clientcirculationcomment;
// use app\modules\references\models\Employees;
// use app\modules\references\models\Brands;

class AllianceDefault extends Model
{
    public function getCreditcalendarcount()
    {
        return Creditcalendar::find()->count();
    }

    public function getClientcirculationcount()
    {
        return ClientCirculation::find()->where(['state' => ClientCirculation::STATUS_ACTIVE])->count();
    }

    public function getClientcirculationcommentcount()
    {
        return Clientcirculationcomment::find()->where(['state' => Clientcirculationcomment::STATUS_ACTIVE])->count();
    }

    public function getCreditlastcount()
    {
        // $query = 
        //     "SELECT 
        //         DISTINCT(DATE_FORMAT(FROM_UNIXTIME(`created_at`), '%d/%m/%Y')) AS `date`, 
        //         COUNT(id) AS `recordscount`
        //     FROM 
        //         {{%calendar}}
        //     GROUP BY
        //         `date`
        //     LIMIT 5"
        //     ;

        $query = 
            "SELECT 
                -- DISTINCT({{%calendar}}.`status`) AS `status`,  
                CASE {{%calendar}}.`status`
                   WHEN '0' THEN 'В работе'
                   WHEN '1' THEN 'Уточнение'
                   WHEN '2' THEN 'Завершено'
                   ELSE 'Неопределен'
                   END as status,
               COUNT({{%calendar}}.`id`) AS `statuses` FROM {{%calendar}}
            GROUP BY 
               `status`
            "
            ;

        $items = Yii::$app->db->createCommand($query)->queryAll();        
        foreach ($items as $row){
            $data_creditlastcount[] = [$row['status'],(int)$row['statuses']];
        }
        return Json::encode($data_creditlastcount);        
    }
}
