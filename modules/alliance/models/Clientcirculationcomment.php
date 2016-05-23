<?php

namespace app\modules\alliance\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\modules\references\models\Targets;
use app\modules\references\models\ContactType;

/**
 * This is the model class for table "{{%clientcirculationcomment}}".
 *
 * @property integer $id
 * @property integer $clientcirculation_id
 * @property string $contact_type
 * @property string $target
 * @property string $car_model
 * @property string $comment
 * @property integer $state
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $author
 *
 * @property ClientCirculation $clientcirculation
 */
class Clientcirculationcomment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%clientcirculationcomment}}';
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
            // [['clientcirculation_id', 'created_at', 'updated_at'], 'required'],
            [['clientcirculation_id', 'state', 'created_at', 'updated_at'], 'integer'],
            [['comment'], 'string'],
            // [['contact_type', 'target', 'car_model', 'author'], 'string', 'max' => 255],
            // [['car_model', 'author'], 'string', 'max' => 255],
            [['clientcirculation_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClientCirculation::className(), 'targetAttribute' => ['clientcirculation_id' => 'id']],
            [['clientcirculation_id', 'contact_type', 'target', 'car_model', 'author'], 'safe'],
            [['contact_type', 'target'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'clientcirculation_id' => Yii::t('app', 'Clientcirculation ID'),
            'contact_type' => Yii::t('app', 'Contact Type'),
            'target' => Yii::t('app', 'Target'),
            'car_model' => Yii::t('app', 'Car Model'),
            'comment' => Yii::t('app', 'Comment'),
            'state' => Yii::t('app', 'State'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'author' => Yii::t('app', 'Author'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientcirculation()
    {
        return $this->hasOne(ClientCirculation::className(), ['id' => 'clientcirculation_id']);
    }

    public function getTargets()
    {
        return $this->hasOne(Targets::className(), ['id' => 'target']);
    }

    public function getContacttypes()
    {
        return $this->hasOne(ContactType::className(), ['id' => 'contact_type']);
    }
}
