<?php
App::uses('AppController','Controller');

class SentagreementsController extends AppController{

    public $components = array('Paginator');

	public function sendAgreement($jobagreement_id=null,$orgId=null,$userId=null){
		
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
             $count = $this->Sentagreement->sendAgreementcheck($jobagreement_id,$orgId,$userId);
            if($count){
                $output = ['status'=>2];
            }else{
                $this->request->data['Sentagreement']['date'] = date('Y-m-d');
                $this->request->data['Sentagreement']['jobagreement_id'] = $jobagreement_id;
                $this->request->data['Sentagreement']['user_id'] = $userId;
                $this->request->data['Sentagreement']['organization_id'] = $orgId;

                $this->Sentagreement->create();

                if ($this->Sentagreement->save($this->request->data)) {
                $output = ['status'=>1];
                } else {
                $output = ['status'=>0];
                }
            }
           
        }

        $this->set('output', $output);

        $this->set(
                    array(
                        "_serialize" => array('output')
                    )
            );

	}


    public function sendAgreements($orgId=null,$userId=null){

        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
            
            $jobagreement_id = $this->request->data['Sentagreement']['jobagreement_id'];

            if($this->Sentagreement->hasAny(['organization_id'=>$orgId, 'user_id'=>$userId,'jobagreement_id'=>$jobagreement_id])){
                //error
                $output = ['status'=>2];
            } else {
            $this->request->data['Sentagreement']['date'] = date('Y-m-d');

            $this->request->data['Sentagreement']['user_id'] = $userId;
            $this->request->data['Sentagreement']['organization_id'] = $orgId;

            

            $this->Sentagreement->create();
          
          if ($this->Sentagreement->save($this->request->data)) {
                $output = ['status'=>1];
                } else {
                $output = ['status'=>0];
                }   

            }

            $this->set(array(
                    'output'=>$output,
                    '_serialize'=>'output'
                ));
        }
    }

    public function updateSentAgreements($orgId=null,$userId=null){

        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) 
        {
        $jobagreement_id = $this->request->data['Sentagreement']['jobagreement_id'];
        $rule = ['Sentagreement.organization_id'=>$orgId, 'Sentagreement.user_id'=>$userId,'Sentagreement.jobagreement_id'=>$jobagreement_id];
        
        if(!$this->Sentagreement->hasAny($rule))
        {          
            $this->request->data['Sentagreement']['user_id'] = $userId;
            $this->request->data['Sentagreement']['date'] = date('Y-m-d');
            $this->request->data['Sentagreement']['organization_id'] = $orgId;
            if ($this->Sentagreement->save($this->request->data)) {
                $output = ['status'=>1];
                } else {
                $output = ['status'=>0];
            }  
        } else {
            $this->Sentagreement->updateAll(
                    ['Sentagreement.user_id'=>$userId,'Sentagreement.organization_id'=>$orgId,'Sentagreement.jobagreement_id'=>$jobagreement_id],
                    $rule
                );
        } 

        $this->set(array(
            'output'=>$output,
            '_serialize'=>'output'
        ));
        
        }
    }


    // public function updateAgreements(){
    //     if ($this)
    // }

    public function myJobagreement($userId = null){
        $this->Sentagreement->recursive =1;
        $myjobagreement = $this->Sentagreement->myJobagreement($userId);

        $this->set(array(
            'myjobagreement' => $myjobagreement,
            "_serialize" => array('myjobagreement')
            ));
    }


    public function myJobagreementBYId($userId=null,$jobagreement_id=null){
        $this->Sentagreement->recursive=1;
        $myjobagreement = $this->Sentagreement->myJobagreementBYId($userId,$jobagreement_id);

        $this->set(array(
            'myjobagreement' => $myjobagreement,
            "_serialize" => array('myjobagreement')
            ));
    }

    public function listSentAgreement($orgId = null,$page = 1){
        
        $limit = 20;
        $this->paginate = array(
            'conditions'=>array('Sentagreement.organization_id'=>$orgId),
            'group'=>array('Sentagreement.user_id'),
            'limit'=>$limit,
            'page'=>$page
            );

        $list = $this->Paginator->paginate();
        $currentPage = $this->params['paging']['Sentagreement']['page'];
        $pageCount = $this->params['paging']['Sentagreement']['pageCount'];

        $output = array(
            "data" => $list,
            "pageCount" => $pageCount,
            "currentPage" => $currentPage,
        );


        $this->set(array(
                'output'=>$output,
                '_serialize'=>'output'
            ));
    }
}

?>