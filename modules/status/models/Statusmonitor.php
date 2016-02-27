<?php

namespace app\modules\status\models;

use Yii;
use app\modules\status\Module;
use app\modules\admin\models\User;
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
        $today = Yii::$app->getFormatter()->asDatetime(time());
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
        $today = Yii::$app->getFormatter()->asDatetime(time());
        if (strtotime($today) < strtotime($this->from)){
            $percent = '0';
        }
        elseif (strtotime($today) >= strtotime($this->from) && strtotime($today) < strtotime($this->to)) {
            $percent = '50';
        }
        elseif (strtotime($today) >= strtotime($this->to)) {
            $percent = '100';
        }    

        return $percent;        
    } 

    public function getFromDateFormat()
    {
        // $today = Yii::$app->getFormatter()->asDatetime(time());

        // if (strtotime($today) <= strtotime($this->from)){
        //     $df = 'datetime';
        // }
        // else
        // {
        //     $df = 'time';
        // }

        // return $df;      
        $df = 'datetime';
        return (string)$df;
    }    


    public function getColorStatusBar()
    {
        $today = Yii::$app->getFormatter()->asDatetime(time());
        if (strtotime($today) < strtotime($this->from)){
            $cssclass = 'progress-bar-warning';
        }
        elseif (strtotime($today) >= strtotime($this->from) && strtotime($today) < strtotime($this->to)) {
            $cssclass = 'progress-bar-danger';
        }
        elseif (strtotime($today) >= strtotime($this->to)) {
            $cssclass = 'progress-bar-success';
        }    

        return $cssclass;        
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
