<?php
App::uses('AppController', 'Controller');

class ContacttypesController extends AppController {
    
    public function getContactTypes($orgid){
        $contactTypes=$this->Contacttype->getContactType($orgid);
        $this->set(array(
            'contactTypes' => $contactTypes,
            '_serialize' => array('contactTypes')              
        ));
    }

    public function contactTypeByBranch($orgId,$branchId){
        $output = $this->Contacttype->contactTypeByBranch($orgId,$branchId);
        $this->set(array(
                'output'=>$output,
                '_serialize'=>'output'
            ));
    }
    
    
    public function saveContactType(){
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) { 
        $this->Contacttype->create();
        $this->request->data['Contacttype']['status']='0';
        $rule = array('Contacttype.branch_id'=>$this->request->data['Contacttype']['branch_id'],'Contacttype.title'=>$this->request->data['Contacttype']['title']);
        if($this->Contacttype->hasAny($rule)){
            $message1 = "2";
        } else {
            if($this->Contacttype->save($this->request->data)){
                $message1="0";
            }else{
                $message1="1";
            }
        }    
        $this->set(array(
        'message'=>$message1,
        '_serialize'=>array('message')
        ));
    }
    }
    
        public function editContactType(){
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) { 
        $this->Contacttype->id=$this->request->data['Contacttype']['id'];
        $rule = array('Contacttype.branch_id'=>$this->request->data['Contacttype']['branch_id'],'Contacttype.title'=>$this->request->data['Contacttype']['title']);
        if($this->Contacttype->hasAny($rule)){
            $message1 = "2";
        } else {
            if($this->Contacttype->save($this->request->data)){
                $message1="0";
            }else{
                $message1="1";
            }
        }    
        $this->set(array(
        'message'=>$message1,
        '_serialize'=>array('message')
        ));
    }
    }
    
    public function deleteContactType(){
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) { 
        if($this->Contacttype->delete($this->request->data['Contacttype']['id'])){
            $message1="0";
        }else{
            $message1="1";
        }
        $this->set(array(
        'message'=>$message1,
        '_serialize'=>array('message')
        ));
    }
    }
    
}

?>