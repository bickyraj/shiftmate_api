<?php
App::uses('AppModel', 'Model');
/**
 * Organizationfunction Model
 *
 * @property Organization $Organization
 * @property Branch $Branch
 */
class Organizationfunction extends AppModel {

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
		'branch_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'note' => array(
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
		'Organization' => array(
			'className' => 'Organization',
			'foreignKey' => 'organization_id',
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
		)
	);
        
        public function listFunctionForOrganization($org_id = NULL){
              $organizationFunctions = $this->find('all', array(
                  'conditions'=> array(
                      'Organizationfunction.organization_id' => $org_id
                  )
              ));
              return $organizationFunctions;
        }
        
        public function holidays($org_id = NULL, $branch_id = NULL, $start_date = NULL, $end_date = NULL){
            if($branch_id == NULL){
                $branch_id = 0;
            }
                       
            $holidays = $this->find('all', array(
                'fields'=>array('Organizationfunction.function_date'),
                'conditions' => array(
                    'Organizationfunction.organization_id' => $org_id,
                    'Organizationfunction.branch_id' => $branch_id,
                    'Organizationfunction.function_date >=' => $start_date,
                    'Organizationfunction.function_date <=' => $end_date,
                    'Organizationfunction.status' => 0
                )
            ));
            return $holidays;
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
        
        /**
         * Organizationfunction::addFunctionAjax()
         * 
         * @param mixed $data
         * @return
         */
        public function addFunctionAjax($data){
            $this->create();
            if($this->save($data)){
               return $this->find('first',array('conditions'=>array('Organizationfunction.id'=>$this->getInsertID())));
            }else{
                return "error";
            }
        }
}
