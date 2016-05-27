<?php

namespace app\modules\alliance\models;

use Yii;
use app\modules\admin\models\User;
use yii\behaviors\TimestampBehavior;
use app\modules\alliance\Module;
use yii\helpers\ArrayHelper;
use app\modules\references\models\Regions;
use yii\helpers\Html;
use app\modules\alliance\models\Clientcirculationcomment;

/**
 * This is the model class for table "{{%client_circulation}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $region
 * @property integer $state
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $author
 * @property integer $region_id
 */
class ClientCirculation extends \yii\db\ActiveRecord
{

    public $globalSearch;
    public $contact_type;
    public $target;
    public $car_model;
    public $comment;

    const STATUS_BLOCKED = 1;
    const STATUS_ACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%client_circulation}}';
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
            [['state', 'created_at', 'updated_at', 'region_id'], 'integer'],
            [['name', 'email', 'author'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 18],
            [['globalSearch'], 'safe'],
            ['author', 'default', 'value' => Yii::$app->user->getId()],
            [['name', 'phone', 'region_id', 'employee_id'], 'required'],
            [['phone', 'email'], 'unique'],
            ['email', 'email'],
            [['contact_type', 'target', 'car_model', 'comment'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'CLIENTNAME'),
            'phone' => Yii::t('app', 'PHONE'),
            'email' => Yii::t('app', 'EMAIL'),
            'state' => Yii::t('app', 'STATE'),
            'created_at' => Yii::t('app', 'CREATED_AT'),
            'updated_at' => Yii::t('app', 'UPDATED_AT'),
            'author' => Yii::t('app', 'AUTHOR'),
            'region_id' => Yii::t('app', 'REGION'),
            'regions' => Yii::t('app', 'REGION'),
            'authorname' => Yii::t('app', 'AUTHOR'),
            'employee_id' => Yii::t('app', 'EMPLOYEE'),
            'contact_type' => Yii::t('app', 'CONTACT_TYPE'),
            'target' => Yii::t('app', 'TARGET'),
            'car_model' => Yii::t('app', 'CAR_MODEL'),
            'comment' => Yii::t('app', 'COMMENT'),
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
    public function getRegions()
    {
        return $this->hasOne(Regions::className(), ['id' => 'region_id']);
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

    public function getRegionslink()
    {
        $link = isset($this->regions->region_name) ? Html::a($this->regions->region_name, ['/references/regions/view', 'id' => $this->regions->id]) : false;
        // Html::a($model->companies->company_name, ['/references/companies/view', 'id' => $model->companies->id]),
        return $link;
    } 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientcomment()
    {
        return $this->hasMany(Clientcirculationcomment::className(), ['clientcirculation_id' => 'id']);
    }   
}
