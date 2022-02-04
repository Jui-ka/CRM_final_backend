<?php

    namespace frontend\controllers;
    use Yii;
    use yii\rest\ActiveController;
    use common\models\Opportunity;
    use common\models\Person;
    use common\models\Address;
    use common\models\Plan;
    use common\models\OpportunitySearch;
    use common\models\OpportunityFilter;
    use yii\filters\auth\HttpBasicAuth;
    use frontend\controllers\baseController;


    class OpportunityController extends BaseController
    {
        public $modelClass = 'common\models\OpportunitySearch';
        public function actionIndex()
        {   
            $searchModel = new OpportunitySearch();
            $dataProvider = $searchModel->search($this->request->queryParams);
  
            return $dataProvider;
        }
         public function actionView($id)
        {
            $opportunity = OpportunitySearch::findOne($id);
            return $opportunity;
        }

        public function actionCreate()
        {
            $address = new Address();
            $address->load(Yii::$app->getRequest()->getBodyParams(),'');
            $address->save();
            // print_r($address);
            // die;
            $person = new Person();
            $person->load(Yii::$app->getRequest()->getBodyParams(),'');
            $person->address_id = $address->address_id;
            $person->save();
            // return $person;
            // print_r($person);
            // die;
            $opportunity = new Opportunity();
            $opportunity->load(Yii::$app->getRequest()->getBodyParams(),'');
            $opportunity->person_id = $person->person_id;
            // echo $person->person_id;
            // die;
            $opportunity->save();
            // print_r($opportunity);
            // die;
            return $opportunity;
        }
        public function actionUpdate($id)
        {
            // echo "Calling";
            // die;
                   
            $opportunity = Opportunity::findOne($id);
            $person = Person::findOne($opportunity->person_id);
            $address = Address::findOne($person->address_id);
            // print_r($person);
            // die;
            if($opportunity->load(Yii::$app->getRequest()->getBodyParams(),''))
            {
                if($person->load(Yii::$app->getRequest()->getBodyParams(),'')) 
                {
                    if($address->load(Yii::$app->getRequest()->getBodyParams(),'')) 
                    {
                        $opportunity->save();
                        $person->save();
                        $address->save();
                        return "Edited sucessfully";
                    }
                }
            }
            return "Edition failed.. try again";
        }
    
    }
?>