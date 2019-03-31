<?php
App::uses('AppModel', 'Model');
/**
 * Shift Model
 *
 * @property Organization $Organization
 * @property ShiftBoard $ShiftBoard
 * @property ShiftUser $ShiftUser
 * @property Userleave $Userleave
 */
class Shiftavailability extends AppModel {
	
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
		),
		'Shift' => array(
			'className' => 'Shift',
			'foreignKey' => 'shift_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)


	);

	public function availability($userId,$orgId,$shiftId){
		$conditions = ['Shiftavailability.organization_id'=>$orgId,'Shiftavailability.user_id'=>$userId,'Shiftavailability.shift_id'=>$shiftId];
		
		if($this->hasAny($conditions)){
			$results = $this->find('first',array(
				'recursive'=>-1,
				'conditions'=>$conditions,
				'fields'=>array('status')
				));

			$status = $results['Shiftavailability']['status'];
			
		} else {
			$status = 0;
		}

		return $status;

	}


}	