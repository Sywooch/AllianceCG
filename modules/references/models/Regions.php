<?php

namespace app\modules\references\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\modules\references\Module;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\User;

/**
 * This is the model class for table "{{%regions}}".
 *
 * @property integer $id
 * @property string $region_name
 * @property integer $region_code
 * @property integer $state
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $author
 */
class Regions extends \yii\db\ActiveRecord
{

    public $fullregionName;
    public $file;

    const DIR_FOR_UPLOAD = 'files/regions/';
    const XLSX_FILE_FOR_UPLOAD = 'regions.xlsx';
    const UPLOAD_FILE_EXT = 'xlsx';
    const STATUS_BLOCKED = 1;
    const STATUS_ACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%regions}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_code', 'state', 'created_at', 'updated_at'], 'integer'],
            [['region_name', 'region_code'], 'required'],
            [['region_name', 'author'], 'string', 'max' => 255],
            ['author', 'default', 'value' => Yii::$app->user->getId()],
            [['fullregionName', 'file'], 'safe'],
            // [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => ['xlsx'],'checkExtensionByMimeType'=>true],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => [self::UPLOAD_FILE_EXT],'checkExtensionByMimeType'=>true],
        ];
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
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'ID'),
            'region_name' => Module::t('module', 'REGION_NAME'),
            'region_code' => Module::t('module', 'REGION_CODE'),
            'state' => Module::t('module', 'STATE'),
            'created_at' => Module::t('module', 'CREATED_AT'),
            'updated_at' => Module::t('module', 'UPDATED_AT'),
            'author' => Module::t('module', 'AUTHOR'),
            'globalSearch' => Module::t('module', 'SEARCH'),
            'authorname' => Module::t('module', 'AUTHOR'),
            'regionandcodes' => Module::t('module', 'REGIONANDCODES')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorname()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
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

    public function getRegionandcodes()
    {
        $fullregionName = $this->region_code . ' - ' .$this->region_name;
        return $fullregionName;
    }  
}
