<?php
App::uses('AppModel', 'Model');
/**
 * Organizationrole Model
 *
 * @property Organization $Organization
 * @property OrganizationUser $OrganizationUser
 */
class Organizationrole extends AppModel {

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

/**
 * belongsTo associations
 *
 * @var array
 */
	/*public $belongsTo = array(
		'Organization' => array(
			'className' => 'Organization',
			'foreignKey' => 'organization_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);*/

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'OrganizationUser' => array(
			'className' => 'OrganizationUser',
			'foreignKey' => 'organizationrole_id',
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
        
        public function organizationRoleList($orgId = NULL){
            $this->Behaviors->load('Containable');
            $roles = $this->find('list', array(
                'contain' => false,
                'conditions' => array(
                    'Organizationrole.organization_id' => $orgId,
                    'Organizationrole.status'=>1
                ),
                'order'=>array(
                	'Organizationrole.id' => 'DESC'
            	)
            ));
            
            return $roles;
        }
        public function orgRoleList() {
            $orgRoleList = $this->find('list');
           	return $orgRoleList;
        }
       
       	public function findRoleTitle($roleId = null){
			return $this->find('first',array(
				'conditions'=>array('Organizationrole.id'=>$roleId,'Organizationrole.status'=>1)
				));
		}
}
