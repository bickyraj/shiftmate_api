<?php
App::uses('AppController', 'Controller');

class ContactsController extends AppController {
    
    public function getContactLists($orgid){
        $contactList=$this->Contact->getContactList($orgid);
        $this->set(array(
            'contactList' => $contactList,
            '_serialize' => array('contactList')              
        ));
    }
    public function saveContactList(){
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) { 
        $this->Contact->create();
        $this->request->data['Contact']['status']='0';
        $rule1 = array('Contact.branch_id'=>$this->request->data['Contact']['branch_id'],'Contact.email'=>$this->request->data['Contact']['email']);
        $rule2 = array('Contact.branch_id'=>$this->request->data['Contact']['branch_id'],'Contact.phone'=>$this->request->data['Contact']['phone']);

        $resData = array();

        if($this->Contact->hasAny($rule1) || $this->Contact->hasAny($rule2)){
            $message1="2";
        } else {
            if($this->Contact->save($this->request->data)){
                $message1="0";
                $id = $this->Contact->id;

                $options = array('conditions'=>['Contact.id'=>$id]);
                $resData = $this->Contact->find('first', $options);

            }else{
                $message1="1";
            }
        }    
        $this->set(array(
        'message'=>$message1,
        'resData'=>$resData,
        '_serialize'=>array('message','resData')
        ));
    }
    }
    
    public function editContactList(){
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
            $this->Contact->id=$this->request->data['Contact']['id'];
        
        $rule1 = array('Contact.branch_id'=>$this->request->data['Contact']['branch_id'],'Contact.email'=>$this->request->data['Contact']['email'],'Contact.id !='=>$this->Contact->id);
        $rule2 = array('Contact.branch_id'=>$this->request->data['Contact']['branch_id'],'Contact.phone'=>$this->request->data['Contact']['phone'],'Contact.id !='=>$this->Contact->id);

        $count1 = $this->Contact->find('count',array(
                'conditions'=>$rule1
            ));

        $count2 = $this->Contact->find('count',array(
                'conditions'=>$rule2
            ));

        if($count1 > 0 || $count2 > 0){
            $message1="2";
        } else {
            if($this->Contact->save($this->request->data)){
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
    
        public function deleteContactList(){
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) { 
        if($this->Contact->delete($this->request->data['Contact']['id'])){
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