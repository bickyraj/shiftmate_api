<?php
App::uses('AppModel', 'Model');
/**
 * Emergencyprocedureinstructionlist Model
 *
 * @property Emergencyprocedures $Emergencyprocedures
 */
class Emergencyprocedureinstructionlist extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'emergencyprocedure_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'instruction' => array(
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
		'Emergencyprocedure' => array(
			'className' => 'Emergencyprocedure',
			'foreignKey' => 'emergencyprocedure_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
