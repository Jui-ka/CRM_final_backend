<?php

namespace frontend\controllers;

use frontend\models\Employee;
use frontend\models\EmployeeSearch;
use yii\filters\auth\HttpBasicAuth;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\data\Pagination;
use frontend\models\Address;
use frontend\models\Person;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;

class EmployeeController extends ActiveController
{

  public function actions()
  {
    $actions = parent::actions();
    unset($actions['index']);
    unset($actions['create']);
    unset($actions['delete']);
    unset($actions['update']);
   

    return $actions;  
  }
    public $modelClass = Employee::class;

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
  
          $behaviors['authenticator'] = $auth;
          
          $behaviors['authenticator']['except'] = ['options'];
  
          return $behaviors;
      }
  
  
      public function actionIndex(){

    $searchModel = new EmployeeSearch();
$dataProvider = $searchModel->search($this->request->queryParams);
return $dataProvider;

}

public function actionCreate() 
{
    $transaction = Yii::$app->db->beginTransaction();
        try {
             $address = new Address();
             $person = new Person();
            $employee = new Employee();
  
if ($address->load(Yii::$app->request->post(),'') && $address->validate()){
         echo "  addaddress     ";

if( $address->save()){
$person->address_id = $address->address_id;

if ( $person->load(Yii::$app->request->post(),'') && $person->validate()){
           echo "addperson    ";
        
   if( $person->save()){
       $employee->person_id=$person->person_id;

       if ( $employee->load(Yii::$app->request->post(),'') && $employee->validate()){
            echo "addemployee";
            if( $employee->save()){
                $transaction->commit();
                return true; }
        } else{
            $transaction->rollBack();
            return $employee;
        }  }
}else{
    $transaction->rollBack();
    return $person;
} } 
} else{

$transaction->rollBack();
return $address;
}              } 
    catch (\Exception $e) {
       $transaction->rollBack();
            throw $e;
        }
    }


    public function actionUpdate($id){
        $employee = Employee::findOne($id);
        $person = Person::findOne($employee->person_id);
        $address = Address::findOne($person->address_id);

        if($person->load(Yii::$app->getRequest()->getBodyParams(),''))
        {
            if($address->load(Yii::$app->getRequest()->getBodyParams(),''))
            {
                $person->save();
                $address->save();
                return "Edited sucessfully";
        }}}



        public function actionDelete($id)
        {
            $employee = Employee::findOne($id);
            $employee->is_deleted = 1;
            $employee->save();
            return "Deleted successfully";
        }
}