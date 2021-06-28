<?php

namespace app\controllers;

use Yii;
// use yii\filters\AccessControl;
// use yii\web\Controller;
// use yii\web\Response;
use yii\filters\VerbFilter;
use yii\rest\Controller;
// use app\models\LoginForm;
// use app\models\ContactForm;

class SiteController extends Controller
{
    const METHOD_SELF = ['GET','HEAD','OPTIONS','PUT'];
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class'=>\yii\filters\Cors::class,
            'cors'=>[
                'Origin' => ['*'],
                'Access-Control-Allow-Method' => self::METHOD_SELF,
                'Access-Control-Request-Method' => self::METHOD_SELF,
                'Access-Control-Request-Headers' => ['*']
            ]
        ];
        return $behaviors;
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return [
            'site'=>'API Application Example',
            'version'=>'1.0',
            'year'=>date('Y')
        ];
        // return $this->render('index');
    }
    public function actionOpsi()
    {
        return self::METHOD_SELF;
    }
}
