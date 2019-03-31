<?php
App::uses('AppController', 'Controller');
/**
 * Shifts Controller
 *
 * @property Shift $Shift
 * @property PaginatorComponent $Paginator
 */
class ShiftavailabilitiesController extends AppController {

		public $components = array('Paginator');

	public function updateAvailability($userId){
		$shiftId = $this->request->data['Shiftavailability']['shift_id'];
		$orgId = $this->request->data['Shiftavailability']['organization_id'];
		$status = $this->request->data['Shiftavailability']['status'];
		$this->request->data['Shiftavailability']['user_id'] = $userId;

		if($this->Shiftavailability->hasAny(['user_id'=>$userId,'shift_id'=>$shiftId,'organization_id'=>$orgId])){
			$this->Shiftavailability->updateAll(
				array(
					'Shiftavailability.status'=>$status
				),
				array(
					'Shiftavailability.user_id'=>$userId,'Shiftavailability.organization_id'=>$orgId,'Shiftavailability.shift_id'=>$shiftId
					)

				);
			$output['status'] = $status;
			
		} 
		else {
			$this->Shiftavailability->create();
			if($this->Shiftavailability->saveAll($this->request->data)){
				$output['status'] = $status;//saved
			}
		}

		$this->set(array(
			'output'=>$output,
			'_serialize'=>'output'
			));
	}

}