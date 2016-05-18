<?php

namespace app\modules\skoda\models;

use Yii;
use app\modules\skoda\Module;
use app\modules\skoda\models\Servicesheduler;
use app\modules\references\models\Employees;
use yii\behaviors\TimestampBehavior;
use app\modules\admin\models\User;

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
            'id' => Module::t('module', 'ID'),
            'date' => Module::t('module', 'WORKSHEDULER_DATE'),
            'responsible' => Module::t('module', 'WORKSHEDULER_RESPONSIBLE'),
            'author' => Module::t('module', 'AUTHOR'),
            'authorname' => Module::t('module', 'AUTHOR'),
            'created_at' => Module::t('module', 'CREATED_AT'),
            'updated_at' => Module::t('module', 'UPDATED_AT'),
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

}
