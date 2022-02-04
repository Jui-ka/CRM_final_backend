<?php

    namespace frontend\controllers;
    use Yii;
    use yii\rest\ActiveController;
    use frontend\models\Plan;
    use frontend\models\PlanSearch;
    use yii\filters\auth\HttpBasicAuth;
   // use frontend\controllers\baseController;


    class PlanController extends ActiveController
    {
        public $modelClass = 'frontend\models\PlanSearch';

        public function actions()
        {
            $actions = parent::actions();
            unset($actions['index']);
            unset($actions['create']);   
            unset($actions['update']);
            unset($actions['delete']);
        }

        public function actionIndex()
        {
             $searchModel = new PlanSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);
  
            return $dataProvider;
        }

        public function actionCreate()
        {
         
             $plan = new Plan();
             $plan->load(Yii::$app->getRequest()->getBodyParams(),'');
                $plan->save();
                    return $plan;
        }

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
        
        // public function actionDelete($id)
        // {
        //     // echo $id;
        //     $plan = Plan::findOne($id);

        //     if($plan->load(Yii::$app->getRequest()->getBodyParams(),'')) 
        //     {
        //         $plan->save();
        //         return "Edited sucessfully";
        //     }
        //         return "Edition falied.. try again";
        // }
    }
?>