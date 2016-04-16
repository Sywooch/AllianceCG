<?php

namespace app\modules\alliance\models;

use Yii;

/**
 * This is the model class for table "{{%weekdays}}".
 *
 * @property integer $id
 * @property integer $daynumber
 * @property string $dayname
 */
class Weekdays extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%weekdays}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['daynumber'], 'integer'],
            [['dayname'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'daynumber' => Yii::t('app', 'Daynumber'),
            'dayname' => Yii::t('app', 'Dayname'),
        ];
    }
}
