<?php
App::uses('AppModel', 'Model');
/**
 * Board Model
 *
 * @property Organization $Organization
 * @property User $User
 * @property Branch $Branch
 * @property BoardUser $BoardUser
 * @property Boardmessage $Boardmessage
 * @property ShiftUser $ShiftUser
 * @property Userleave $Userleave
 */
class Board extends AppModel {

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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
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
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'BoardUser' => array(
			'className' => 'BoardUser',
			'foreignKey' => 'board_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Leaveholiday' => array(
			'className' => 'Leaveholiday',
			'foreignKey' => 'board_id',
			'dependent' => false,
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
			'foreignKey' => 'board_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Boardmessage' => array(
			'className' => 'Boardmessage',
			'foreignKey' => 'board_id',
			'dependent' => false,
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
			'foreignKey' => 'board_id',
			'dependent' => false,
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
			'foreignKey' => 'board_id',
			'dependent' => false,
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
			'foreignKey' => 'board_id',
			'dependent' => false,
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
			'foreignKey' => 'board_id',
			'dependent' => false,
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
			'foreignKey' => 'board_id',
			'dependent' => false,
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
			'foreignKey' => 'board_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),

		'Message' => array(
			'className' => 'Message',
			'foreignKey' => 'board_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Requesttimeoff' => array(
			'className' => 'Requesttimeoff',
			'foreignKey' => 'board_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Feed' => array(
			'className' => 'Feed',
			'foreignKey' => 'board_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Userfeedback' => array(
			'className' => 'Userfeedback',
			'foreignKey' => 'user_id',
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
        
        public function boardDetail($board_id = NULL){
            $boardDetail = $this->find('first', array(
                'conditions' => array(
                    'Board.id' => $board_id,
                    'Board.status' => 1
                )
            ));
            return $boardDetail;
        }
        
        public function checkForBoardManager($user_id = NULL, $board_id = NULL){
            $check = $this->find('count', array(
                'conditions' => array(
                    'Board.id' => $board_id,
                    'Board.user_id' => $user_id,
                    'Board.status' => 1
                )
            ));
            return $check;
        }
        
        public function getBranchId($boardId=null){
            $this->recursive = -1;
            return $this->find('first',array(
                'conditions'=>array('Board.id'=>$boardId),
                'fields'=>array("Board.id,Board.branch_id")
            ));
        }

        public function findBoardName($board_id){
        	$boardDetail = $this->find('first', array(
                'conditions' => array(
                    'Board.id' => $board_id
                ),
                'recursive' => -1,
                'fields' => array('title') 
            ));
            return $boardDetail;
        }

        public function findBoardId($branchId){
        	$this->recursive = -1;
        	$data = array();

        	$results = $this->find('all',array(
        		'conditions'=>array(
        			'Board.branch_id'=>$branchId,
        			'Board.status'=>1
        			),
        		'fields'=>array('id')	
        		));
        	if(!empty($results)){
        		foreach($results as $r){
        			$data[] = $r['Board']['id']; 
        		}
        	}

        	return $data;
        }
       
}
