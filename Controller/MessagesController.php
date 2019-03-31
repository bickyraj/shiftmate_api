<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 *
 * @property Message $Message
 * @property PaginatorComponent $Paginator
 */
class MessagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
    // var $uses = array('OrganizationUser');
        
        public function deleteMessages() {
            
            foreach($this->request->data['Message']['id'] as $message_id){
		$this->Message->id = $message_id;
		
               if ($this->Message->delete()) {
			$output = 1;
		} else {
			$output = 0;
		}
            }
		$this->set(array(
                    'output' => $output,
                    '_serialize' => array('output')
                ));
	}
        
        public function getMessageDetail($message_id){
            $messageDetail = $this->Message->getMessageDetail($message_id);
            
            $this->set(array(
                'messageDetail' => $messageDetail,
                '_serialize' => array('messageDetail')
            ));
            
        }
        
        public function myReceiveMessage($user_id = NULL){
            $myMessage = $this->Message->myReceiveMessage($user_id);
            
            $this->set('myReceiveMessage', $myMessage);
            $this->set(
                    array(
                        '_serialize'=>array('myReceiveMessage')
                        )
                    );
        }
        
        public function mySentMessage($user_id = NULL){
            $myMessage = $this->Message->mySentMessage($user_id);
            
            $this->set('mySentMessage', $myMessage);
            $this->set(
                    array(
                        '_serialize'=>array('mySentMessage')
                        )
                    );


        }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Message->recursive = 0;
		$this->set('messages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
		$this->set('message', $this->Message->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
                    $this->request->data['Message']['date_time'] = date('Y-m-d H:i:s');
                    $this->request->data['Message']['status'] = 1;

                    $to = $this->request->data['Message']['to'];

                    if(isset($this->request->data['Message']['board_id']))
                    {
                        $boardId = $this->request->data['Message']['board_id'];
                    }
                    if(isset($this->request->data['Message']['branch_id']))
                    {
                        $branchId = $this->request->data['Message']['branch_id'];
                    }
                    if(isset($to) && empty($to) && !isset($branchId))
                    {
                        $this->loadModel('OrganizationUser');
                        $org_id = $this->request->data['Message']['organization_id'];

                        $options = array('conditions'=>array('OrganizationUser.organization_id'=>$org_id));

                        $listUserId = $this->OrganizationUser->find('all', array('fields'=>'user_id', 'group'=>'user_id'), $options);

                        foreach ($listUserId as $key => $value) {

                            $this->request->data['Message']['to'] = $value['OrganizationUser']['user_id'];
                            $this->Message->create();
                            if ($this->Message->save($this->request->data)) {
                                $output = 1;
                            } else {
                                $output = 0;
                            }
                        }
                    }
                    elseif(isset($branchId) && !empty($branchId))
                    {
                        $this->loadModel('BoardUser');

                        if ($boardId != 0) {
                            $options = array('conditions'=>array('BoardUser.board_id'=>$boardId),'fields'=>'user_id', 'group'=>'user_id');
                            $listUserId = $this->BoardUser->find('list', $options);
                        }else
                        {
                            $this->loadModel('BranchUser');
                            $options = array('conditions'=>array('BranchUser.branch_id'=>$this->request->data['Message']['branch_id'], 'status'=>1), 'fields'=>'user_id', 'group'=>'user_id');

                            $listUserId = $this->BranchUser->find('list', $options);
                        }


                        if(isset($listUserId) && !empty($listUserId))
                        {
                            foreach ($listUserId as $key => $value) {

                                $this->request->data['Message']['to'] = $value;
                                $this->Message->create();
                                if ($this->Message->save($this->request->data)) {
                                    $output = 1;
                                } else {
                                    $output = 0;
                                }
                            }
                        }else
                        {
                            $output = 2;
                        }
                    }
                    else
                    {
                        $this->loadModel('User');
                        $this->User->recursive = -1;
                        $email = $to;
                        $toUser = $this->User->find('first', array('conditions'=>['User.email'=>$email]));

                        $output = 0;
                        if(isset($toUser) && !empty($toUser))
                        {

                            $this->request->data['Message']['organization_id'] = 0;
                            $this->request->data['Message']['to'] =$toUser['User']['id'];
                            $this->Message->create();

                            if ($this->Message->save($this->request->data)) {
                                $output = 1;
                            }
                        }
                    }
			
		}
                $this->set(array(
                    'output' => $output,
                    '_serialize' => array('output')
                ));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('The message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
			$this->request->data = $this->Message->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Invalid message'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Message->delete()) {
			$this->Session->setFlash(__('The message has been deleted.'));
		} else {
			$this->Session->setFlash(__('The message could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function listMessages($user_id=null)
	{
		$this->Message->recursive = 0;
            $limit = 20;
            $this->paginate = array('conditions'=>array('from'=>$user_id), 'limit'=>$limit);
      
            $messages = $this->Paginator->paginate();
            $page=$this->params['paging']['Message']['pageCount'];
            $currentPage = $this->params['paging']['Message']['page'];

            if (!empty($messages)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "listNoticeboards",
                "status" => $status,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );

            $this->set('output', $output);
            $this->set('messages', $messages);

            // debug($messages);
            // die();

            $this->set(
                    array(
                        "_serialize" => array('messages', 'output')
                    )
            );
	}
    

/* ******************* Ashok neupane ************************* */
    /**
     * MessagesController::addRequest()
     * 
     * @return void
     */
    public function addRequest(){
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Message']['date_time'] = date('Y-m-d H:i:s');
            $this->request->data['Message']['requeststatus']=0;
            $this->Message->create();
            if($this->Message->save($this->request->data)){
                $message="Request send";
            }else{
                $message="Request not Send";
            }
            $this->set(array(
                'message'=>$message,
                '_serialize'=>array('message')
            ));
        }
    }

    
    /**
     * MessagesController::mySentRequests()
     * 
     * @param mixed $user_id
     * @return void
     */
    public function mySentRequests($user_id){
        $result=$this->Message->mySentRequest($user_id);
        $this->set(array(
                'mySentRequests'=>$result,
                '_serialize'=>array('mySentRequests')
        ));
    }
    
    
    /**
     * MessagesController::myReceivedRequests()
     * 
     * @param mixed $user_id
     * @return void
     */
    public function myReceivedRequests($user_id){
        $result=$this->Message->myReceivedRequest($user_id);
        $this->set(array(
                'myReceivedRequests'=>$result,
                '_serialize'=>array('myReceivedRequests')
        ));
    }

    /**
     * MessagesController::orgMeetingRequests()
     * 
     * @param mixed $org_id
     * @return void
     */
    public function orgMeetingRequests($org_id){
         $result=$this->Message->orgMeetingRequest($org_id);
        $this->set(array(
                'orgMeetingRequests'=>$result,
                '_serialize'=>array('orgMeetingRequests')
        ));
    }

    /**
     * MessagesController::respondRequest()
     * 
     * @param mixed $message_id
     * @param mixed $status
     * @return void
     */
    public function respondRequest($message_id,$status){
        $this->Message->id=$message_id;
        $this->request->data['Message']['requeststatus']=$status;
        if($this->Message->save($this->request->data)){
            $message=1;
        }else{
            $message=0;
        }
        $this->set(array(
                'message'=>$message,
                '_serialize'=>array('message'),
                '_jsonp'=>true
        ));
}


/* ************************************************** */

    /*By rabi*/
    public function messageCount($user_id = null,$message_status = 'received')
    {
        if ($message_status == "received") {
            $this->Message->recursive = -1;
            $receivedMessage = $this->Message->find('count',array(
                'conditions' => array(
                    'Message.to' => $user_id,
                    'Message.status' => '1'
                    )
                ));
            // debug($receivedMessage);
            // die();
           $this->set('receivedMessage', $receivedMessage);
        }
        else
        {
            $this->Message->recursive = -1;
            $sendMessage = $this->Message->find('count',array(
                'conditions' => array(
                    'Message.from' => $user_id,
                    'Message.status' => '1'
                    )
                ));
            $this->set('sendMessage', $sendMessage);
        }
         $this->set(
                    array(
                        "_serialize" => array('receivedMessage', 'sendMessage')
                    )
            );
    }
    public function messageView($msg_id = null){
        $this->Message->id = $msg_id;
        $changestatus = $this->Message->saveField('status','2');
        if ($changestatus) {
            $viewMessage = 1;
        }
        else{
           $viewMessage = 0; 
        }
        
        $this->set('output', $viewMessage);
        $this->set(
                    array(
                        "_serialize" => array('output', 'output'),
                        '_jsonp'=>true
                    )
            );
    }

    public function meetingRequestNotifications($user_id = null)
    {  
            $options = array('conditions'=>['Message.status'=>5, 'Message.requeststatus'=>0, 'Message.to'=>$user_id, 'Message.managerNotification'=>0]);
            $meetingRequest = $this->Message->find('all', $options);
            $meetingRequestCount = $this->Message->find('count', $options);

            // debug($meetingRequest);die();

            if(!empty($meetingRequest))
            {
                $this->Message->updateAll(["managerNotification"=>1],
                    [
                    'Message.to'=>$user_id,
                    'Message.requeststatus'=>0,
                    'Message.status'=>5, 
                    'Message.managerNotification'=>0
                    ]);
                $output = ['meetingRequests'=>$meetingRequest,
                        'status'=>1,
                        'meetingRequestCount'=>$meetingRequestCount];
            }
            else
            {
                $output = ['status'=>0];
            }
            $this->set(array(
                        'output'=>$output,
                        '_serialize'=>['output'],
                        '_jsonp'=>true
                        ));
    }

    public function messagesReceived($user_id = NULL, $page =1){

            $count = $this->Message->find('count',array(
                                                    'conditions'=>array('Message.to'=>$user_id,'Message.status != '=>0),
                                                    'order'=>array('Message.date_time ASC')
                                                    )
                                        );

            $this->paginate = array(
                        'limit'=>20,
                        'conditions'=>array('Message.to'=>$user_id,'Message.status != '=>0),
                        'order'=>array('Message.date_time'=>'DESC'),
                        'page'=>$page
                    );

            $myMessage = $this->Paginator->paginate();

            // debug($this->params);die();
          //  if(isset($myMessage) && !empty($myMessage)){

                $output = array(
                            "currentPage" => $this->params['paging']['Message']['current'],
                            "page"=> $this->params['paging']['Message']['page'],
                            "pageCount"=> $this->params['paging']['Message']['pageCount'], 
                            "nextPage"=> $this->params['paging']['Message']['nextPage'], 
                            "prevPage"=> $this->params['paging']['Message']['prevPage'],
                            "totalData"=>$count,
                            "status"=>1
                    );
         //   }else{
//               $output = array("status"=>0); 
//            }
            // $myMessage = $this->Message->find('all');
            
            $this->set('myReceiveMessage', $myMessage);
            $this->set(
                    array(
                        'output'=>$output,
                        '_serialize'=>array('myReceiveMessage', 'output')
                        )
                    );
        }

        public function listSentMessage($user_id = NULL, $page =1){


                $count = $this->Message->find('count', array(
                        'conditions'=>array('Message.from'=>$user_id,'Message.status !='=>0),
                        'order'=>array('Message.date_time'=>'DESC')
                    ));

                $this->paginate = array(
                        'limit'=>20,
                        'conditions'=>array('Message.from'=>$user_id,'Message.status !='=>0),
                        'order'=>array('Message.date_time'=>'DESC'),
                        'page'=>$page
                    );

                $mySentMessage = $this->Paginator->paginate();

              //  if(isset($mySentMessage) && !empty($mySentMessage)){

                    $output = array(
                                "currentPage" => $this->params['paging']['Message']['current'],
                                "page"=> $this->params['paging']['Message']['page'],
                                "pageCount"=> $this->params['paging']['Message']['pageCount'], 
                                "nextPage"=> $this->params['paging']['Message']['nextPage'], 
                                "prevPage"=> $this->params['paging']['Message']['prevPage'],
                                "totalData"=>$count,
                                "status"=>1
                        );
              //  }else{
//                   $output = array("status"=>0); 
//                }
                // $myMessage = $this->Message->find('all');
                
                $this->set('mySentMessage', $mySentMessage);
                $this->set(
                        array(
                            'output'=>$output,
                            '_serialize'=>array('mySentMessage', 'output')
                            )
                        );
        }


        public function listOfSentMessage($user_id = NULL, $page =1){


                $count = $this->Message->find('count', array(
                        'conditions'=>array('Message.from'=>$user_id,'Message.status !='=>3),
                        'order'=>array('Message.date_time'=>'DESC')
                    ));

                $this->paginate = array(
                        'limit'=>20,
                        'conditions'=>array('Message.from'=>$user_id,'Message.status !='=>3),
                        'order'=>array('Message.date_time'=>'DESC'),
                        'page'=>$page
                    );

                $mySentMessage = $this->Paginator->paginate();

              //  if(isset($mySentMessage) && !empty($mySentMessage)){

                    $output = array(
                                "currentPage" => $this->params['paging']['Message']['current'],
                                "page"=> $this->params['paging']['Message']['page'],
                                "pageCount"=> $this->params['paging']['Message']['pageCount'], 
                                "nextPage"=> $this->params['paging']['Message']['nextPage'], 
                                "prevPage"=> $this->params['paging']['Message']['prevPage'],
                                "totalData"=>$count,
                                "status"=>1
                        );
              //  }else{
//                   $output = array("status"=>0); 
//                }
                // $myMessage = $this->Message->find('all');
                
                $this->set('mySentMessage', $mySentMessage);
                $this->set(
                        array(
                            'output'=>$output,
                            '_serialize'=>array('mySentMessage', 'output')
                            )
                        );
        }

        public function listOfOrgSentMessage($orgId = NULL, $page =1){


                $count = $this->Message->find('count', array(
                        'conditions'=>array('Message.organization_id'=>$orgId,'Message.status !='=>3),
                        'order'=>array('Message.date_time'=>'DESC')
                    ));

                $this->paginate = array(
                        'limit'=>20,
                        'conditions'=>array('Message.organization_id'=>$orgId,'Message.status !='=>3),
                        'order'=>array('Message.date_time'=>'DESC'),
                        'page'=>$page
                    );

                $mySentMessage = $this->Paginator->paginate();

                    $output = array(
                                "currentPage" => $this->params['paging']['Message']['current'],
                                "page"=> $this->params['paging']['Message']['page'],
                                "pageCount"=> $this->params['paging']['Message']['pageCount'], 
                                "nextPage"=> $this->params['paging']['Message']['nextPage'], 
                                "prevPage"=> $this->params['paging']['Message']['prevPage'],
                                "totalData"=>$count,
                                "status"=>1
                        );
                
                $this->set('mySentMessage', $mySentMessage);
                $this->set(
                        array(
                            'output'=>$output,
                            '_serialize'=>array('mySentMessage', 'output')
                            )
                        );
        }

        public function deleteSelectedMessage($messageIds){
            $ids = explode(',',$messageIds);
            
            $this->request->data['Message']['status'] = 0;
            foreach($ids as $id){
                $this->Message->id = $id;
                if($this->Message->save($this->request->data)){
                    $output['status'] = 1;//updated
                } else {
                    $output['status'] = 0;
                }
            }

            $this->set(array(
                    'output'=>$output,
                    '_serialize'=>'output'
                ));
        }

        public function deleteMessageBySender($messageIds){
            $ids = explode(',',$messageIds);
            
            $this->request->data['Message']['status'] = 3;
            foreach($ids as $id){
                $this->Message->id = $id;
                if($this->Message->save($this->request->data)){
                    $output['status'] = 1;//updated
                } else {
                    $output['status'] = 0;
                }
            }

            $this->set(array(
                    'output'=>$output,
                    '_serialize'=>'output'
                ));
        }

}
