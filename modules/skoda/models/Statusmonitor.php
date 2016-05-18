<?php

namespace app\modules\skoda\models;

use Yii;
use app\modules\skoda\Module;
use app\modules\admin\models\User;
use app\modules\skoda\models\Statusmonitor;
use app\modules\skoda\models\Servicesheduler;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
// use app\components\validators\WorkshedulerValidator;

/**
 * This is the model class for table "{{%statusmonitor}}".
 *
 * @property integer $id
 * @property integer $regnumber
 * @property string $from
 * @property string $to
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

    const STATUS_BLOCKED = 1;
    const STATUS_ACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%statusmonitor}}';
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function () {
                    return date('U');
                },
            ],
        ];
    }

    public function getCarWorkStatus() 
    {
        $today = Yii::$app->formatter->asDatetime(date('Y-m-d H:i:s'));
        if (strtotime($today) < strtotime($this->from)){
            $carstatus = 'Ожидание';
        }
        elseif (strtotime($today) >= strtotime($this->from) && strtotime($today) < strtotime($this->to)) {
            $carstatus = 'В работе';
        }
        elseif (strtotime($today) >= strtotime($this->to)) {
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
        $today = Yii::$app->formatter->asDatetime(date('Y-m-d H:i:s'));
        if (strtotime($today) < strtotime($this->from)){
            $cssclass = 'progress-bar-warning progress-lg';
        }
        elseif (strtotime($today) >= strtotime($this->from) AND strtotime($today) < strtotime($this->to)) {
            $cssclass = 'progress-bar-danger progress-lg';
        }
        elseif (strtotime($today) >= strtotime($this->to)) {
            $cssclass = 'progress-bar-success progress-lg';
        }    

        return $cssclass;        
    }   

    public function getStatusBarAnimation()
    {
        $today = Yii::$app->formatter->asDatetime(date('Y-m-d H:i:s'));
        if (strtotime($today) >= strtotime($this->from) AND strtotime($today) < strtotime($this->to)) {
            $animcssclass = 'active progress-striped';
        }
        else {
            $animcssclass = ' ';
        }    

        return $animcssclass;        
    }
    
    public function getResponsible()
    {
        $to_date = Yii::$app->formatter->asDate($this->to, 'yyyy-MM-dd');
        $wcs = Servicesheduler::find()
            ->joinWith(['responsibles'])
            ->where(['date' => $to_date])
            ->all();

        foreach ($wcs as $wc) {
            // $worker = $wc->responsible;
            $worker = $wc->responsibles->name . ' ' . $wc->responsibles->surname;
            return $worker;
        }
    }   

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['regnumber', 'from', 'to'], 'required'],
            [['from', 'to', 'regnumber'], 'safe'],
            ['to', 'validateWorkshedulerTo'],
            ['from', 'validateWorkshedulerFrom'],
            [['responsible', 'regnumber'], 'string', 'max' => 255],
            ['author', 'default', 'value' => Yii::$app->user->getId()],
        ];
    }

    public function getStatesName()
    {
        return ArrayHelper::getValue(self::getStatesArray(), $this->state);
    }

    public static function getStatesArray()
    {
        return [
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_BLOCKED => 'Заблокирован',
        ];
    }  

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'regnumber' => Module::t('module', 'STATUS_REGNUMBER'),
            'from' => Module::t('module', 'STATUS_FROM'),
            'to' => Module::t('module', 'STATUS_TO'),
            'worker' => Module::t('module', 'STATUS_RESPONSIBLE'),
            'carstatus' => Module::t('module', 'STATUS_STATUS'),
            'progress' => Module::t('module', 'STATUS_PROGRESS'),
            'author' => Module::t('module', 'AUTHOR'),
            'authorname' => Module::t('module', 'AUTHOR'),
            'created_at' => Module::t('module', 'CREATED_AT'),
            'updated_at' => Module::t('module', 'UPDATED_AT'),
        ];
    }

    public function validateWorkshedulerTo($to, $params)
    {
            $to_date = Yii::$app->formatter->asDate($this->to, 'yyyy-MM-dd');
            $from_date = Yii::$app->formatter->asDate($this->from, 'yyyy-MM-dd');
            $wcs = Servicesheduler::find()
                ->where(['date' => $to_date])
                ->one();
    
            if(empty($wcs->responsible))                
            {
                $this->addError('to', Module::t('module', 'ERROR_WORKSHEDULER_DOES_NOT_EXIST_TO'));
            }
    }

    public function validateWorkshedulerFrom($from, $params)
    {            
        $from_date = Yii::$app->formatter->asDate($this->from, 'yyyy-MM-dd');
        $wcs = Servicesheduler::find()
            ->where(['date' => $from_date])
            ->one();
    
        if(empty($wcs->responsible))                
        {
            $this->addError('from', Module::t('module', 'ERROR_WORKSHEDULER_DOES_NOT_EXIST_FROM'));
        }
    }  

    public function workerevent() {
        $today = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
        $wcs = Servicesheduler::find()
            ->where(['date' => $today])
            ->one();
    
        if(empty($wcs->responsible))                
        {            
            $worker_result = Yii::$app->formatter->asDate('now', 'dd/MM/yyyy') . ' - ' . Module::t('module', 'MASTER_CONSULTANT_DOES_NOT_EXIST_TODAY');
        }
        else
        {
            $worker_result = Yii::$app->formatter->asDate($wcs->date, 'dd/MM/yyyy') . ' - ' . Module::t('module', 'CURRENT_MASTER_CONSULTANT') .' - '. $wcs->responsible;
        }   
        
        return $worker_result;
        
    }  

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorname()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }       

}
