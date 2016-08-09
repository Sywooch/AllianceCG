<?php

namespace app\modules\skoda\models;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\User;


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
            [['clientDepartment', 'state', 'created_at', 'updated_at'], 'integer'],
            [['clientBithdayDate', 'clientPhone'], 'safe'],
            ['author', 'default', 'value' => Yii::$app->user->getId()],
            [['clientName', 'clientSurname', 'clientPatronymic', 'clientPhone', 'clientEmail'], 'string', 'max' => 255],
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
            'state' => Yii::t('app', 'State'),
            'clientRegion' => Yii::t('app', 'Client Region'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'author' => Yii::t('app', 'Author'),
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
    public function getAuthorname()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }  

}
