<?php

namespace app\modules\admin\models;

use Yii;

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
    public $language;
    public $translation;

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
            [['language', 'translation'], 'safe']
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
        // $sourceMessage = new SourceMessage();
        $message = new Message();
        // $message->id = $this->id;
        $message->language = $this->language;
        $message->translation = $this->translation;
        $sourceMessage->link('messages', $message);

        parent::afterSave($insert, $changedAttributes);
    }


}
