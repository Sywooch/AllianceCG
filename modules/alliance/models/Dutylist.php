<?php

namespace app\modules\alliance\models;

use Yii;
use app\modules\references\models\Employees;
use yii\behaviors\TimestampBehavior;
use app\modules\admin\models\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%dutylist}}".
 *
 * @property integer $id
 * @property integer $employee_id
 * @property string $date
 *
 * @property Employees $employee
 */
class Dutylist extends \yii\db\ActiveRecord
{
    const STATUS_BLOCKED = 1;
    const STATUS_ACTIVE = 0;

    public $globalSearch;
    public $stateName;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%dutylist}}';
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
            [['employee_id', 'date'], 'required'],
            [['employee_id'], 'integer'],
            ['date', 'unique', 'message' => 'В БД имеется запись на выбранную дату'],
            [['date', 'state', 'stateName', 'globalSearch'], 'safe'],
            ['author', 'default', 'value' => Yii::$app->user->getId()],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['employee_id' => 'id']],
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
            'employee_id' => Yii::t('app', 'Employee ID'),
            'employee' => Yii::t('app', 'Employee ID'),
            'date' => Yii::t('app', 'Dutydate'),
            'state' => Yii::t('app', 'State'),
            'created_at' => Yii::t('app', 'CREATED_AT'),
            'updated_at' => Yii::t('app', 'UPDATED_AT'),
            'authorname' => Yii::t('app', 'AUTHOR'),
            'author' => Yii::t('app', 'AUTHOR'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employees::className(), ['id' => 'employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorname()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }  

    public function getEmployeeName() {
        return $this->employee->fullName;
    }
}
