<?php
App::uses('AppModel', 'Model');
/**
 * Sender Model
 *
 * @property Organization $Organization
 * @property Branch $Branch
 * @property Board $Board
 * @property User $User
 * @property Reciver $Reciver
 */
class Sender extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'organization_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'branch_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'board_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'title' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
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
		'date_time' => array(
			'datetime' => array(
				'rule' => array('datetime'),
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
		'Organization' => array(
			'className' => 'Organization',
			'foreignKey' => 'organization_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Branch' => array(
			'className' => 'Branch',
			'foreignKey' => 'branch_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Board' => array(
			'className' => 'Board',
			'foreignKey' => 'board_id',
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

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Receiver' => array(
			'className' => 'Receiver',
			'foreignKey' => 'sender_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public function listOrgMessage($orgId){
		$this->Behaviors->load('Containable');
		$contain = array('Organization'=>['title'],'Branch'=>['title'],'Board'=>['title'],'Receiver','Receiver.User'=>['fname','lname']);
		$results = $this->find('all',array(
			'conditions'=>array('Sender.organization_id'=>$orgId,'Sender.status != '=>1),
			'recursive'=>2,
			'contain'=>$contain
			
			));
		return $results;
	}

	public function getMessageDetail($msgId){
		
		$this->Behaviors->load('Containable');
		
		$contain = array('Organization'=>['title','email','logo','logo_dir'],'Branch'=>['title'],'Board'=>['title'],'Receiver','Receiver.User'=>['fname','lname'],'User'=>['fname','lname','email','image','image_dir']);
		
		$results = $this->find('first',array(
			'conditions'=>array('Sender.id'=>$msgId),
			'recursive'=>2,
			'contain'=>$contain
			
			));
		return $results;
	
	}

	public function mySentRequest($user_id){
 		$this->Behaviors->load('Containable');
 		$contain = array('Organization'=>['title','email','logo','logo_dir'],'Branch'=>['title'],'Board'=>['title'],'Receiver','Receiver.User'=>['fname','lname','email','image','image_dir'],'User'=>['fname','lname','email','image','image_dir']);
        $results = $this->find('all',array(
        	'conditions'=>array('Sender.status'=>3,'Sender.user_id'=>$user_id,'Sender.requesteddate >='=>date('Y-m-d')),
        	'order'=>array('Sender.date_time DESC'),
        	'contain'=>$contain
        	));
        return $results;


    }

}
