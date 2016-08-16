<?php

namespace app\modules\skoda\models;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\User;
use app\modules\references\models\Departments;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
use yii\behaviors\BlameableBehavior;

use Yii;

/**
 * This is the model class for table "{{%clients}}".
 *
 * @property integer $id
 * @property string $clientName
 * @property string $clientSurname
 * @property string $clientPatronymic
 * @property string $clientPhone
 * @property string $clientEmail
 * @property integer $clientDepartment
 * @property string $clientBithdayDate
 * @property integer $state
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $author
 */
class Clients extends \yii\db\ActiveRecord
{
    const STATUS_BLOCKED = 1;
    const STATUS_ACTIVE = 0;

    const SALES_DEPARTMENT_ID = 3;
    const SERVICE_DEPARTMENT_ID = 4;

    public $clientShortName;
    public $clientFullName;
    // public $auhorname;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%clients}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'is_deleted' => true
                ],
                'replaceRegularDelete' => true,
            ],  
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
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

    public function beforeSoftDelete()
    {
        $this->deleted_at = date('U');
        $this->deleted_by = Yii::$app->user->getId();
        $this->update();
        return true;
    }    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientPhone', 'clientEmail'], 'unique'],
            [['clientEmail'], 'email'],
            [['clientDepartment', 'created_at', 'updated_at', 'created_by', 'updated_by', 'deleted_at', 'deleted_by'], 'integer'],
            [['clientBithdayDate', 'clientPhone', 'clientFullName', 'deleted_at', 'deleted_by'], 'safe'],
            // ['author', 'default', 'value' => Yii::$app->user->getId()],
            [['clientName', 'clientSurname', 'clientPatronymic', 'clientPhone', 'clientEmail'], 'string', 'max' => 255],
        ];
    }

    public function getStatesName()
    {
        return ArrayHelper::getValue(self::getStatesArray(), $this->is_deleted);
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
            'id' => Yii::t('app', 'ID'),
            'clientShortName' => Yii::t('app', 'Client Short Name'),
            'clientFullName' => Yii::t('app', 'Client Full Name'),
            'clientName' => Yii::t('app', 'Client Name'),
            'clientSurname' => Yii::t('app', 'Client Surname'),
            'clientPatronymic' => Yii::t('app', 'Client Patronymic'),
            'clientPhone' => Yii::t('app', 'Client Phone'),
            'clientEmail' => Yii::t('app', 'Client Email'),
            'clientDepartment' => Yii::t('app', 'Client Department'),
            'clientBithdayDate' => Yii::t('app', 'Client Bithday Date'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
            'clientRegion' => Yii::t('app', 'Client Region'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            // 'author' => Yii::t('app', 'Author'),
        ];
    }

    public function getClientshortname()
    {
        return $this->clientSurname . ' ' . mb_strtoupper(mb_substr($this->clientName,0,1, 'UTF-8'), 'UTF-8') . '.' . mb_strtoupper(mb_substr($this->clientPatronymic,0,1, 'UTF-8'), 'UTF-8') . '.';
    }

    public function getClientfullname()
    {
        return $this->clientSurname . ' ' . $this->clientName . ' ' . $this->clientPatronymic;
    }    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }   

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    } 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeleter()
    {
        return $this->hasOne(User::className(), ['id' => 'deleted_by']);
    }     

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Departments::className(), ['id' => 'clientDepartment']);
    }  

}
