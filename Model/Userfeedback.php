<?php
App::uses('AppModel', 'Model');
/**
 * Userfeedback Model
 *
 * @property Feed $Feed
 */
class Userfeedback extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'userfeedback';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'feed_id' => array(
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
		'Feed' => array(
			'className' => 'Feed',
			'foreignKey' => 'feed_id',
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
		'Board' => array(
			'className' => 'Board',
			'foreignKey' => 'board_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function getAllUserFeeds($user_id = null)
	{
		$this->Behaviors->load('Containable');
		$options = array('conditions'=>['Userfeedback.user_id'=>$user_id], 'contain'=>['Feed.User'=>['fields'=>['id', 'fname', 'lname', 'image', 'image_dir', 'gender']], 'Board'=>['fields'=>['id', 'title']]], 'order'=>'Userfeedback.created DESC');
		$data = $this->find('all', $options);

		return $data;
	}

	public function viewFeeds($userFeedback_id = null)
	{
		$this->Behaviors->load('Containable');
		$options = array('conditions'=>['Userfeedback.id'=>$userFeedback_id], 'contain'=>['Feed']);

		$data = $this->find('first', $options);

		return $data;
	}
}
