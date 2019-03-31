<?php
App::uses('AppController', 'Controller');
/**
 * ShiftBoards Controller
 *
 * @property ShiftBoard $ShiftBoard
 * @property PaginatorComponent $Paginator
 */
class ShiftBoardsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ShiftBoard->recursive = 0;
		$this->set('shiftBoards', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ShiftBoard->exists($id)) {
			throw new NotFoundException(__('Invalid shift board'));
		}
		$options = array('conditions' => array('ShiftBoard.' . $this->ShiftBoard->primaryKey => $id));
		$this->set('shiftBoard', $this->ShiftBoard->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ShiftBoard->create();
			if ($this->ShiftBoard->save($this->request->data)) {
				$this->Session->setFlash(__('The shift board has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The shift board could not be saved. Please, try again.'));
			}
		}
		$boards = $this->ShiftBoard->Board->find('list');
		$shifts = $this->ShiftBoard->Shift->find('list');
		$this->set(compact('boards', 'shifts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ShiftBoard->exists($id)) {
			throw new NotFoundException(__('Invalid shift board'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ShiftBoard->save($this->request->data)) {
				$this->Session->setFlash(__('The shift board has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The shift board could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ShiftBoard.' . $this->ShiftBoard->primaryKey => $id));
			$this->request->data = $this->ShiftBoard->find('first', $options);
		}
		$boards = $this->ShiftBoard->Board->find('list');
		$shifts = $this->ShiftBoard->Shift->find('list');
		$this->set(compact('boards', 'shifts'));
	}


/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ShiftBoard->id = $id;
		if (!$this->ShiftBoard->exists()) {
			throw new NotFoundException(__('Invalid shift board'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ShiftBoard->delete()) {
			$this->Session->setFlash(__('The shift board has been deleted.'));
		} else {
			$this->Session->setFlash(__('The shift board could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        
        public function boardShiftList($boardId = null,$page = 1) {
            $this->ShiftBoard->recursive = 0;
            $limit = 20;
            $this->paginate = array(
                'conditions'=>array('board_id'=>$boardId),
                'limit'=>$limit,'page'=>$page,
                'order'=>array('Shift.starttime'=>'ASC'));
      
            $boardShifts = $this->Paginator->paginate();
            $page=$this->params['paging']['ShiftBoard']['pageCount'];
            $currentPage = $this->params['paging']['ShiftBoard']['page'];

            if (!empty($boardShifts)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "boardShiftList",
                "status" => $status,
                "pageCount" => $page,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );

            $this->set('output', $output);
            $this->set('boardShifts', $boardShifts);

            $this->set(
                    array(
                        "_serialize" => array('boardShifts', 'output'),
                        "_jsonp"=>true
                    )
            );
	}
        
      
        
        //get list of shifts relatd to branches that are not assigned to board
        /**
         * ShiftBoardsController::getShiftListNotInBoard()
         * 
         * @param mixed $boardId
         * @param mixed $branchId
         * @return void
         */
        public function getShiftListNotInBoard($boardId = null, $branchId = null){
             $this->ShiftBoard->Shift->Behaviors->load('Containable');
             $this->ShiftBoard->Shift->recursive = -1;
             $boardShifts = $this->ShiftBoard->find('list', array('fields'=>array('shift_id'), 'conditions'=>array('ShiftBoard.board_id'=>$boardId, 'ShiftBoard.status'=>1)));
           
            // $shiftNotInBoard = $this->ShiftBoard->Shift->find('all', array('conditions'=>array('Shift.organization_id'=>$orgId,'Shift.status'=>1, 'NOT'=>array('Shift.id'=>$boardShifts))));

             $shiftNotInBoards = $this->ShiftBoard->Shift->ShiftBranch->find('all');
            $shiftNotInBoard = $this->ShiftBoard->Shift->ShiftBranch->find('all', array('conditions'=>array('ShiftBranch.branch_id'=>$branchId, 'NOT'=>array('shift_id'=>$boardShifts))));
            // debug($shiftNotInBoard);
            // die();
             if (!empty($shiftNotInBoard)) {
                 $status = 1;
             } else {
                 $status = 0;
             }
             $output = array(
                 "params" => $this->request,
                 "method" => $this->method,
                 "action" => "getShiftListNotInBoard",
                 "status" => $status,
                 "error" => array("validation" => "")
             );

             $this->set('output', $output);
             $this->set('shiftNotInBoard', $shiftNotInBoard);

             $this->set(
                     array(
                         "_serialize" => array('shiftNotInBoard', 'output')
                     )
             );
        }
        
        
        /**
         * ShiftBoardsController::assignShiftToBoard()
         * 
         * @param mixed $boardId
         * @return void
         */
        public function assignShiftToBoard($boardId = null){
            if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
                
                //managing array for saveMany function
                foreach($this->request->data['ShiftBoard'] as $shift):
                    $data[] = array('board_id'=>$boardId, 'shift_id'=>$shift['shift_id'], 'status'=>'1','shift_type'=>$shift['shift_type']);
                endforeach;
                
                if ($this->ShiftBoard->saveMany($data)) {
				 $output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                       "action" => "assignShiftToBoard",
                                       "status"=>1,
                                       //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Shift assigned to Board.")
                                      );
			} else {
				$output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                       "action" => "assignShiftToBoard",
                                       "status"=>0,
                                       //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Shift Assign to Board Fails. Please Try Again.")
                                      );
			}
                
                $this->set('output',$output);
			$this->set(
                                    array(
                                        "_serialize" =>array('output')
                                    )
                            );
            }
        }

        /**
         * ShiftBoardsController::shiftListDetail()
         * 
         * @param mixed $boardId
         * @return void
         */
        public function shiftListDetail($boardId = null)
        {
            $this->ShiftBoard->Behaviors->load('Containable');


            $this->ShiftBoard->recursive = 0;
            $limit = 20;
            $this->paginate = array('conditions'=>array('ShiftBoard.board_id'=>$boardId),

                'contain'=>'Shift');
      
            $shiftListDetail = $this->Paginator->paginate();
           // debug($shiftListDetail);

            $page=$this->params['paging']['ShiftBoard']['pageCount'];
            $currentPage = $this->params['paging']['ShiftBoard']['page'];

            if (!empty($shiftListDetail)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "shiftListDetail",
                "status" => $status,
                "pageCount" => $page,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );

            $this->set('output', $output);

            $this->set('shiftListDetail', $shiftListDetail);

            $this->set(
                array(
                    '_serialize'=>'shiftListDetail'
                    ));
        }
        /**by rabi*/
    public function userShiftList($board_id = null)
    {
         $this->ShiftBoard->recursive = 1;
        //$this->ShiftBoard->Behaviors->load('Containable');
        $output = $this->ShiftBoard->find('all',array(
                'conditions' => array(
                        'ShiftBoard.board_id' => $board_id,
                       

                    ),
               // 'contain' => ['Shift']
            ));
        // debug($output);
        // die();
        $this->set('output', $output);

        $this->set(
            array(
                '_serialize'=>'output'
                ));

    }
    public function assignShift($board_id = null)
        {
            if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
                // $start_date = $this->request->data['ShiftBoard']['start_date'];
                // $end_date = $this->request->data['ShiftBoard']['end_date'];
                // $shift_type = $this->request->data['ShiftBoard']['shift_type'];
                foreach($this->request->data['ShiftBoard']['shift_id'] as $shift):
                     $data[] = array('board_id'=>$this->request->data['ShiftBoard']['board_id'], 'shift_id'=>$shift, 'status'=>'1');
                 endforeach;
                // if ($shift_type == 'on') {
                //    foreach($this->request->data['ShiftBoard']['shift_id'] as $shift):
                //     $data[] = array('board_id'=>$this->request->data['ShiftBoard']['board_id'], 'shift_id'=>$shift,'start_date'=>$start_date,'end_date'=>$end_date,'shift_type'=>1, 'status'=>'1');
                // endforeach;
                // }
                // else{

                //      foreach($this->request->data['ShiftBoard']['shift_id'] as $shift):
                //     $data[] = array('board_id'=>$this->request->data['ShiftBoard']['board_id'], 'shift_id'=>$shift,'start_date'=>'0000-00-00','end_date'=>'0000-00-00','shift_type'=>$shift_type, 'status'=>'1');
                // endforeach;
                // }
                
                
                if ($this->ShiftBoard->saveMany($data)) {

                    $output = 1;

                } else {
                    $output = 0;
                }
                
                
            }
            $this->set('output',$output);
            $this->set(
                                    array(
                                        "_serialize" =>array('output'),
                                        "_jsonp"=>true
                                    )
                            );

        }
        public function updateShiftType($boardid = null){
            $this->ShiftBoard->id = $boardid;
            $shiftType = $this->ShiftBoard->field('shift_type');
            //debug($shiftType);
            if($shiftType == 0)
            {
                $this->ShiftBoard->saveField('shift_type', '1');
                $shift_type = 1;
              
            }

            else
            {
                $this->ShiftBoard->saveField('shift_type', '0');
                $shift_type = 0;
                
            }
           // $shift_type =1;
            //debug($shiftType);
             $this->set(array('output'=>$shift_type));
            $this->set(array('_serialize'=>array('output'), '_jsonp'=>true));
        }
        
         /**
         * ShiftBoardsController::openShifts()
         * 
         * @param mixed $user_id
         * @param mixed $org_id
         * @param mixed $board_id
         * @return void
         */
        public function openShifts($org_id){
            $result1 = $this->ShiftBoard->openShift($org_id);
            //debug($result1);
            $this->set(array(
                'openShifts'=>$result1,
                '_serialize'=>array('openShifts'),
                "_jsonp"=>true
            ));
        }
        
        /**
         * ShiftBoardsController::closedShifts()
         * 
         * @param int $user_id
         * @param int $org_id
         * @param int $board_id
         * @return void
         */
        public function closedShifts($user_id,$org_id,$board_id){
            $this->loadModel('ShiftUser');
            $result1 = $this->ShiftBoard->closedShift($org_id,$board_id);
            $result2 = $this->ShiftUser->getShiftUserId($user_id);

            $data=array();
            foreach($result2 as $res2){
                foreach($result1 as $res1){
                    if($res2['ShiftUser']['shift_id'] == $res1['Shift']['id'] && $res2['ShiftUser']['shift_date'] == date('Y-m-d')){
                        $data[] = $res1;
                    }   
                }
            }

            $this->set(array(
                'closedShifts'=>$data,
                '_serialize'=>array('closedShifts'),
                "_jsonp"=>true
            ));
        }
            
    /**
     * ShiftBoardsController::editShiftBoardType()
     * 
     * @return void
     */
    public function editShiftBoardType(){
        $this->ShiftBoard->id=$this->request->data["ShiftBoard"]["id"];

        if(isset($this->request->data['Shift']['starttime'])){
            $starttime = explode(':', $this->request->data['Shift']['starttime']);
            if($starttime[0] < 10):
                  $starttime='0'.$starttime[0].':'.$starttime[1].':00';
              else:
                  $starttime=$this->request->data['Shift']['starttime'].':00';
              endif;

              $endtime = explode(':', $this->request->data['Shift']['endtime']);
              if($endtime[0] < 10):
                  $endtime='0'.$endtime[0].':'.$endtime[1].':00';
              else:
                  $endtime=$this->request->data['Shift']['endtime'].':00';
              endif;

            $this->request->data['Shift']['starttime']= $starttime;
            $this->request->data['Shift']['endtime']= $endtime; 
        }
        
        if($this->ShiftBoard->saveAll($this->request->data)){
            $message = "Edited";
        }else{
            $message = "Could not edit at this time";
        }
    }

    public function getBoardShiftList($boardId = null) {

            $this->ShiftBoard->Behaviors->load('Containable');
            $this->ShiftBoard->recursive = 0;

            $this->paginate = array(
                'conditions'=>array('board_id'=>$boardId),
                'contain'=>array('Shift'),
                'order'=>array('Shift.starttime'=>'ASC'));
      
            $boardShifts = $this->Paginator->paginate();
            // $page=$this->params['paging']['ShiftBoard']['pageCount'];
            // $currentPage = $this->params['paging']['ShiftBoard']['page'];

            if (!empty($boardShifts)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "boardShiftList",
                "status" => $status,
                "error" => array("validation" => "")
            );

            $this->set('output', $output);
            $this->set('boardShifts', $boardShifts);

            $this->set(
                    array(
                        "_serialize" => array('boardShifts', 'output'),
                        "_jsonp"=>true
                    )
            );
    }
    
}
