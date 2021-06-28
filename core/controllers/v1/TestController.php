<?php
namespace app\controllers\v1;

class TestController extends \app\helpers\ApiCustom {
    
    public function actionIndex()
    {
        return [
            'status'=>'success',
            'message'=>'Berhasil Masuk Ke API',
        ];
    }

    public function actionExtraUrl()
    {
        return [
            'message'=>'This is Example Extra Pattern URL',
        ];
    }
}
