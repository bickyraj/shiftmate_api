<?php
App::uses('AppModel', 'Model');
/**
 * BranchUser Model
 *
 * @property Branch $Branch
 * @property User $User
 */
class BranchUser extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'Branch' => array(
			'className' => 'Branch',
			'foreignKey' => 'branch_id',
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
    
    public function getBranchUser($branchId){
        return $this->find('all',array('conditions'=>array('BranchUser.branch_id'=>$branchId)));
    }

    public function getUserRelatedBranches($userId = null)
    {
    	$this->Behaviors->load('Containable');
    	$this->recursive = 2;
    	$options = array('conditions'=>['BranchUser.user_id'=>$userId, 'BranchUser.status'=>1], 'group by'=>'branch_id', 'contain'=>['Branch.id','Branch.title','Branch.organization_id']);

    	$list = $this->find('all', $options);
    	//debug($list);
    	return $list;
    }

    public function getBranchesOfUsers($userId = null,$orgId = null)
    {
    	$this->Behaviors->load('Containable');
    	$this->recursive = 2;
    	$options = array(
    				'conditions'=>['BranchUser.user_id'=>$userId, 'BranchUser.status'=>1],
    				'group by'=>'branch_id',
    				'contain'=>['Branch.id','Branch.title','Branch.organization_id']);

    	$list = $this->find('all', $options);
    	//debug($list);


    	$results = array();
    	$i = 0;
    	if(isset($list) && !empty($list)){
    		foreach($list as $r){
    			if($r['Branch']['organization_id'] == $orgId){
    				$results[$i]['BranchUser'] = $r['BranchUser'];
    				$results[$i]['Branch'] = $r['Branch'];
    			}
    			$i++;
    		}
    	}

    	return $results;
    }
}

