<?php

namespace app\modules\skoda\models;

use Yii;
use app\modules\skoda\Module;

/**
 * This is the model class for table "{{%servicesheduler}}".
 *
 * @property integer $id
 * @property string $date
 * @property integer $responsible
 */
class Servicesheduler extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%servicesheduler}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'responsible'], 'required'],
            [['date'], 'safe'],
            [['responsible'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'ID'),
            'date' => Module::t('module', 'WORKSHEDULER_DATE'),
            'responsible' => Module::t('module', 'WORKSHEDULER_RESPONSIBLE'),
        ];
    }
}
