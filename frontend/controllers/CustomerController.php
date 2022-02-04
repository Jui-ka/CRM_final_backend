<?php

namespace frontend\controllers;


use frontend\models\Customer;
use frontend\models\CustomerSearch;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;

class CustomerController extends ActiveController
{
  public function actions()
  {
    $actions = parent::actions();
    unset($actions['index']);
    // unset($actions['create']);
    // unset($actions['delete']);
    // unset($actions['update']);
   

    return $actions;  
  }

    public $modelClass = Customer::class;

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
//  return Customer::find()->all();
//   $activeData = new ActiveDataProvider([
//       'query' => Customer::find(),
//     //   'pagination' => [
//     //       'defaultPageSize' => 2,
//     //   ],
//   ]);

   
$searchModel = new CustomerSearch();
$dataProvider = $searchModel->search($this->request->queryParams);
return $dataProvider;
}

// //For pagition and links
// public $serializer = [
//   'class' => 'api\components\Serializer',
// ];

// public function serializePagination($pagination)
//     {
//         return [
//             $this->linksEnvelope => Link::serialize($pagination->getLinks(true)),
//             $this->metaEnvelope => [
//                 'totalCount' => $pagination->totalCount,
//                 'pageCount' => $pagination->getPageCount(),
//                 'currentPage' => $pagination->getPage() + 1,
//                 'perPage' => $pagination->getPageSize(),
//             ],
//         ];
//     }

public function actionCreate() {
    
  $customer = new Customer();
  if ($customer->load(Yii::$app->getRequest()->getBodyParams(), '')){
  
        echo "Customer Added successfully ";
        $customer->save();
      }
   //}
  
}

}
