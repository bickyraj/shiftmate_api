<?php
App::uses('AppModel', 'Model');
/**
 * Message Model
 *
 */
class Message extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'from' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'to' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'content' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
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
        
        public $belongsTo = array(
		'UserFrom' => array(
			'className' => 'User',
			'foreignKey' => 'from',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'UserTo' => array(
			'className' => 'User',
			'foreignKey' => 'to',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Organization'=> array(
			'className' => 'Organization',
			'foreignKey' => 'organization_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),

		'Board'=> array(
			'className' => 'Board',
			'foreignKey' => 'board_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Branch'=> array(
			'className' => 'Branch',
			'foreignKey' => 'branch_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        
        public function myReceiveMessage($user_id = NULL){
         $myReceiveMessage = $this->find('all', array(
             'order' => 'Message.date_time DESC',
             'conditions' => array(
                 'Message.to' => $user_id
             )
         ));   
         return $myReceiveMessage;
        }
        
        public function mySentMessage($user_id = NULL){
            $mySentMessage = $this->find('all', array(
                'order' => 'Message.date_time DESC',
                'conditions' => array(
                     'Message.from' => $user_id
                )
         ));   
         return $mySentMessage;
        }
        
        public function getMessageDetail($message_id){
            $this->Behaviors->load('Containable');
            $messageDetail = $this->find('first', array(
                'contain' => array(
                    'UserFrom'=> array(
                        'fields'=> array('UserFrom.fname', 'UserFrom.lname', 'UserFrom.image_dir', 'UserFrom.image', 'UserFrom.email')
                        ),
                    'UserTo' => array(
                        'fields' => array('UserTo.fname', 'UserTo.lname', 'UserTo.image_dir', 'UserTo.image', 'UserTo.email')
                    ),
                    'Organization'
                    ),
                'conditions' => array(
                    'Message.id' => array($message_id)
                )/*,
                'fields' => array('UserFrom.fname', 'UserFrom.lname', 'UserTo.fname', 'UserTo.lname')*/
            ));
            return $messageDetail;
        }
        
  /* *********************** Ashok Neupane ********************** */      
        /**
         * Message::mySentRequest()
         * 
         * @param int $user_id
         * @return array
         */
        public function mySentRequest($user_id){
            return $this->find('all',array('conditions'=>array('Message.status'=>5,'Message.from'=>$user_id,'Message.requesteddate >='=>date('Y-m-d')),'order'=>array('Message.date_time DESC')));
        }
        /**
         * Message::myReceivedRequest()
         * 
         * @param int $user_id
         * @return array
         */
        public function myReceivedRequest($user_id){
            return $this->find('all',array('conditions'=>array('Message.status'=>5,'Message.to'=>$user_id,'Message.requesteddate >='=>date('Y-m-d')),'order'=>array('Message.date_time DESC')));
        }
        /**
         * Message::orgMeetingRequest()
         * 
         * @param int $org_id
         * @return array
         */
        public function orgMeetingRequest($org_id){
            return $this->find('all',array('conditions'=>array('Message.status'=>5,'Message.organization_id'=>$org_id,'Message.requesteddate >='=>date('Y-m-d')),'order'=>array('Message.date_time DESC')));
        }
  /* ******************************************************* */
}
