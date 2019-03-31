<?php
App::uses('AppController', 'Controller');
 
 class ShiftchecklistsController extends AppController{

 	//public $uses = array('Shiftchecklist');
     public $components = array('Paginator', 'RequestHandler');

 	public function addShiftchecklist(){

 	 if($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {


 		$this->Shiftchecklist->create();
 		$this->request->data['Shiftchecklist']['status'] = 0;
 		$this->request->data['Shiftchecklist']['created'] = date('Y-m-d');


 		if ($this->Shiftchecklist->saveAll($this->request->data)) {
                    $output['status'] = 1;
                    $output['data'] = $this->request->data;
                    $output['shiftChecklistId'] = $this->Shiftchecklist->id;
                    //$this->set("last", $this->Myaccount->getLastInsertId());
                } else {
                    $output['status'] = 0;
                }


 	}
 		$this->set(
 			array(
 				'output'=>$output,
				'_serialize'=>array('output')
 				)

 			);
 		
 	}

 	public function listCheckList($board_id = null ){

	$checkLists = $this->Shiftchecklist->listCheckList($board_id);

	$this->set(array(
		'checkLists'=>$checkLists,
		'_serialize'=>'checkLists'
		));
	}
 	
 	public function viewCheckList($shiftId=null)
    {

    	// $checkLists = $this->Shiftchecklist->listCheckList($boardId);
        $options = array('conditions' => array('Shiftchecklist.' . $this->Shiftchecklist->primaryKey => $shiftId));
        $checklist = $this->Shiftchecklist->find('first', $options);
        $this->set('checklist', $checklist);
        $this->set(
                array(
                        "_serialize" => array('checklist'),
                        "_jsonp"=>true
                    )
        ); 
    }



     public function editCheckList()
    {


        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) 
        {

            
        	$this->Shiftchecklist->id = $this->request->data['Shiftchecklist']['id'];
                    $this->loadModel('Checklist');

                    $this->Checklist->deleteList($this->Shiftchecklist->id);

                    if ($this->Shiftchecklist->saveAll($this->request->data)) {
                        
                        $output = array(
                            "params" => $this->request,
                            "method" => $this->method,
                            "action" => "editCheckList",
                            "status" => 1
                        );
                    } else {
                        $output = array(
                            "params" => $this->request,
                            "method" => $this->method,
                            "action" => "editCheckList",
                            "status" => 0
                        );
                    }

                    $this->set('output', $output);
                    $this->set(
                            array(
                                "_serialize" => array('output')
                            )
                    );

        }


    }

    public function listShiftChecklists($shiftId = null, $shiftDate = null, $userId = null, $shiftUserId = null)
    {
            $date = date('Y-m-d');
            $this->Shiftchecklist->recursive =1;
            $options = array('conditions'=>['Shiftchecklist.shift_id'=>$shiftId,'Shiftchecklist.everyday'=>0, 'Shiftchecklist.start_date <='=>$shiftDate, 'Shiftchecklist.end_date >='=>$shiftDate]);

            $listShiftChecklist = $this->Shiftchecklist->find('all', $options);

            $everydayOptions = array('conditions'=>['Shiftchecklist.shift_id'=>$shiftId, 'Shiftchecklist.everyday'=>1]);
            $everyListShiftChecklist = $this->Shiftchecklist->find('all', $everydayOptions);

            if(!empty($listShiftChecklist) || !empty($everyListShiftChecklist))
            {
                $arr = array();
                $output= ['status'=>1];
                $arr = array_merge($listShiftChecklist, $everyListShiftChecklist); 
                
                $allCheckList= array(); //all shift check list.

                foreach ($arr as $key => $value) {

                    foreach ($value['Checklist'] as $value) {
                        $allCheckList[]=$value;
                    }
                }

                $this->loadModel('UserChecklist');
                $options = array(
                                    'conditions'=>['UserChecklist.taskcompleteddate <='=>$date, 'UserChecklist.user_id'=>$userId, 'UserChecklist.shiftUser_id'=>$shiftUserId],
                                    'fields'=>['checklist_id']
                                    );
                $userchecklist = $this->UserChecklist->find('list', $options);

                $userChecklistArray = array(); //user completed checklist.
                foreach ($userchecklist as $key => $value) {

                    $userChecklistArray[] = $value;
                }

                foreach ($allCheckList as $key => $value) {

                    $checkListId = $value['id'];

                    if(!in_array($checkListId, $userChecklistArray))
                    {
                        $list[] = $value;
                    }
                    else
                    {
                        $value['status']=1;
                        $list[] = $value;
                    }
                }

            }
            else
            {
                $output= ['status'=>0];
            }
            
            $this->set(array(
                    'output'=>$output,
                    'listShiftChecklist'=>$list,
                    '_serialize'=>array('output', 'listShiftChecklist'), 
                    '_jsonp'=>true
                ));
        
    }
}




?>