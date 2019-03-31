<?php
App::uses('AppController', 'Controller');

class ShiftplangroupsController extends AppController {

    public function deleteGroup($shiftplanId=null){
    	if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
        
        if($this->Shiftplangroup->deleteAll(array('Shiftplangroup.shiftplan_id'=> $shiftplanId))){
        	$output['status'] = 1;
        } else {
        	$output['status'] = 0;
        }

        	$this->set(array(
    			'output'=>$output,
    			'_serialize'=>'output',
    			'jsonp'=>true
    		));

    	}
    	
    }

}  