<?php

namespace app\modules\references\models;
use app\modules\admin\models\Companies;
use app\modules\admin\models\Positions;
use app\modules\admin\models\Departments;

use Yii;

/**
 * This is the model class for table "{{%employees}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $patronimyc
 * @property string $photo
 * @property integer $company_id
 * @property integer $department_id
 * @property integer $position_id
 *
 * @property Companies $company
 * @property Departments $department
 * @property Positions $position
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%employees}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'department_id', 'position_id'], 'required'],
            [['company_id', 'department_id', 'position_id'], 'integer'],
            [['name', 'surname', 'patronimyc', 'photo'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departments::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => Positions::className(), 'targetAttribute' => ['position_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'surname' => Yii::t('app', 'Surname'),
            'patronimyc' => Yii::t('app', 'Patronimyc'),
            'photo' => Yii::t('app', 'Photo'),
            'company_id' => Yii::t('app', 'Company ID'),
            'department_id' => Yii::t('app', 'Department ID'),
            'position_id' => Yii::t('app', 'Position ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Companies::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Departments::className(), ['id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(Positions::className(), ['id' => 'position_id']);
    }
}
