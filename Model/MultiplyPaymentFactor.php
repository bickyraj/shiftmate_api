<?php
App::uses('AppModel', 'Model');
/**
 * MultiplyPaymentFactor Model
 *
 * @property Organization $Organization
 * @property Multiplypaymentfactortype $Multiplypaymentfactortype
 */
class MultiplyPaymentFactor extends AppModel {

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
		'multiplypaymentfactortype_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'multiply_factor' => array(
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
		'Multiplypaymentfactortype' => array(
			'className' => 'Multiplypaymentfactortype',
			'foreignKey' => 'multiplypaymentfactortype_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Branch' => array(
			'className' => 'Branch',
			'foreignKey' => 'branch_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Shift' => array(
			'className' => 'Shift',
			'foreignKey' => 'shift_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        public function listPaymentFactors($org_id = NULL, $branch_id = NULL, $date = NULL){
            if($branch_id == NULL){
                $listPaymentFactors = $this->find('all', array(
                'conditions' => array(
                    'MultiplyPaymentFactor.organization_id' => $org_id,
                    'OR'=>array(
                    		'MultiplyPaymentFactor.implement_date <=' => $date,
		                    'MultiplyPaymentFactor.end_date >=' =>$date,
		                    'MultiplyPaymentFactor.status' =>2
                    	),
                    
                ),
                'order'=>array(
                		'MultiplyPaymentFactor.id' => 'DESC'
                	)
            ));
            }else{
                $listPaymentFactors = $this->find('all', array(
                    'conditions' => array(
                        'MultiplyPaymentFactor.organization_id' => $org_id,
                        'OR'=>array(
                        		'MultiplyPaymentFactor.branch_id' => $branch_id,
		                        'MultiplyPaymentFactor.implement_date <=' => $date,
		                        'MultiplyPaymentFactor.end_date >=' =>$date,
		                        'MultiplyPaymentFactor.status' =>2
                        	),
                        
                    ),
                    'order'=>array(
                		'MultiplyPaymentFactor.id' => 'DESC'
                	)
                ));
            }
            
            return $listPaymentFactors;
        }
        
        public function paymentFactorRates($org_id = NULL, $branch_id = NULL){
            if($branch_id == NULL){
                $paymentFactorRates = $this->find('all', array(
                    'conditions' => array(
                        'MultiplyPaymentFactor.organization_id' => $org_id,
                        'MultiplyPaymentFactor.status' => 1
                    )
                ));
            }else{
                $paymentFactorRates = $this->find('all', array(
                    'conditions' => array(
                        'MultiplyPaymentFactor.organization_id' => $org_id,
                        'MultiplyPaymentFactor.branch_id' => $branch_id,
                        'MultiplyPaymentFactor.status' => 1
                    )
                ));
            }
            return $paymentFactorRates;
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
