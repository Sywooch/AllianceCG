<?php

namespace app\modules\skoda\models;

use Yii;
use app\modules\skoda\Module;
use app\modules\admin\models\User;
use app\modules\skoda\models\Statusmonitor;
use app\modules\skoda\models\Servicesheduler;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%statusmonitor}}".
 *
 * @property integer $id
 * @property integer $regnumber
 * @property string $from
 * @property string $to
 * @property string $responsible
 * @property integer $status
 */
class Statusmonitor extends \yii\db\ActiveRecord
{

    public $carstatus;
    public $allname;
    public $progress;
    public $timeformat;
    public $worker;

    const STATUS_FINISHED = 0;
    const STATUS_ATWORK = 1;
    const STATUS_WAIT = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%statusmonitor}}';
    }

    public function getCarWorkStatus() 
    {
        // $today = Yii::$app->getFormatter()->asDatetime(time());
        $today = Yii::$app->formatter->asDatetime(date('Y-m-d H:i:s'));
        if (strtotime($today) < strtotime($this->from)){
            $carstatus = 'Ожидание';
        }
        elseif (strtotime($today) >= strtotime($this->from) && strtotime($today) < strtotime($this->to)) {
            // print 'В работе';
            $carstatus = 'В работе';
        }
        elseif (strtotime($today) >= strtotime($this->to)) {
            // print 'Готово';
            $carstatus = 'Готово';
        }

        return $carstatus;
    }  

    public function getPercentStatusBar()
    {

        $today = Yii::$app->formatter->asDatetime(date('Y-m-d H:i:s'));

        if (strtotime($today) < strtotime($this->from)){
            $percent = '0';
        }
        elseif (strtotime($today) >= strtotime($this->from) && strtotime($today) < strtotime($this->to)) {
            $datetime1 = $this->from;
            $datetime2 = $this->to;
            $diff1 = strtotime($datetime2) - strtotime($datetime1);
            $diff2 = strtotime($today) - strtotime($datetime1);            
            $percent = intval(($diff2 / $diff1) * 100);

        }
        elseif (strtotime($today) >= strtotime($this->to)) {
            $percent = '100';
        }    

        return $percent;   
    } 

    public function getColorStatusBar()
    {
        // $today = Yii::$app->getFormatter()->asDatetime(time());
        $today = Yii::$app->formatter->asDatetime(date('Y-m-d H:i:s'));
        if (strtotime($today) < strtotime($this->from)){
            $cssclass = 'progress-bar-warning';
        }
        elseif (strtotime($today) >= strtotime($this->from) AND strtotime($today) < strtotime($this->to)) {
            $cssclass = 'progress-bar-danger';
        }
        elseif (strtotime($today) >= strtotime($this->to)) {
            $cssclass = 'progress-bar-success';
        }    

        return $cssclass;        
    }   

    // public function getFromDateFormat()
    // {
    //     // $today = Yii::$app->getFormatter()->asDatetime(time());
    //     $today = Yii::$app->formatter->asDatetime(date('Y-m-d h:i:s'));
    //     $smon = new Statusmonitor();
    //     if (strtotime($today) < strtotime($smon->from)){
    //         $timeformat = 'datetime';
    //     }
    //     elseif (strtotime($today) >= strtotime($smon->from) AND strtotime($today) < strtotime($smon->to)) {
    //         $timeformat = 'time';
    //     }
    //     elseif (strtotime($today) >= strtotime($smon->to)) {
    //         $timeformat = 'datetime';
    //     }    

    //     return $timeformat;        
    // }         

    public static function getFromDateFormat()
    {

        $today = Yii::$app->formatter->asDatetime(date('Y-m-d H:i:s'));
        $smon = new Statusmonitor();
        if (strtotime($today) < strtotime($smon->from)){
            $timeformat = 'datetime';
        }
        elseif (strtotime($today) >= strtotime($smon->from) AND strtotime($today) < strtotime($smon->to)) {
            $timeformat = 'time';
        }
        elseif (strtotime($today) >= strtotime($smon->to)) {
            $timeformat = 'datetime';
        }    

        return $timeformat;        
    }          

    public function getUserNameById()
    {
        $names = User::find()
            ->where(['id' => $this->responsible])
            ->all();
            
        foreach ($names as $key => $value) {
            $allname = $value->name . ' ' . $value->surname;
        return $allname;
        }

    }

    public function getResponsible()
    {
        $wcs = Servicesheduler::find()
            ->where(['date' => $this->to])
            ->all();

        foreach ($wcs as $wc) {
            $worker = $wc->responsible;
            return $worker;
        }
    }    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['regnumber', 'responsible'], 'required'],
            // [['status'], 'integer'],
            [['from', 'to', 'regnumber', 'responsible'], 'safe'],
            [['responsible', 'regnumber'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'regnumber' => Module::t('module', 'STATUS_REGNUMBER'),
            'from' => Module::t('module', 'STATUS_FROM'),
            'to' => Module::t('module', 'STATUS_TO'),
            'responsible' => Module::t('module', 'STATUS_RESPONSIBLE'),
            'carstatus' => Module::t('module', 'STATUS_STATUS'),
            'progress' => Module::t('module', 'STATUS_PROGRESS'),
        ];
    }
}
