<?php
App::uses('AppModel', 'Model');
/**
 * Multiplypaymentfactortype Model
 *
 * @property MultiplyPaymentFactor $MultiplyPaymentFactor
 */
class Multiplypaymentfactortype extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
        
        public $belongsTo = array(
		'Organization' => array(
			'className' => 'Organization',
			'foreignKey' => 'organization_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'MultiplyPaymentFactor' => array(
			'className' => 'MultiplyPaymentFactor',
			'foreignKey' => 'multiplypaymentfactortype_id',
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
        
        public function listPaymentFactorTypes($org_id){
           $listPaymentFactorTypes = $this->find('all', array(
                'conditions' => array(
                    'Multiplypaymentfactortype.organization_id' => [$org_id,0]
                ),
                'order'=>array(
                	'Multiplypaymentfactortype.id' => 'DESC'
                )
            ));
            
            return $listPaymentFactorTypes;
        }
        
         public function organizationBranchList($org_id = NULL){
            $branches = ClassRegistry::init('Branch');
            $branchList = $branches->find('list', array(
                'conditions' => array(
                    'Branch.organization_id' => $org_id
                )
            ));
            
            return $branchList;
        }

}
