<?php

namespace app\modules\skoda\models;

use Yii;
use app\modules\skoda\models\Servicesheduler;
use app\modules\references\models\Employees;
use yii\behaviors\TimestampBehavior;
use app\modules\admin\models\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%servicesheduler}}".
 *
 * @property integer $id
 * @property string $date
 * @property integer $responsible
 */
class Servicesheduler extends \yii\db\ActiveRecord
{

    public $date_from;
    public $date_to;

    const CURRENT_BRAND = 'Skoda';

    const STATUS_BLOCKED = 1;
    const STATUS_ACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%servicesheduler}}';
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'responsible'], 'required'],
            [['date'], 'safe'],
            [['responsible'], 'safe'],
            [['date_from', 'date_to'], 'safe'],
            [['date'], 'unique'],
            [['responsible'], 'string'],
            ['author', 'default', 'value' => Yii::$app->user->getId()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'WORKSHEDULER_DATE'),
            'responsible' => Yii::t('app', 'WORKSHEDULER_RESPONSIBLE'),
            'author' => Yii::t('app', 'AUTHOR'),
            'authorname' => Yii::t('app', 'AUTHOR'),
            'created_at' => Yii::t('app', 'CREATED_AT'),
            'updated_at' => Yii::t('app', 'UPDATED_AT'),
            'responsibles' => Yii::t('app', 'WORKSHEDULER_RESPONSIBLE'),
            'state' => Yii::t('app', 'STATE'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorname()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    } 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsibles()
    {
        return $this->hasOne(Employees::className(), ['id' => 'responsible']);
    }

    public function workerevent() {
        $today = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
        $wcs = Servicesheduler::find()
            // ->joinWith('responsibles')
            ->where(['date' => $today])
            ->one();
    
        if(empty($wcs->responsible))                
        {            
            $worker_result = Yii::$app->formatter->asDate('now', 'dd/MM/yyyy') . ' - ' . Yii::t('app', 'MASTER_CONSULTANT_DOES_NOT_EXIST_TODAY');
        }
        else
        {
            $worker_result = Yii::$app->formatter->asDate($wcs->date, 'dd/MM/yyyy') . ' - ' . Yii::t('app', 'CURRENT_MASTER_CONSULTANT') .' - '. $wcs->responsibles->fullName;
        }   
        
        return $worker_result;
        
    }    

}
