<?php
App::uses('AppModel', 'Model');
/**
 * Jobagreement Model
 *
 * @property Organization $Organization
 * @property Jobagreementtype $Jobagreementtype
 */
class Jobagreement extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	//public $displayField = 'id';

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
		'jobagreementtype_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'content' => array(
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
public $actsAs = array(
        'Upload.Upload' => array(
            'file' => array(
                'fields' => array(
				                    'dir' => 'file_dir',
				                    'type' => 'file_type',
				                    'size' => 'file_size',
				                ),
            )
        )
    );
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
		'Jobagreementtype' => array(
			'className' => 'Jobagreementtype',
			'foreignKey' => 'jobagreementtype_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	  public function jobAgreementList($orgId,$page) {
	  	$limit = 10;
	  	$output['page'] = $page;
	  	$output['agreements'] = $this->find('all', array('conditions'=>array('Jobagreement.organization_id'=>$orgId),'limit'=>$limit,'page'=>$page));
        $output['count'] = $this->find('count', array('conditions'=>array('Jobagreement.organization_id'=>$orgId)));
        $output['limit'] = $limit;
        //debug($output);
        return $output;
        }

        public function jobAgreementById($orgId = null,$jobagreement_id=null) {
            $agreement = $this->find('first', array(
                'conditions'=>array(
                    'Jobagreement.organization_id'=>$orgId,
                    'Jobagreement.id'=>$jobagreement_id
                    )
                ));
            return $agreement;
        }

        public function listTitle($typeId,$orgId){
         	$results = $this->find('all',array(
         			'conditions'=>['Jobagreement.jobagreementtype_id'=>$typeId,'Jobagreement.organization_id'=>$orgId,'Jobagreement.status'=>0],

         		));  
         	return $results;	 
        }

        
}
