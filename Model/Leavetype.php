<?php
App::uses('AppModel', 'Model');

class Leavetype extends AppModel{
    public $validate = array(
		'name' => array(
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
  public $hasMany=array(
            'Leaverequest' => array(
			'className' => 'Leaverequest',
			'foreignKey' => 'leavetype_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
  );
  
  public function getTypes($orgId){
    return $this->find('all',array('conditions'=>array('organization_id'=>$orgId)));
  }
}