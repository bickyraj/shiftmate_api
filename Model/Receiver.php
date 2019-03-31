<?php
App::uses('AppModel', 'Model');
/**
 * Reciver Model
 *
 * @property Sender $Sender
 * @property User $User
 */
class Receiver extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'sender_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'viewdate' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Sender' => array(
			'className' => 'Sender',
			'foreignKey' => 'sender_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	public function receivedMsgDetail($msgId){
		
		$this->Behaviors->load('Containable');
		
		$contain = array('Sender','Sender.Organization'=>['title','email','logo','logo_dir'],'Sender.Branch'=>['title'],'Sender.Board'=>['title'],'Sender.User'=>['fname','lname','email','image','image_dir']);
		
		$results = $this->find('first',array(
			'conditions'=>array('Receiver.id'=>$msgId),
			'recursive'=>2,
			'contain'=>$contain
			
			));
		return $results;
	
	}

	public function myReceivedRequest($user_id){
            $this->Behaviors->load('Containable');
            //
            $contain = array('Sender'=>['conditions'=>['Sender.requesteddate >='=>date('Y-m-d')],'order'=>array('Sender.date_time DESC')],'Sender.Organization'=>['title','email','logo','logo_dir'],'Sender.Branch'=>['title'],'Sender.Board'=>['title'],'Sender.User'=>['fname','lname','email','image','image_dir']);

            $resullts = $this->find('all',array(
            	'conditions'=>array('Receiver.status'=>4,'Receiver.user_id'=>$user_id),
            	'contain'=>$contain
            	));
            return $resullts;
        }

    public function messageCount($user_id){
        $this->recursive = -1;
	        $receivedMessage = $this->find('count',array(
	            'conditions' => array(
	                'Receiver.user_id' => $user_id,
	                'Receiver.status' => '0'
	                )
	            ));

	       return $receivedMessage; 
    	}


	
}
