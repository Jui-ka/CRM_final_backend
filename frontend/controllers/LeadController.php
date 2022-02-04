<?php
namespace frontend\controllers;
use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Lead;
use app\models\LeadSearch;
use app\models\Address;
use app\models\Person;
use app\models\Opportunity;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;

class LeadController extends BaseController
{
  // public function behaviors()
  // {
  //     $behaviors = parent::behaviors();
  //
  //     // remove authentication filter
  //     $auth = $behaviors['authenticator'];
  //     unset($behaviors['authenticator']);
  //
  //     // add CORS filter
  //     $behaviors['corsFilter'] = [
  //         'class' => \yii\filters\Cors::class,
  //     ];
  //
  //     // re-add authentication filter
  //     $behaviors['authenticator'] = $auth;
  //     // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
  //     $behaviors['authenticator']['except'] = ['options'];
  //
  //     return $behaviors;
  // }
    public $modelClass = 'app\models\LeadSearch';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['index']);
        unset($actions['update']);
        unset($actions['delete']);
        // set($actions['convert']);
        // unset($actions['view']);

        return $actions;
    }

    public function actionCreate()
    {
        $transaction = Yii::$app->db->beginTransaction();

            try {
                //if callback returns true than commit transaction
    $address = new Address();
    $person = new Person();
    $lead = new Lead();

    if ($address->load(Yii::$app->request->post(),'') && $address->validate()){


        echo "  addaddress     ";


   if( $address->save()){
    $person->address_id = $address->address_id;
    if ( $person->load(Yii::$app->request->post(),'') && $person->validate()){
        // your other file processing code
            echo "addperson    ";

       if( $person->save()){
           $lead->person_id=$person->person_id;


           if ( $lead->load(Yii::$app->request->post(),'') && $lead->validate()){
                echo "addemployee";
                if( $lead->save()){
                    $transaction->commit();
                    return true;
                }

            } else{
                $transaction->rollBack();
                return $lead;
            }
       }
    }else{
        $transaction->rollBack();
        return $person;
    }
   }



} else{

    $transaction->rollBack();
 return $address;
}

            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }

        // if($address->load(Yii::$app->request->post()) && $person->load(Yii::$app->request->post() && $lead->load(Yii::$app->request->post()) ) ) {





        //     // return/redirection statement
        // }else {
        //     echo 'Error';
        // }
    }

    public function actionDelete($id){
      $lead = Lead::findOne($id);
      // $person = Person::findOne($lead->person_id);
      // $address = Address::findOne($person->address_id);
      $lead->is_deleted = 1;
      $lead->save();
      return "deleted successfully";
    }

    public function actionUpdate($id){
      $lead = Lead::findOne($id);
      $person = Person::findOne($lead->person_id);
      $address = Address::findOne($person->address_id);

            if($person->load(Yii::$app->getRequest()->getBodyParams(),''))
            {
                if($address->load(Yii::$app->getRequest()->getBodyParams(),''))
                {
                    $person->save();
                    $address->save();
                    return "Edited sucessfully";
                }
            }
            return "Edition failed.. try again";
    }

    public function actionConvert() {
      // echo $id;
      // die;
            try {
                // $opportunity = Opportunity::findOne($id);
                $opportunity = new Opportunity();
                $opportunity->load(Yii::$app->getRequest()->getBodyParams(),'');
                // echo "string";
                // die;
                $opportunity->save();
            }
            catch (\yii\db\Exception $e) {
                return "Duplicate entry not allowed";
            }
            // echo "string";
        }


    // public function actionUpdate($id){
    //
    //     $transaction = Yii::$app->db->beginTransaction();
    //     try {
    //
    //       $lead = Lead::findOne($id);
    //             $person = Person::findOne($lead->person_id);
    //             $address = Address::findOne($person->address_id);
    //
    //             if($person->load(Yii::$app->getRequest()->getBodyParams(),''))
    //             {
    //
    //               if ($person->save()) {
    //                 $lead->person_id=$person->person_id;
    //                 echo "person saved";
    //                 if ($address->load(Yii::$app->getRequest()->getBodyParams(),'')) {
    //                   if ($address->save()) {
    //                     echo "address saved";
    //                     $transaction->commit();
    //                     return true;
    //                   }
    //                 }else {
    //                   $transaction->rollBack();
    //                   return $address;
    //
    //                 }
    //               }
    //             }
    //             else {
    //               $transaction->rollBack();
    //               return $person;
    //             }
    //
    //     }
    //
    //     catch (\Exception $e) {
    //       transaction->rollBack();
    //       throw $e;
    //
    //
    //     }
    //
    //
    //
    //
    //
    //         return "Edition failed.. try again";
    // }


    public function actionIndex(){
      $searchModel = new LeadSearch();
      $dataProvider = $searchModel->search($this->request->queryParams);
      return $dataProvider;
      echo "string";
    }

}

// $transaction = Yii::$app->db->beginTransaction();

//     try {
//         //if callback returns true than commit transaction
//         if (call_user_func($callback)) {
//             $transaction->commit();
//             Yii::trace('Transaction wrapper success');
//         }
//     } catch (\Exception $e) {
//         $transaction->rollBack();
//         throw $e;
//     }
