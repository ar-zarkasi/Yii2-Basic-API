<?php
namespace app\helpers;

use app\models\Setup;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\CompositeAuth;
use yii\web\UploadedFile;
use yii\rest\UpdateAction;

class ApiActive extends \yii\rest\ActiveController {
    const METHOD_SELF = ['GET','POST','PUT'];

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [HttpBearerAuth::class],
        ];
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
    public function actions(){
        $actions = parent::actions();
        unset($actions['options']);
        return $actions;
    }
    public function actionFieldForm(){
        return [];
    }
}