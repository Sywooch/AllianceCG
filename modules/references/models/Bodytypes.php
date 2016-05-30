<?php

namespace app\modules\references\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use app\modules\admin\models\User;

/**
 * This is the model class for table "{{%bodytypes}}".
 *
 * @property integer $id
 * @property string $body_type
 * @property string $description
 */
class Bodytypes extends \yii\db\ActiveRecord
{

    public $xlsxFile;

    const STATUS_BLOCKED = 1;
    const STATUS_ACTIVE = 0;    
    const DIR_FOR_UPLOAD = 'files/bodytypes/';
    const XLSX_FILE_FOR_UPLOAD = 'bodytypes';
    const UPLOAD_FILE_EXT = 'xlsx';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bodytypes}}';
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
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['body_type'], 'string', 'max' => 255],
            [['body_type'], 'required'],
            ['author', 'default', 'value' => Yii::$app->user->getId()],
            [['xlsxFile'], 'file', 'skipOnEmpty' => true, 'extensions' => ['xlsx'],'checkExtensionByMimeType'=>false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'body_type' => Yii::t('app', 'BODY_TYPE'),
            'description' => Yii::t('app', 'BODY_DESCRIPTION'),
            'state' => Yii::t('app', 'STATE'),
            'created_at' => Yii::t('app', 'CREATED_AT'),
            'updated_at' => Yii::t('app', 'UPDATED_AT'),
            'author' => Yii::t('app', 'AUTHOR'),
            'globalSearch' => Yii::t('app', 'SEARCH'),
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
