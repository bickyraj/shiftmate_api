<?php
App::uses('AppModel', 'Model');
/**
 * Jobagreementtype Model
 *
 * @property Jobagreement $Jobagreement
 */
class Jobagreementtype extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Jobagreement' => array(
			'className' => 'Jobagreement',
			'foreignKey' => 'jobagreementtype_id',
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

	 public function listJobAgreementType($page,$orgId) {
	 		$this->recursive = -1;
	 		$limit = 10;
	  		$output['page'] = $page;
			$output['limit'] = $limit;
			$conditions = array('Jobagreementtype.organization_id'=>$orgId);
	 		
            $output['types'] = $this->find('all',array('limit'=>$limit,'page'=>$page,'conditions'=>$conditions));
            $output['count'] = $this->find('count');
            return $output;
        }

     public function jobAgreementTypeById($id){
     	$this->recursive = -1;
     	$result = $this->find('first',array(
     			'conditions'=> array('Jobagreementtype.id'=>$id)
     		));
     	return $result;
     }

}
