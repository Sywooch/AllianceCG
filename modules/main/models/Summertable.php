<?php

namespace app\modules\main\models;

use Yii;

/**
 * This is the model class for table "{{%audisummertable}}".
 *
 * @property integer $id
 * @property string $model
 * @property string $body_color
 * @property integer $discount_percent
 * @property integer $price
 * @property integer $payment
 */
class Summertable extends \yii\db\ActiveRecord
{

    public $name;
    public $phone;
    public $selectedcar;
    public $globalSearch;
    public $email;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%audisummertable}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'payment', 'discount', 'price_discount'], 'integer'],
            [['model', 'body_color'], 'string', 'max' => 255],
            // [['discount_percent']],
            [['name', 'phone', 'email', 'discount_percent', 'selectedcar', 'globalSearch'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'model' => Yii::t('app', 'Model'),
            'body_color' => Yii::t('app', 'Body Color'),
            'discount_percent' => Yii::t('app', 'Discount Percent'),
            'discount' => Yii::t('app', 'Discount'),
            'price' => Yii::t('app', 'Price'),
            'price_discount' => Yii::t('app', 'Price Discount'),
            'payment' => Yii::t('app', 'Payment'),
            'name' => Yii::t('app', 'Name'),
            'phone' => Yii::t('app', 'Phone'),

            // 'id' => Yii::t('app', 'ID'),
            // 'model' => 'Модель',
            // 'body_color' => 'Цвет кузова',
            // 'discount_percent' => 'Скидка',
            // 'price' => 'Цена',
            // 'payment' => 'Ежемесячный платеж по кредиту',            
        ];
    }


    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            // Yii::$app->mailer->compose()
            Yii::$app->mailer->compose(['html' => '@app/modules/main/mails/Summertable/testdriverequest'], [
                        'name' => $this->name,
                        'phone' => $this->phone,
                        'selectedcar' => $this->selectedcar,
                    ])
                ->setTo($email)
                ->setFrom('maxim.ishchenko@gmail.com')
                // ->setReplyTo([$this->email => $this->name])
                ->setSubject('Заявка на тест-драйв')
                // ->setTextBody('testdriverequestbody')
                ->send();
 
            return true;
        } else {
            return false;
        }
    }    
}
