<?php

namespace app\modules\admin\models;

use Yii;
use app\modules\admin\Module;

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
            [['position'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            // 'id' => Yii::t('app', 'ID'),
            // 'position' => Yii::t('app', 'ADMIN_POSITIONS_POSITION'),
            // 'description' => Yii::t('app', 'ADMIN_POSITIONS_DESCRIPTION'),
            'id' => Module::t('module', 'ID'),
            'position' => Module::t('module', 'ADMIN_POSITIONS_POSITION'),
            'description' => Module::t('module', 'ADMIN_POSITIONS_DESCRIPTION'),            
        ];
    }
}
