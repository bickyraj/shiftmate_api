<?php
App::uses('AppModel', 'Model');
/**
 * Liscense Model
 *
 * @property User $User
 */
class Liscense extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		// 'user_id' => array(
		// 	'numeric' => array(
		// 		'rule' => array('numeric'),
		// 		//'message' => 'Your custom message here',
		// 		//'allowEmpty' => false,
		// 		//'required' => false,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// ),
		// 'type' => array(
		// 	'notEmpty' => array(
		// 		'rule' => array('notEmpty'),
		// 		//'message' => 'Your custom message here',
		// 		//'allowEmpty' => false,
		// 		//'required' => false,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// ),
		// 'issuedate' => array(
		// 	'date' => array(
		// 		'rule' => array('date'),
		// 		//'message' => 'Your custom message here',
		// 		//'allowEmpty' => false,
		// 		//'required' => false,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// ),
		// 'expirydate' => array(
		// 	'date' => array(
		// 		'rule' => array('date'),
		// 		//'message' => 'Your custom message here',
		// 		//'allowEmpty' => false,
		// 		//'required' => false,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// ),
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

	public function view($userId){
		$this->recursive = -1;
		return $this->find('first',array('conditions'=>array('Liscense.user_id'=>$userId)));
	}

	public function getUserExpLiscenseList($userId = null)
	{
		$this->Behaviors->load('Containable');
		$today = date('Y-m-d');
		$options = array(
			'conditions'=>[
							'Liscense.user_id'=>$userId,
							'AND'=>['DATEDIFF(expirydate,"'.$today.'")'=>1, 'useenstatus'=>0]
							],
			'contain'=>['User'=>['fname', 'lname', 'id']]
			);
		$data = $this->find('all', $options);

		$this->updateAll(
                            array('Liscense.useenstatus' => 1),
                            // conditions
                            array('Liscense.user_id' => $userId, 'DATEDIFF(expirydate,"'.$today.'")'=>1, 'Liscense.useenstatus'=>0)
                        );

		return $data;
	}
}
