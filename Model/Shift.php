<?php
App::uses('AppModel', 'Model');
/**
 * Shift Model
 *
 * @property Organization $Organization
 * @property ShiftBoard $ShiftBoard
 * @property ShiftUser $ShiftUser
 * @property Userleave $Userleave
 */
class Shift extends AppModel {

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
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ShiftBranch' => array(
			'className' => 'ShiftBranch',
			'foreignKey' => 'shift_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
        'ShiftBoard' => array(
			'className' => 'ShiftBoard',
			'foreignKey' => 'shift_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ShiftUser' => array(
			'className' => 'ShiftUser',
			'foreignKey' => 'shift_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Userleave' => array(
			'className' => 'Userleave',
			'foreignKey' => 'shift_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Permanentshift' => array(
			'className' => 'Permanentshift',
			'foreignKey' => 'shift_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),

		'Shiftnote' => array(
			'className' => 'Shiftnote',
			'foreignKey' => 'shift_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),

		'Shiftswap' => array(
			'className' => 'Shiftswap',
			'foreignKey' => 'shift_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),

		'Shiftchecklist' => array(
			'className' => 'Shiftchecklist',
			'foreignKey' => 'shift_id',
			'dependent' => true,
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
        
        public function checkMyOrganizationShift($organization_id = NULL){
            $status = $this->find('count', array(
                'conditions'=> array(
                    'Shift.organization_id' => $organization_id,
                    'Shift.status' => 1
                    )
            ));
            return $status;
        }
        
        public function myOrganizationShift($organization_id = NULL){
            $checkShift = $this->checkMyOrganizationShift($organization_id);
            if($checkShift > 0){
                $shift = $this->find('all', array(
                    'conditions'=>array(
                        'Shift.organization_id' => $organization_id,
                        'Shift.status' => 1
                    )
                ));
            }else{
                $shift = 0;
            }
            return $shift;
        }

       
        //manohar
        public function findShiftById($ShiftId = null){

        	$shifts = $this->find('first',array(
        		'conditions'=>array('Shift.id'=>$ShiftId)
        		));
        	return $shifts;
        }

        // manohar
        public function findShiftTime($shiftId = null){
        	$this->recursive = -1;
        	$time = $this->find('first',array(
        		'conditions'=>array('Shift.id'=>$shiftId),
        		'fields'=>array('starttime')
        		));

        	return $time['Shift']['starttime'];
        	//return $time;
        }

        function shiftListByOrg($userId){
			
			$org = ClassRegistry::init('OrganizationUser');
			$shiftAvailability = ClassRegistry::init('Shiftavailability');
			$myOrg = $org->myOrganizationLists($userId);
			
			
			$orgIds = array();

			foreach($myOrg as $o){
				$orgIds[] = $o['Organization']['id'];
			}


			if(count($orgIds) == 1){
				$conditions = array('Shift.organization_id'=>$orgIds['0']);
			} else {
				$conditions = array('Shift.organization_id in'=>$orgIds);
			}

			$this->Behaviors->load("Containable");
        	$results = $this->find("all",array(
        			'conditions'=>$conditions,
        			'contain'=>array('Organization'=>['id','title'])
        		));

        	$shifts = array();
        	
			if(isset($results) && !empty($results)){
				
				foreach($results as $key=>$s){
					$availability = $shiftAvailability->availability($userId,$s['Shift']['organization_id'],$s['Shift']['id']);
					$s['Shift']['availability'] = $availability;
					$shifts[$s['Organization']['title']][$key] = $s['Shift'];
				}
				
			}

        	return $shifts;
        }

}
