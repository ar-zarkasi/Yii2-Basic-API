<?php namespace app\library;

use Yii;
use yii\rest\Controller;

class RestController extends Controller {

    public function behaviors(){
        $behaviors = parent::behaviors();
        $method = ['GET','HEAD','POST','PUT','DELETE'];
        $behaviors['corsFilter'] = [
            'class'=>\yii\filters\Cors::class,
            'cors'=>[
                'Origin' => ['*'],
                'Access-Control-Allow-Method' => $method,
                'Access-Control-Request-Method' => $method,
                'Access-Control-Request-Headers' => ['*']
            ]
        ];
        return $behaviors;
    }
}