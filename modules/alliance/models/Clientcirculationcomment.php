<?php

namespace app\modules\alliance\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\modules\references\models\Targets;
use app\modules\references\models\ContactType;
use app\modules\admin\models\User;
use app\modules\references\models\Employees;
use yii\helpers\Html;

/**
 * This is the model class for table "{{%clientcirculationcomment}}".
 *
 * @property integer $id
 * @property integer $clientcirculation_id
 * @property string $contact_type
 * @property string $target
 * @property string $car_model
 * @property string $comment
 * @property integer $state
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $author
 *
 * @property ClientCirculation $clientcirculation
 */
class Clientcirculationcomment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%clientcirculationcomment}}';
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
            // [['clientcirculation_id', 'created_at', 'updated_at'], 'required'],
            [['clientcirculation_id', 'state', 'created_at', 'updated_at'], 'integer'],
            [['comment'], 'string'],
            // [['contact_type', 'target', 'car_model', 'author'], 'string', 'max' => 255],
            // [['car_model', 'author'], 'string', 'max' => 255],
            [['clientcirculation_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClientCirculation::className(), 'targetAttribute' => ['clientcirculation_id' => 'id']],
            [['clientcirculation_id', 'contact_type', 'target', 'car_model', 'author', 'sales_manager_id', 'credit_manager_id', 'creditmanagers', 'salesmanagers'], 'safe'],
            [['contact_type', 'target'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'clientcirculation_id' => Yii::t('app', 'Clientcirculation ID'),
            'contact_type' => Yii::t('app', 'Contact Type'),
            'target' => Yii::t('app', 'Target'),
            'car_model' => Yii::t('app', 'Car Model'),
            'comment' => Yii::t('app', 'Comment'),
            'state' => Yii::t('app', 'State'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'author' => Yii::t('app', 'Author'),
            'authorname' => Yii::t('app', 'Author'),
            'sales_manager_id' => Yii::t('app', 'SALESMANAGER'),
            'credit_manager_id' => Yii::t('app', 'CREDITMANAGER'),
            'salesmanagers' => Yii::t('app', 'SALESMANAGER'),
            'creditmanagers' => Yii::t('app', 'CREDITMANAGER'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientcirculation()
    {
        return $this->hasOne(ClientCirculation::className(), ['id' => 'clientcirculation_id']);
    }

    public function getTargets()
    {
        return $this->hasOne(Targets::className(), ['id' => 'target']);
    }

    public function getContacttypes()
    {
        return $this->hasOne(ContactType::className(), ['id' => 'contact_type']);
    }

    public function getCreditmanagers()
    {
        return $this->hasOne(Employees::className(), ['id' => 'credit_manager_id']);
    }  

    public function getSalesmanagers()
    {
        return $this->hasOne(Employees::className(), ['id' => 'sales_manager_id']);
    }      

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorname()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }

    public function getSalesmanagerlink()
    {
        $link = isset($this->salesmanagers->fullName) ? Html::a($this->salesmanagers->fullName, ['/references/employees/view', 'id' => $this->salesmanagers->id]) : false;
        // Html::a($model->companies->company_name, ['/references/companies/view', 'id' => $model->companies->id]),
        return $link;
    }  

    public function getCreditmanagerlink()
    {
        $link = isset($this->creditmanagers->fullName) ? Html::a($this->creditmanagers->fullName, ['/references/employees/view', 'id' => $this->creditmanagers->id]) : false;
        // Html::a($model->companies->company_name, ['/references/companies/view', 'id' => $model->companies->id]),
        return $link;
    }      

}
