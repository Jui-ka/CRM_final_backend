<?php

namespace frontend\controllers;

use frontend\models\Person;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;

class PersonController extends ActiveController
{
    public $modelClass = Person::class;
    

    public function behaviors()
      {
          $behaviors = parent::behaviors();
  
          // remove authentication filter
          $auth = $behaviors['authenticator'];
          unset($behaviors['authenticator']);
  
          // add CORS filter
          $behaviors['corsFilter'] = [
              'class' => \yii\filters\Cors::class,
          ];
  
          // re-add authentication filter
          $behaviors['authenticator'] = $auth;
          // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
          $behaviors['authenticator']['except'] = ['options'];
  
          return $behaviors;
      }
  
  
      public function actionIndex(){
   return Person::find()->all();
    $activeData = new ActiveDataProvider([
        'query' => Person::find(),
      //   'pagination' => [
      //       'defaultPageSize' => 2,
      //   ],
    ]);
}

}