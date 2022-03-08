<?php namespace app\library\traits;
use yii\web\NotFoundHttpException;

trait FindModel
{
   public $modelClass;
   public $messageError = 'Data Tidak Ditemukan';
   public function find($id)
   {
       $model = $this->modelClass::findOne($id);
       if(empty($model)) throw new NotFoundHttpException($this->messageError);

       return $model;
   } 
   public function findByCriteria(Array $criteria)
   {
       $model = $this->modelClass::find();
       foreach($criteria as $key => $cond) {
           switch (strtolower($cond['type'])) {
               case 'is':
                   $model->where(['IS',$cond['params'],$cond['params2']]);
                   break;
               
               default:
                   $model->where($key,$cond['params']);
                   break;
           }
           
       }
       return $model->one();
   }
}
