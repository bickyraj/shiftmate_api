<?php
App::uses('AppModel', 'Model');
/**
 * UserGroup Model
 *
 * @property User $User
 * @property Group $Group
 */
class UserGroup extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'group_id' => array(
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

    public function listAllEmployeesInGroup($groupId){
        return $this->find('all',array('conditions'=>array('UserGroup.group_id'=>$groupId)));
    }

	// manohar
	public function findGroupOfUser($userId){

		$group = $this->find('all',array(
			'conditions'=>array('UserGroup.user_id'=>$userId),
			'contain'=>array('Group')
			));

		//debug($group);
		return $group; 
	}


	public function findAllUserOfGroup($groupId){

		$this->recursive = -1;
		$user = $this->find('all',array(
			'conditions'=>array('UserGroup.group_id'=>$groupId)
			));
		return $user;
	}
}
