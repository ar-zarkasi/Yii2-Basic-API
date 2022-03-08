<?php namespace app\library;

use Yii;
use yii\rest\ActiveController;
use app\library\traits\RestAction;
use app\library\traits\FindModel;

class RestActiveController extends ActiveController {
    use RestAction, FindModel;

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