<?php

// namespace app\modules\user\controllers;

// use yii\web\Controller;

// class DefaultController extends Controller
// {
//     public function actionIndex()
//     {
//         return $this->render('index');
//     }
// }

namespace app\modules\user\controllers;
 
use app\modules\user\models\form\EmailConfirmForm;
use app\modules\user\models\form\LoginForm;
use app\modules\user\models\form\PasswordResetRequestForm;
use app\modules\user\models\form\PasswordResetForm;
use app\modules\user\models\form\SignupForm;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use Yii;
use app\modules\user\Module;
 
class DefaultController extends Controller
{
    /**
     * @var \app\modules\user\Module
     */
    public $module;
 
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }    
 
     public function actionLogin()
    {
        $this->layout = '@app/modules/user/views/layouts/default/main';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
 
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
 
    public function actionLogout()
    {
        Yii::$app->user->logout();
 
        return $this->goHome();
    }
 
    public function actionSignup()
    {
        $this->layout = '@app/modules/user/views/layouts/default/main';

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                Yii::$app->getSession()->setFlash('success', 'Подтвердите ваш электронный адрес.');
                return $this->goHome();
            }
        }
 
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
 
    public function actionEmailConfirm($token)
    {
        try {
            $model = new EmailConfirmForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
 
        if ($model->confirmEmail()) {
            Yii::$app->getSession()->setFlash('success', 'Спасибо! Ваш Email успешно подтверждён.');
        } else {
            Yii::$app->getSession()->setFlash('error', 'Ошибка подтверждения Email.');
        }
 
        return $this->goHome();
    }
 
    // public function actionPasswordResetRequest()
    // {
    //     $this->layout = '@app/modules/user/views/layouts/default/main';

    //     $model = new PasswordResetRequestForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    //         if ($model->sendEmail()) {
    //             Yii::$app->getSession()->setFlash('success', 'Спасибо! На ваш Email было отправлено письмо со ссылкой на восстановление пароля.');
 
    //             return $this->goHome();
    //         } else {
    //             Yii::$app->getSession()->setFlash('error', 'Извините. У нас возникли проблемы с отправкой.');
    //         }
    //     }
 
    //     return $this->render('passwordResetRequest', [
    //         'model' => $model,
    //     ]);
    // }

    public function actionPasswordResetRequest()
    {
        // $model = new PasswordResetRequestForm($this->module->passwordResetTokenExpire);
        $model = new PasswordResetRequestForm($this->module->passwordResetTokenExpire);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', Module::t('module', 'FLASH_PASSWORD_RESET_REQUEST'));
                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', Module::t('module', 'FLASH_PASSWORD_RESET_ERROR'));
            }
        }
        return $this->render('passwordResetRequest', [
            'model' => $model,
        ]);
    }
 
    public function actionPasswordReset($token)
    {
        try {
            $model = new PasswordResetForm($token, $this->module->passwordResetTokenExpire);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
 
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'Спасибо! Пароль успешно изменён.');
 
            return $this->goHome();
        }
 
        return $this->render('passwordReset', [
            'model' => $model,
        ]);
    }

    public function actionIndex()
    {
        return $this->redirect(['profile/index'], 301);
    }
    
}