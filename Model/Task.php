<?php
App::uses('AppModel', 'Model');
/**
 * Task Model
 *
 * @property User $User
 */
class Task extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	//public $displayField = 'id';

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
		'task' => array(
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function listTask($user_id=null,$page=1){
	   $limit = 15;
		$tasks['tasks'] = $this->find('all',array('conditions'=>array(
				'Task.user_id'=>$user_id,
				'Task.status'=>0
				),
            'page'=>$page,
            'limit'=>$limit,
			'order'=>array('Task.id DESC')
			));
        $count=$this->find('count',array('conditions'=>array(
				'Task.user_id'=>$user_id,
				'Task.status'=>0
				),
			));
        $tasks['page']=$page;
        $tasks['maxPage']=ceil($count/$limit);
		return $tasks;
	}
}
