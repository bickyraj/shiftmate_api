<?php
App::uses('AppModel', 'Model');
/**
 * Requesttimeoff Model
 *
 * @property Timeoffdaytype $Timeoffdaytype
 * @property Timeofftype $Timeofftype
 * @property Organization $Organization
 * @property Branch $Branch
 * @property Board $Board
 * @property User $User
 */
class Requesttimeoff extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'requesttimeoff';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'timeoffdaytype_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'timeofftype_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'startdate' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'enddate' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'starttime' => array(
			'time' => array(
				'rule' => array('time'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'endtime' => array(
			'time' => array(
				'rule' => array('time'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
		'message' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

public $actsAs = array(
        'Upload.Upload' => array(
            'document' => array(
                'fields' => array(
				                    'dir' => 'document_dir',
				                    'type' => 'document_type',
				                    'size' => 'document_size',
				                )
            )
        )
    );

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Timeoffdaytype' => array(
			'className' => 'Timeoffdaytype',
			'foreignKey' => 'timeoffdaytype_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Timeofftype' => array(
			'className' => 'Timeofftype',
			'foreignKey' => 'timeofftype_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
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


	public function getAllRequests($orgId = null)
	{
		$options = array('conditions'=>['Requesttimeoff.organization_id'=>$orgId], 'order'=>'Requesttimeoff.created DESC');

		$data = $this->find('all', $options);

		return $data;
	}

	public function getSingleRequests($reqId = null)
	{
		$options = array('conditions'=>['Requesttimeoff.id'=>$reqId]);

		$data = $this->find('first', $options);

		return $data;
	}

	public function getAllUserRequests($userId = null)
	{
		$options = array('conditions'=>['Requesttimeoff.user_id'=>$userId], 'order'=>'Requesttimeoff.created DESC');

		$data = $this->find('all', $options);

		return $data;
	}

	public function overallInCalendar($user_id){
	    $results = $this->find('all',array('conditions'=>array('Requesttimeoff.user_id'=>$user_id, 'Requesttimeoff.status'=>2)));
	    $count=0;
	    $mySch=array();
	    foreach($results as $result){
	        $mySch[$count]['title']="Leave";
	        $mySch[$count]['description']=$result['Requesttimeoff']['message'];
	        $mySch[$count]['start']=$result['Requesttimeoff']['startdate'];
	        $mySch[$count]['end']=$result['Requesttimeoff']['enddate'];
	        $mySch[$count]['org']['id']=$result['Organization']['id'];
	        $mySch[$count]['org']['title']=$result['Organization']['title'];
	        //$mySch[$count]['board']=$result['Board']['title'];
	        $mySch[$count]['status']=$result['Requesttimeoff']['status'];
	        $mySch[$count]['id']=$result['Requesttimeoff']['id'];
	        $count++;
	    }
	    return $mySch;
	 }

	 public function getAllEmployeeLeaves($orgId = null)
	 {
	 	$this->Behaviors->load('Containable');

	 	$options = array('conditions'=>['Requesttimeoff.organization_id'=>$orgId, 'Requesttimeoff.status'=>2], 'contain'=>['User'=>['id', 'fname', 'lname'], 'Organization'=>['id', 'title'], 'Timeoffdaytype', 'Timeofftype']);

	 	$results = $this->find('all', $options);

	 	$count=0;
	 	$mySch=array();
        foreach($results as $result){
            $mySch[$count]['user']['id']=$result['User']['id'];
            $mySch[$count]['user']['name']=$result['User']['fname']." ".$result['User']['lname'];
            $mySch[$count]['description'] = $result['Requesttimeoff']['message'];
            $mySch[$count]['start']=$result['Requesttimeoff']['startdate']."T"."00:00:00";
            $mySch[$count]['title']="Leave";
            $mySch[$count]['status']=$result['Requesttimeoff']['status']; 
            $mySch[$count]['id']=$result['Requesttimeoff']['id'];
            $count++;
        }
        return $mySch;
	 }
}
