<?php
App::uses('AppController', 'Controller');

class LeavetypesController extends AppController {
    /**
     * LeavetypesController::getTypes()
     * 
     * @param mixed $orgId
     * @return void
     */
    public function getTypes($orgId){
        
        $gettype = $this->Leavetype->getTypes($orgId);
        $this->set(array(
                    'leavetypes' => $gettype,
                    '_serialize' => array('leavetypes'),
                    '_jsonp'=>true             
            ));
    }
    
    /**
     * LeavetypesController::addLeaveType()
     * 
     * @return void
     */
    public function addLeaveType(){
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
            $this->Leavetype->create();
            if($this->Leavetype->save($this->request->data)){
                $message1="0";
            }else{
                $message1="1";
            }
            $this->set(array(
            'message'=>$message1,
            '_serialize'=>array('message'),
            '_jsonp'=>true
            ));
        }
    }
            /**
             * LeavetypesController::editContactType()
             * 
             * @return void
             */
    public function editLeaveType(){
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) { 
            $this->Leavetype->id=$this->request->data['Leavetype']['id'];
            if($this->Leavetype->save($this->request->data)){
                $message1="0";
            }else{
                $message1="1";
            }
            $this->set(array(
            'message'=>$message1,
            '_serialize'=>array('message'),
            '_jsonp'=>true
            ));
        }
    }
    /**
     * LeavetypesController::deleteLeaveType()
     * 
     * @return void
     */
    public function deleteLeaveType(){
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) { 
            if($this->Leavetype->delete($this->request->data['Leavetype']['id'])){
                $message1="0";
            }else{
                $message1="1";
            }
            $this->set(array(
            'message'=>$message1,
            '_serialize'=>array('message'),
            '_jsonp'=>true
            ));
        }
    }
}
?>