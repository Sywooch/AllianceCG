<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%positions}}".
 *
 * @property integer $id
 * @property string $position
 * @property string $description
 */
class Positions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%positions}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position'], 'required'],
            [['description'], 'string'],
            [['position'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'position' => Yii::t('app', 'ADMIN_POSITIONS_POSITION'),
            'description' => Yii::t('app', 'ADMIN_POSITIONS_DESCRIPTION'),
        ];
    }
}
