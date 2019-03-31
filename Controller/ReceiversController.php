<?php
App::uses('AppController', 'Controller');
/**
 * Recivers Controller
 *
 * @property Reciver $Reciver
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ReceiversController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	    public function messagesReceived($user_id = NULL, $page =1){
	    	$this->Receiver->Behaviors->load('Containable');
	    	$conditions = array('Receiver.user_id'=>$user_id,'Receiver.status != '=>1);
            $count = $this->Receiver->find('count',array(
                                                    'conditions'=> $conditions
                                                    )
                                        );
            $contains = array('Sender','Sender.User'=>['fname','lname','email'],'Sender.Organization'=>['title'],'Sender.Branch'=>['title'],'Sender.Board'=>['title']);
            $this->paginate = array(
                        'limit'=>20,
                        'conditions'=>$conditions,
                       // 'order'=>array('Message.date_time'=>'DESC'),
                        'page'=>$page,
                        'contain'=>$contains
                    );

            $myMessage = $this->Paginator->paginate();

            // debug($this->params);die();
          //  if(isset($myMessage) && !empty($myMessage)){

                $output = array(
                            "currentPage" => $this->params['paging']['Receiver']['current'],
                            "page"=> $this->params['paging']['Receiver']['page'],
                            "pageCount"=> $this->params['paging']['Receiver']['pageCount'], 
                            "nextPage"=> $this->params['paging']['Receiver']['nextPage'], 
                            "prevPage"=> $this->params['paging']['Receiver']['prevPage'],
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

        public function receivedMsgDetail($msgId = null){
        	$output = $this->Receiver->receivedMsgDetail($msgId);

        	$this->set(array(
        			'output'=>$output,
        			'_serialize'=>'output'
        		));
        }

    public function deleteMessageInbox($messageIds){
	  $ids = explode(',',$messageIds);
        
        $this->request->data['Receiver']['status'] = 1;
        foreach($ids as $id){
            $this->Receiver->id = $id;
            if($this->Receiver->save($this->request->data)){
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

    public function messageView($msg_id = null){
        $this->Receiver->id = $msg_id;
        
        if ($this->Receiver->saveField('status','2')) {
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

    public function messageCount($user_id = null)
    {

       $receivedMessage = $this->Receiver->messageCount($user_id);
       $this->set(
        array(
        'receivedMessage'=> $receivedMessage,
        '_serialize'=>'receivedMessage'
        ));

    }

    public function viewHeaderMsg($userId = null){
        $output = 0;
        if($this->Receiver->updateAll(
                array('status'=>3),
                array('Receiver.user_id'=>$userId)
            )){
            $output = 1;
        }
        $this->set(array(
            'output'=>$output,
            '_serialize'=>'output'
            ));
    }

    public function myReceivedRequests($user_id){
        $result = $this->Receiver->myReceivedRequest($user_id);
        $this->set(array(
                'myReceivedRequests'=>$result,
                '_serialize'=>array('myReceivedRequests')
        ));
    }

    public function myNewMessages($user_id = null)
    {
        
        $this->Receiver->updateAll(
                array('status'=>3),
                array('Receiver.user_id'=>$user_id)
                );
        
        
        $count = $this->Receiver->messageCount($user_id);

        $this->Receiver->Behaviors->load('Containable');
        $contain = array('Sender','Sender.Organization','Sender.User');
        $receivedMessage = $this->Receiver->find('all',array(
            'conditions' => array(
                'Receiver.user_id' => $user_id,
                'Receiver.status' => array('0','3')
                ),
            'contain'=>$contain,
            'limit'=>5,
            'order'=>array('Sender.date_time'=>'DESC')
            ));

       $this->set(
        array(
            'receivedMessage'=>$receivedMessage,
            'count'=>$count,
            '_serialize'=>array('receivedMessage','count'),
            '_jsonp'=>true
         ));

    }

}
