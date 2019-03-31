<?php
App::uses('AppController', 'Controller');
/**
 * ShiftBranches Controller
 *
 * @property ShiftBranch $ShiftBranch
 * @property PaginatorComponent $Paginator
 */
class ShiftBranchesController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator');
        
        public function assignShiftToBranch(){
            $output = '100';
            if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
                
                //managing array for saveMany function
                foreach($this->request->data['ShiftBranch']['shift_id'] as $shift):
                    $data[] = array('branch_id'=>$this->request->data['ShiftBranch']['branch_id'], 'shift_id'=>$shift, 'status'=>'1');
                endforeach;
                
                if ($this->ShiftBranch->saveMany($data)) {
                 $output = 1;
            } else {
                $output = 0;
            }
                
                
            }
            $this->set('output',$output);
            $this->set(
                                    array(
                                        "_serialize" =>array('output')
                                    )
                            );
        }
        
        
        
        /**
         * ShiftBranchesController::getBranchRelatedShift()
         * 
         * @param mixed $branch_id
         * @return void
         */
        public function getBranchRelatedShift($branch_id = NULL){
            $shifts = $this->ShiftBranch->getBranchRelatedShift($branch_id);

            $status = 0;
            if(isset($shifts) && !empty($shifts))
            {
                $status = 1;
            }
            $this->set(array(
                'status'=>$status,
                'shiftList'=>$shifts,
                '_serialize'=>array('shiftList', 'status'),
                '_jsonp'=>true
                ));
        }

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->ShiftBranch->recursive = 0;
        $this->set('shiftBranches', $this->Paginator->paginate());
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        if (!$this->ShiftBranch->exists($id)) {
            throw new NotFoundException(__('Invalid shift branch'));
        }
        $options = array('conditions' => array('ShiftBranch.' . $this->ShiftBranch->primaryKey => $id));
        $this->set('shiftBranch', $this->ShiftBranch->find('first', $options));
    }

/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            $this->ShiftBranch->create();
            if ($this->ShiftBranch->save($this->request->data)) {
                $this->Session->setFlash(__('The shift branch has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The shift branch could not be saved. Please, try again.'));
            }
        }
        $shifts = $this->ShiftBranch->Shift->find('list');
        $branches = $this->ShiftBranch->Branch->find('list');
        $this->set(compact('shifts', 'branches'));
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        if (!$this->ShiftBranch->exists($id)) {
            throw new NotFoundException(__('Invalid shift branch'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->ShiftBranch->save($this->request->data)) {
                $this->Session->setFlash(__('The shift branch has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The shift branch could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('ShiftBranch.' . $this->ShiftBranch->primaryKey => $id));
            $this->request->data = $this->ShiftBranch->find('first', $options);
        }
        $shifts = $this->ShiftBranch->Shift->find('list');
        $branches = $this->ShiftBranch->Branch->find('list');
        $this->set(compact('shifts', 'branches'));
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete($id = null) {
        $this->ShiftBranch->id = $id;
        if (!$this->ShiftBranch->exists()) {
            throw new NotFoundException(__('Invalid shift branch'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->ShiftBranch->delete()) {
            $this->Session->setFlash(__('The shift branch has been deleted.'));
        } else {
            $this->Session->setFlash(__('The shift branch could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
        
        public function getShiftRelatedBranches($shiftId = null){
            $shiftBranchList = $this->ShiftBranch->find('list', array('fields'=>array('branch_id'), 'conditions'=>array('shift_id'=>$shiftId)));
            
            if (!empty($shiftBranchList)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "getShiftRelatedBranches",
                "status" => $status,
                "error" => array("validation" => "")
            );

            $this->set('output', $output);
            $this->set('shiftBranchList', $shiftBranchList);

            $this->set(
                    array(
                        "_serialize" => array('shiftBranchList', 'output')
                    )
            );
        }
         /*
        y rabi
        */
        public function shiftBranchList($branch_id = null)
        {
            $this->ShiftBranch->recursive = 1;
        //$this->ShiftBoard->Behaviors->load('Containable');
        $output = $this->ShiftBranch->find('all',array(
                'conditions' => array(
                        'ShiftBranch.branch_id' => $branch_id,
                       

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
    public function deleteBranchShift($branchId = null,$shiftId = null,$shiftBranchId = null)
    {
        //$datas = 0;
        $this->ShiftBranch->Behaviors->load('Containable');
        $sBranchs = $this->ShiftBranch->find('all',array(
                'conditions'=>array(
                        'ShiftBranch.shift_id' =>$shiftId,
                        'ShiftBranch.branch_id' => $branchId
                    ),
                'contain' => array(
                    'Branch.Board'=>array(
                            'conditions' => array(
                                    'branch_id' => $branchId
                                )
                        ),
                    'Branch.Board.ShiftBoard' =>array(
                            'conditions'=>array(
                                'shift_id' => $shiftId,
                                )
                        )
                    )
            ));
        //debug($sBranchs);

        foreach ($sBranchs as $sBranch) {
            foreach ($sBranch['Branch']['Board'] as $board) {
                    $datas[] = count($board['ShiftBoard']);
                   
            }
        }
       // debug($datas);
        $sum=0;
        if(!empty($datas)){
            foreach ($datas as $data) {
                $sum = $sum + $data;
            }
            if($sum!=0)
            {
                $output = 1;
            }
            else{
                $this->ShiftBranch->delete($shiftBranchId);
                $output = 0;
            }
        }
        else{
            $this->ShiftBranch->delete($shiftBranchId);
            $output = 0;
        }
        //debug($output);
        $this->set('output', $output);

        $this->set(
            array(
                '_serialize'=>'output'
                ));
    }
    public function assignShiftBranch(){
            $this->ShiftBranch->Behaviors->load('Containable');
            
            $output = '100';
            if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
                
                //managing array for saveMany function
                foreach($this->request->data['ShiftBranch']['shift_id'] as $shift):
                    $data[] = array('branch_id'=>$this->request->data['ShiftBranch']['branch_id'], 'shift_id'=>$shift, 'status'=>'1');
                endforeach;
                
                if ($this->ShiftBranch->saveMany($data)) {
                    $shiftBranch_Ids = $this->ShiftBranch->shiftBranchIds;
                    $shift_branch = $this->ShiftBranch->find('all',array(
                            'conditions' =>array(
                                'ShiftBranch.id' => $shiftBranch_Ids 
                                ),
                            'contain' => array(
                                    'Shift'
                                )
                        ));
                     $output = $shift_branch;
                } else {
                    $output = 0;
                }
                
                
            }
            $this->set('output',$output);
            $this->set(
                                    array(
                                        "_serialize" =>array('output'),
                                        "_jsonp" => true
                                    )
                            );
        }
        
        
        public function filterShiftByBranch( $branchId = null, $boardId = 0, $shiftTime = null)
        { 
            if($boardId == 0 )
            {
                $result = $this->ShiftBranch->filterShiftByBranch( $branchId );
            }else
            {
                $this->loadModel('ShiftBoard');

                $options = array('conditions'=>['ShiftBoard.board_id'=> $boardId], 'group by'=> 'ShiftBoard.shift_id');
                
                $result = $this->ShiftBoard->find('all', $options);
            }

            $this->set(array(
                'result'=>$result,
                '_serialize'=>['result'],
                '_jsonp'=>true
                ));
        }
    
}
