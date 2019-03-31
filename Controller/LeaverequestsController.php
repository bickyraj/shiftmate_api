<?php
App::uses('AppController', 'Controller');

class LeaverequestsController extends AppController {
 /**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator', 'RequestHandler');
    
    public function beforeFilter() {
            parent::beforeFilter();
        }
      
      
/**
 * myLeaveRequests method
 * @param int $user_id
 * @return null
 **/  
    public function myLeaveRequests($user_id,$startat){
            $myLeaveRequest = $this->Leaverequest->myLeaveRequests($user_id,$startat);
            $this->set(array(
                    'myLeaveRequest' => $myLeaveRequest,
                    '_serialize' => array('myLeaveRequest')              
            ));
    }
    
    
/**
 * userLeaveRequests method
 * @param int $user_id
 * @return null
 **/  
    public function userLeaveRequests($org_id=null,$user_id=null,$status){
        //$limit = 10;
        //$this->paginate = array('limit'=>$limit);
        //$userRequest = $this->Paginator->paginate();                         
        $userRequest=$this->Leaverequest->userLeaveRequest($org_id,$user_id,$status);
        //$page=$this->params['paging']['Leaverequest']['pageCount'];
        //$currentPage = $this->params['paging']['Leaverequest']['page'];
        
         /* $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "userLeaveRequests",
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            ); */

       // $this->set('output', $output);
        $this->set('userLeaveRequest', $userRequest);
            
        $this->set(array(
            '_serialize'=>array('userLeaveRequest')
        ));      
    }
    
    
    public function distinctLeaveUsers($org_id = null,$startlimit = 1,$status = null){
        $leaveDistincts=$this->Leaverequest->distinctLeaveUser($org_id,$startlimit,$status);
        $this->set('leaveDistinct', $leaveDistincts);    
        $this->set(array(
            '_serialize'=>array('leaveDistinct')
        ));
    }
    
/**
 * saveLeaveRequests method
 * @return null
 **/  
    public function saveLeaveRequest(){
       if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
        
        $this->Leaverequest->create();
        $this->request->data['Leaverequest']['status']='0';
        $start = new DateTime($this->request->data['Leaverequest']['startdate']);
        $end = new DateTime($this->request->data['Leaverequest']['enddate']);
        $diff = $start->diff($end);
        $this->request->data['Leaverequest']['dayscount']= ($diff->format('%a')+1);
        if($this->Leaverequest->save($this->request->data)){
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
   
   public function respondRequest($leave_id){
    $this->Leaverequest->id=$leave_id;
   // $this->request->data[Leaverequest][status]=$act;
    if($this->Leaverequest->save($this->request->data)){
        $message="success";
    }else{
        $message="error";
    }
        $this->set(array(
        'message'=>$message,
        '_serialize'=>array('message')
        ));
   }
   
   public function countAcceptedLeave($orgId,$userId,$date=null,$fromdate=null){
    $count=$this->Leaverequest->countAcceptedLeave($orgId,$userId);
        $this->set(array(
        'count'=>$count,
        '_serialize'=>array('count')
        ));
   }
   

}