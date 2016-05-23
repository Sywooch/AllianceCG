<?php

namespace app\modules\admin\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%source_message}}".
 *
 * @property integer $id
 * @property string $category
 * @property string $message
 *
 * @property Message[] $messages
 */
class SourceMessage extends \yii\db\ActiveRecord
{
    public $xlsxFile;
    public $language;
    public $translation;

    const DIR_FOR_UPLOAD = 'files/sourcemessage/';
    const XLSX_FILE_FOR_UPLOAD = 'sourcemessage';
    const UPLOAD_FILE_EXT = '.xlsx';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%source_message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message'], 'string'],
            [['category'], 'string', 'max' => 32],
            [['language', 'translation'], 'safe'],
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
            'category' => Yii::t('app', 'Category'),
            'message' => Yii::t('app', 'Message'),
            'translation' => Yii::t('app', 'Translation'),
            'language' => Yii::t('app', 'Language'),
            'globalSearch' => Yii::t('app', 'Search'),
            'xlsxFile' => Yii::t('app', 'xlsxFile'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['id' => 'id']);
        // return $this->hasOne(Message::className(), ['id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $sourceMessage = SourceMessage::findOne($this->id);
        $message = $insert ? new Message() : Message::findOne($this->id);
        $message->language = $this->language;
        $message->translation = $this->translation;
        $sourceMessage->link('messages', $message);

        parent::afterSave($insert, $changedAttributes);
    }
}
