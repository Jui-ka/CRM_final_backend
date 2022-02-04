<?php

namespace frontend\controllers;
use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\Address;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
class AddressController extends ActiveController
{
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
    public $modelClass = 'frontend\models\Address';
    
    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['dataFilter'] = [
            'class' => \yii\data\ActiveDataFilter::class,
            'searchModel' => $this->modelClass,
        ];

        return $actions;
    }}
