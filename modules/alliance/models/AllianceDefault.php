<?php

namespace app\modules\alliance\models;

use Yii;
use yii\base\Model;
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
}
