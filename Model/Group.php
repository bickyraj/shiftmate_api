<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 * @property Organization $Organization
 */
class Group extends AppModel {

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
	public $hasMany = array(
		'UserGroup' => array(
			'className' => 'UserGroup',
			'foreignKey' => 'group_id',
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


	public function findUserOfGroup($orgId){

		$this->Behaviors->load('Containable');

		$user = $this->find('all',array(
			'conditions'=>array('Group.organization_id'=>$orgId),
			'contain'=>array('Organization','UserGroup','UserGroup.User'=>array('fields'=>array('fname','lname')))
			));

		//debug($user);
		return $user;
	}

	public function listGroup($orgId){
		//$this->Behaviors->load('Containable');
		$this->recursive = -1;
		$group = $this->find('all',array(
			'conditions' => array('Group.organization_id'=>$orgId),
			'contain' => array('Group')
			));

		return $group;
	}
}
