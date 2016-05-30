<?php

namespace app\modules\references\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use app\modules\admin\models\User;

/**
 * This is the model class for table "{{%targets}}".
 *
 * @property integer $id
 * @property string $target
 */
class Targets extends \yii\db\ActiveRecord
{
    public $xlsxFile;

    const DIR_FOR_UPLOAD = 'files/targets/';
    const XLSX_FILE_FOR_UPLOAD = 'targets';
    const UPLOAD_FILE_EXT = 'xlsx';
    const STATUS_BLOCKED = 1;
    const STATUS_ACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%targets}}';
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
            [['target'], 'string', 'max' => 255],
            [['target'], 'safe'],
            [['target'], 'unique'],
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
            'id' => Yii::t('app', 'ID'),
            'target' => Yii::t('app', 'TARGET'),
            'state' => Yii::t('app', 'STATE'),
            'globalSearch' => Yii::t('app', 'SEARCH'),  
            'globalSearch' => Yii::t('app', 'SEARCH'),   
            'created_at' => Yii::t('app', 'CREATED_AT'), 
            'updated_at' => Yii::t('app', 'UPDATED_AT'), 
            'author' => Yii::t('app', 'AUTHOR'),  
            'authorname' => Yii::t('app', 'AUTHOR'),  
            'xlsxFile' => Yii::t('app', 'xlsxFile'),     
        ];
    } 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorname()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }  
}
