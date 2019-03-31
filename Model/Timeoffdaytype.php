<?php
App::uses('AppModel', 'Model');
/**
 * Timeoffdaytype Model
 *
 * @property Requesttimeoff $Requesttimeoff
 */
class Timeoffdaytype extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'timeoffdaytype';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'type' => array(
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

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Requesttimeoff' => array(
			'className' => 'Requesttimeoff',
			'foreignKey' => 'timeoffdaytype_id',
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

}
