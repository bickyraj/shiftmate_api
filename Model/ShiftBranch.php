<?php
App::uses('AppModel', 'Model');
/**
 * ShiftBranch Model
 *
 * @property Shift $Shift
 * @property Branch $Branch
 */
class ShiftBranch extends AppModel {
	var $shiftBranchIds =array();
        function afterSave($created,$options = array())
        {
        	 if($created) {
		            $this->shiftBranchIds[] = $this->getInsertID();
		        }
		        return true;
        }

/**
 * Validation rules
 *
 * @var array
 */
	/*public $validate = array(
		'shift_id' => array(
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
	);*/

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Shift' => array(
			'className' => 'Shift',
			'foreignKey' => 'shift_id',
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
        
        public function checkShiftInBranch($branch_id = NULL){
            $count = $this->find('count', array(
                'conditions' => array(
                    'ShiftBranch.branch_id' => $branch_id,
                    'ShiftBranch.status' => 1
                )
            ));
           return $count;
        }
        
        public function getBranchRelatedShift($branch_id = NULL){
            $checkShift = $this->checkShiftInBranch($branch_id);
            if($checkShift > 0){
                $shifts = $this->find('all', array(
                    'conditions' => array(
                        'ShiftBranch.branch_id' => $branch_id,
                        'ShiftBranch.status' => 1
                    )
                ));                
            }else{
                $shifts = 0;
            }
            return $shifts;
        }
        public function shiftBranch_Ids($branch_id =null)
        {

            $this->recursive = -1;
            $shiftIds = $this->find('all',array(
                    'conditions' =>array(
                        'ShiftBranch.branch_id' => $branch_id
                        )
                ));
            $shift_ids = array();
            foreach ($shiftIds as $shiftId) {
                $shift_ids[] = $shiftId['ShiftBranch']['shift_id'];
            }

            return $shift_ids;
            
        }
        public function shiftRelatedBranch($shiftId = null)
        {
            $this->recursive = -1;
            $shiftBranch = $this->find('all',array(
                    'conditions' => array(
                            'ShiftBranch.shift_id' => $shiftId
                        )
                ));
            return $shiftBranch;
        }

        public function filterShiftByBranch( $branchId = null)
        {
        	$options = array('conditions'=>['ShiftBranch.branch_id' => $branchId], 'group by'=>'ShiftBranch.shift_id');

        	$result = $this->find('all', $options);

        	return $result;
        }
        
}
