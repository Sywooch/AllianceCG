<?php

namespace app\components\validators;

use yii\validators\Validator;

class WorkshedulerValidator extends Validator
{
    // public function validateAttribute($model, $attribute)
    // {
    //     if (!in_array($model->$attribute, ['USA', 'Web'])) {
    //         $this->addError($model, $attribute, 'The country must be either "USA" or "Web".');
    //     }
    // }

    public function validateWorksheduler($model, $attribute)
    {
            $to_date = Yii::$app->formatter->asDate($model->to, 'yyyy-MM-dd');
            $wcs = Servicesheduler::find()
                ->where(['date' => $to_date])
                ->one();
    
            if(empty($wcs->responsible))                
            {
                // throw new \yii\web\NotFoundHttpException('User not found');
                $this->addError($model, $attribute, Yii::t('app', 'ERROR_WORKSHEDULER_DOES_NOT_EXIST'));
                // throw new \yii\web\Exception('hello world');
            }
    }



}