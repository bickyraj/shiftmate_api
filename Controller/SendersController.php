<?php
App::uses('AppController', 'Controller');
/**
 * Senders Controller
 *
 * @property Sender $Sender
 * @property PaginatorComponent $Paginator
 */
class SendersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function add() {
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
	        $this->request->data['Sender']['date_time'] = date('Y-m-d H:i:s');
	        $this->loadModel('Receiver');

	        $to = $this->request->data['Receiver']['to'];

	        if(isset($this->request->data['Sender']['board_id']))
	        {
	            $boardId = $this->request->data['Sender']['board_id'];
	        }
	        
	        if(isset($this->request->data['Sender']['branch_id']))
	        {
	            $branchId = $this->request->data['Sender']['branch_id'];
	        }
	        
	        if(isset($to) && empty($to) && !isset($branchId))
	        {
	            $this->loadModel('OrganizationUser');
	            $org_id = $this->request->data['Sender']['organization_id'];

	            $options = array('conditions'=>array('OrganizationUser.organization_id'=>$org_id));

	            $listUserId = $this->OrganizationUser->find('all', array('fields'=>'user_id', 'group'=>'user_id'), $options);
	            $this->Sender->create();
	            $this->request->data['Sender']['status'] = 2;
	            if($this->Sender->save($this->request->data)){
	            	$this->request->data['Receiver']['sender_id'] = $this->Sender->id;
	            }


	            foreach ($listUserId as $key => $value) {

	                $this->request->data['Receiver']['user_id'] = $value['OrganizationUser']['user_id'];
	                $this->Receiver->create();
	                if ($this->Receiver->save($this->request->data)) {
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
	                $options = array('conditions'=>array('BranchUser.branch_id'=>$this->request->data['Sender']['branch_id'], 'status'=>1), 'fields'=>'user_id', 'group'=>'user_id');

	                $listUserId = $this->BranchUser->find('list', $options);
	            }


	            if(isset($listUserId) && !empty($listUserId))
	            {

	                $this->Sender->create();
	                if($this->Sender->save($this->request->data)){
	                	$this->request->data['Receiver']['sender_id'] = $this->Sender->id;
	                }

	                foreach ($listUserId as $key => $value) {

	                    $this->request->data['Receiver']['user_id'] = $value;
	                    $this->Receiver->create();
	                    if ($this->Receiver->save($this->request->data)) {
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

	                $this->request->data['Sender']['organization_id'] = 1;
	                $this->request->data['Receiver']['user_id'] =$toUser['User']['id'];
	                $this->Receiver->create();

	                if ($this->Receiver->saveAll($this->request->data)) {
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

	public function sentMsgOrg($orgId = NULL, $page =1){
		$this->Sender->Behaviors->load('Containable');
		$conditions = array('Sender.organization_id'=>$orgId,'Sender.status !='=>1,'Sender.user_id'=>0); 
        
        $count = $this->Sender->find('count', array(
        		'conditions' => $conditions,
                'order'=>array('Sender.date_time'=>'DESC')
            ));

        $contains = array('Receiver','Receiver.User'=>['fname','lname']);
        
        $this->paginate = array(
                'limit'=>20,
                'conditions'=>$conditions,
                'order'=>array('Sender.date_time'=>'DESC'),
                'contain'=>$contains,
                'page'=>$page
            );

        $mySentMessage = $this->Paginator->paginate();

        $output = array(
                    "currentPage" => $this->params['paging']['Sender']['current'],
                    "page"=> $this->params['paging']['Sender']['page'],
                    "pageCount"=> $this->params['paging']['Sender']['pageCount'], 
                    "nextPage"=> $this->params['paging']['Sender']['nextPage'], 
                    "prevPage"=> $this->params['paging']['Sender']['prevPage'],
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

    public function sentMsgEmployee($userId = NULL, $page =1){
		$this->Sender->Behaviors->load('Containable');
    	$contains = array('Receiver','Receiver.User'=>['fname','lname']);
    	$conditions = array('Sender.user_id'=>$userId,'Sender.status !='=>1); 

        $count = $this->Sender->find('count', array(
                'conditions'=>$conditions,
                'order'=>array('Sender.date_time'=>'DESC')
            ));

        $this->paginate = array(
                'limit'=>20,
                'conditions'=>$conditions,
                'order'=>array('Sender.date_time'=>'DESC'),
                'contain'=>$contains,
                'page'=>$page
            );

        $mySentMessage = $this->Paginator->paginate();

      //  if(isset($mySentMessage) && !empty($mySentMessage)){

            $output = array(
                        "currentPage" => $this->params['paging']['Sender']['current'],
                        "page"=> $this->params['paging']['Sender']['page'],
                        "pageCount"=> $this->params['paging']['Sender']['pageCount'], 
                        "nextPage"=> $this->params['paging']['Sender']['nextPage'], 
                        "prevPage"=> $this->params['paging']['Sender']['prevPage'],
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


    public function getMessageDetail($msgId = null){
    	$output = $this->Sender->getMessageDetail($msgId);
    	
    	//debug($output);
    	
    	$this->set(array(
    			'output'=>$output,
    			'_serialize'=>'output'
    		));
    }

    public function deleteSentMessage($messageIds){
	  $ids = explode(',',$messageIds);
        
        $this->request->data['Sender']['status'] = 1;
        foreach($ids as $id){
            $this->Sender->id = $id;
            if($this->Sender->save($this->request->data)){
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

    public function addRequest(){
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Sender']['date_time'] = date('Y-m-d H:i:s');
            $this->Sender->create();
            
            $this->loadModel('Receiver');
            if($this->Sender->save($this->request->data)){

            	$this->Receiver->create();
                $this->request->data['Receiver']['status'] = 4;
            	$this->request->data['Receiver']['sender_id'] = $this->Sender->id;
            	if($this->Receiver->save($this->request->data)){
            		$output = 1; //saved
            	} else {
            		$output = 0;
            	}

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

    public function mySentRequests($user_id){
        $result = $this->Sender->mySentRequest($user_id);
        
        $this->set(array(
                'mySentRequests'=>$result,
                '_serialize'=>array('mySentRequests')
        ));
    }

    public function respondRequest($message_id,$status){
        $this->Sender->id=$message_id;
        $this->request->data['Sender']['requeststatus']=$status;
        if($this->Sender->save($this->request->data)){
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

}
