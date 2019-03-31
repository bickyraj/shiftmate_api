<?php
App::uses('AppController', 'Controller');

class ShiftplanUsersController extends AppController {

    public function deleteShiftPlanUser($shiftplanId=null){
    	if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
        
        if($this->ShiftplanUser->deleteAll(array('ShiftplanUser.shiftplan_id'=> $shiftplanId))){
            $output['status'] = 1;
        } else {
            $output['status'] = 0;
        }
            $this->set(array(
                'output'=>$output,
                '_serialize'=>'output'
                ));

    	}
    }

    public function getShiftPlanUser($shiftplanId=null,$date=null){

    	$shiftPlanUser = $this->ShiftplanUser->getShiftPlanUser($shiftplanId,$date);
    	//debug($shiftPlanUser);
    	
    	$this->set(array(
    		'shiftPlanUser'=>$shiftPlanUser,
    		'_serialize'=>'shiftPlanUser'
    		));
    }

    public function assignDetail($planId){
        $output = $this->ShiftplanUser->assignDetail($planId);
        //debug($output);
        // foreach($output as $o){
        //     debug($o);
        // }
        $this->set(array(
                'output'=>$output,
                '_serialize'=>'output',
                'jsonp'=>true
            ));
    }
}  