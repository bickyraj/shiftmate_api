<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class JobagreementsController extends AppController {
    /**
     * Components
     *
     * @var array
     */

    public function saveJobagreement($orgId=null)
    {
	   if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {

           $this->request->data['Jobagreement']['date'] = date('Y-m-d');
           $this->request->data['Jobagreement']['organization_id'] = $orgId;

            $this->Jobagreement->create();

            $rule = array('Jobagreement.organization_id'=>$orgId,'Jobagreement.jobagreementtype_id'=>$this->request->data['Jobagreement']['jobagreementtype_id'],'Jobagreement.title'=>$this->request->data['Jobagreement']['title']);
            if($this->Jobagreement->hasAny($rule)){
                $output = ['status'=>2]; // already exist
            }  else{
                if ($this->Jobagreement->save($this->request->data)) {
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


        public function jobAgreementList($orgId = null,$page=null) {
            
			  $agreements = $this->Jobagreement->jobAgreementList($orgId,$page);
        		$this->set(array(
                    'agreements' => $agreements,
                    '_serialize' => array('agreements')
                ));        	

        }	


        public function jobAgreementById($orgId = null,$jobagreement_id=null) {
            $agreement = $this->Jobagreement->jobAgreementById($orgId,$jobagreement_id);
                $this->set(array(
                    'agreement' => $agreement,
                    '_serialize' => array('agreement')
                )); 
        
        }

        public function listTitle($typeId = null,$orgId = null){
            $output = $this->Jobagreement->listTitle($typeId,$orgId);
            $this->set(array(
                'output'=>$output,
                '_serialize'=>'output'
                ));
        }      

 }
?>
