<?php
App::uses('AppModel', 'Model');
/**
 * Organizationmessage Model
 *
 * @property Organization $Organization
 * @property User $User
 */
class Organizationmessage extends AppModel {

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
		'text' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
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
		)
	);
        
        public function myOrganizationMessages($organization_id = NULL){
            $myOrganizationMessages = $this->find('all', array(
                'conditions'=> array(
                    'Organizationmessage.organization_id' => $organization_id
                )
            ));
            return $myOrganizationMessages;
        }
        
        public function getMessageDetail($message_id){
            $this->Behaviors->load('Containable');
            $messageDetail = $this->find('first', array(
                'contain' => array(
                    'User'=> array(
                        'fields'=> array('User.id','User.fname', 'User.lname', 'email', 'User.image', 'User.image_dir')
                        )
                    ),
                'conditions' => array(
                    'Organizationmessage.id' => array($message_id)
                )/*,
                'fields' => array('UserFrom.fname', 'UserFrom.lname', 'UserTo.fname', 'UserTo.lname')*/
            ));
            return $messageDetail;
        }
        
}
