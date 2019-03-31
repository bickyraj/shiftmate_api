<?php
App::uses('AppModel', 'Model');
/**
 * Sentagreement Model
 *
 * @property Jobagreement $Jobagreement
 * @property User $User
 */
class Sentagreement extends AppModel {

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
		'id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'jobagreement_id' => array(
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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Jobagreement' => array(
			'className' => 'Jobagreement',
			'foreignKey' => 'jobagreement_id',
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
		'Organization' => array(
			'className' => 'Organization',
			'foreignKey' => 'organization_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function myJobagreement($userId = null){
		$jobagreement = $this->find('all',array(
			'conditions'=>array('Sentagreement.user_id'=>$userId)	
			));
		return $jobagreement;
	}


	public function myJobagreementBYId($userId,$jobagreement_id){
		$jobagreement = $this->find('first',array(
			'conditions'=>array('Sentagreement.user_id'=>$userId,'Sentagreement.jobagreement_id'=>$jobagreement_id)	
			));
		return $jobagreement;
	}


	public function sendAgreementcheck($jobagreement_id,$orgId,$userId){
		$count = $this->find('count',array(
			'conditions'=>array('Sentagreement.user_id'=>$userId,'Sentagreement.organization_id'=>$orgId,'Sentagreement.jobagreement_id'=>$jobagreement_id)
			));
		return $count;
	}

	// public function updateSentAgreements($orgId,$userId){
 //    	$sentagreements = $this->find('first',array(
 //    		'conditions'=>array(
 //    			'Sentagreement.organization_id'=>$orgId,
 //    			'Sentagreement.user_id'=>$userId
 //    		),	
 //    		'order'=>array('Sentagreement.id DESC')
    			
 //    		));
 //    	return $sentagreements['Sentagreement']['id'];
 //    }	

	public function listSentAgreement($orgId){
		$results = $this->find('all',array(
			'conditions'=>array('Sentagreement.organization_id'=>$orgId),
			'group'=>array('Sentagreement.user_id')
			));
		return $results;
	}	
}
