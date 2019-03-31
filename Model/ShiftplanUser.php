<?php
App::uses('AppModel', 'Model');
/**
 * ShiftplanUser Model
 *
 * @property Shiftplan $Shiftplan
 * @property ShiftUser $ShiftUser
 */
class ShiftplanUser extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'shiftplan_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'shift_user_id' => array(
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
		'Shiftplan' => array(
			'className' => 'Shiftplan',
			'foreignKey' => 'shiftplan_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ShiftUser' => array(
			'className' => 'ShiftUser',
			'foreignKey' => 'shift_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    
    public function getClosedPlans($orgId,$userId){
        $this->Behaviors->load('Containable');
        return $this->find('all',array('contain'=>array('Shiftplan','Shiftplan.Board','Shiftplan.Shift','ShiftUser'),'conditions'=>array('Shiftplan.organization_id'=>$orgId,'ShiftUser.user_id'=>$userId,'Shiftplan.documenttype'=>'2'),'group'=>array('Shiftplan.title')));
    }
    public function getAClosedPlan($orgId,$userId){
        $this->Behaviors->load('Containable');
        return $this->find('first',array(
				'contain'=>array('Shiftplan','Shiftplan.Board','Shiftplan.Organization','Shiftplan.Shift','ShiftUser'),
				'order'=>array('Shiftplan.created_date'=>'DESC'),
				'conditions'=>array('Shiftplan.organization_id'=>$orgId,'ShiftUser.user_id'=>$userId,'Shiftplan.documenttype'=>'2')
		));
    }

    public function getShiftPlanUser($shiftplanId,$date){

    	$this->Behaviors->load('Containable');
    	$shiftPlanUsers = $this->find('all',array(
    		'conditions'=>array('ShiftplanUser.shiftplan_id'=>$shiftplanId,'ShiftplanUser.shift_date'=>$date),
    		'contain'=>array('ShiftUser','ShiftUser.User'=>array('fields'=>array('User.fname','User.lname')))
    		));

    	//debug($shiftPlanUsers);

    	$count=0;
    	$shiftPlanUser = array();
    	if($shiftPlanUsers){
	    	foreach($shiftPlanUsers as $shift){
	    		if(isset($shift['ShiftUser']['User']) && !empty($shift['ShiftUser']['User'])){
	    			$shiftPlanUser[$count]['fname'] = $shift['ShiftUser']['User']['fname'];
	    			$shiftPlanUser[$count]['lname'] = $shift['ShiftUser']['User']['lname'];
	    			$shiftPlanUser[$count]['shift_date'] = $shift['ShiftplanUser']['shift_date'];
	    		}

	    		
	    		$count++;
	    	}
    	}

    	//debug($shiftPlanUser);
    	return $shiftPlanUser;
    }

    public function assignDetail($planId){
    	$this->Behaviors->load('Containable');
    	$result = $this->find('all',array(
    			'conditions'=>array('ShiftplanUser.shiftplan_id'=>$planId),
    			'contain'=>['ShiftUser.User', 'ShiftUser.User'=>['fields'=>['fname', 'lname']]],
    		));
    	if(!empty($result)){
	    	$output = array();
	    	$c = 0;
	    	foreach($result as $res){
	    		$output[$res['ShiftUser']['shift_date']][$c]['user'] = $res['ShiftUser']['User']['fname'].' '.$res['ShiftUser']['User']['lname'];
	    		$c++;
	    	}
    	} else {
    		$output = 1;
    	}
    	return $output;
    }
}
