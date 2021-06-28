<?php
namespace app\controllers\v1;
use yii;
use yii\web\HttpException;
use yii\filters\auth\HttpBearerAuth;
use app\models\User;
use yii\filters\auth\CompositeAuth;

class AuthController extends \yii\rest\Controller {

    public function behaviors(){
        $behaviors = parent::behaviors();

        if($this->action->id === 'logout'){
            $behaviors['authenticator'] = [
                'class' => CompositeAuth::class,
                'authMethods' => [HttpBearerAuth::class],
            ];
        }

        $behaviors['corsFilter'] = [
            'class'=>\yii\filters\Cors::class,
            'cors'=>[
                'Origin' => ['*'],
                'Access-Control-Allow-Method' => ['POST','OPTIONS'],
                'Access-Control-Request-Method' => ['POST','OPTIONS'],
                'Access-Control-Request-Headers' => ['*']
            ]
        ];
        return $behaviors;
    }

    protected function verbs()
    {
        return [
            'login' => ['OPTIONS', 'POST'],
            'logout' => ['OPTIONS','POST'],
        ];
    }

    public function actionLogin() {
        $username = Yii::$app->request->post('user');
        $password = Yii::$app->request->post('password');
        $data = ['data'=>''];
        $response = \Yii::$app->getResponse();
        try {
            if(empty($username) || empty($password)) throw new HttpException(422,'user atau password tidak boleh kosong!');

            $user = User::findByUsername($username);
            if(empty($user)) throw new HttpException(404,'User '.$username.'Tersebut tidak ditemukan.');
            
            if($user->validatePassword($password)){
                // $user->generateAccessToken();
                $data = [
                    // 'id' => $user->encryptID(),
                    'username' => $user->username,
                    'token' => $user->accessToken,
                ];
                // $data = $user->encryptToken();
                $response->setStatusCode(200);
            } else throw new HttpException(422,"Password Anda Tidak Sesuai");
        } catch (\Exception $th) {
            throw $th;
        }
        return $data;
    }

    public function actionLogout() {
        $data = [];
        try {
            $user = Yii::$app->user->identity;
            if(is_null($user)) throw new HttpException(422,'User Tidak dalam Login');
            
            $user = Users::findIdentity($user->id);
            // if($user->generateAccessToken())
                $data = ['status'=>'success','message'=>'Sukses Logout'];
            // else throw new HttpException(422,'Gagal Logout');
        } catch (\Exception $th) {
            throw $th;
        }
        return $data;
    }
}