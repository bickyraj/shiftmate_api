<?php
App::uses('AppController', 'Controller');
/**
 * Opencalendarshifts Controller
 *
 * @property Opencalendarshift $Opencalendarshift
 * @property PaginatorComponent $Paginator
 */
class OpencalendarshiftsController extends AppController {

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
		$this->Opencalendarshift->recursive = 0;
		$this->set('opencalendarshifts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Opencalendarshift->exists($id)) {
			throw new NotFoundException(__('Invalid opencalendarshift'));
		}
		$options = array('conditions' => array('Opencalendarshift.' . $this->Opencalendarshift->primaryKey => $id));
		$this->set('opencalendarshift', $this->Opencalendarshift->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Opencalendarshift->create();
			if ($this->Opencalendarshift->save($this->request->data)) {
				$this->Session->setFlash(__('The opencalendarshift has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The opencalendarshift could not be saved. Please, try again.'));
			}
		}
		$organizations = $this->Opencalendarshift->Organization->find('list');
		$boards = $this->Opencalendarshift->Board->find('list');
		$shifts = $this->Opencalendarshift->Shift->find('list');
		$this->set(compact('organizations', 'boards', 'shifts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Opencalendarshift->exists($id)) {
			throw new NotFoundException(__('Invalid opencalendarshift'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Opencalendarshift->save($this->request->data)) {
				$this->Session->setFlash(__('The opencalendarshift has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The opencalendarshift could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Opencalendarshift.' . $this->Opencalendarshift->primaryKey => $id));
			$this->request->data = $this->Opencalendarshift->find('first', $options);
		}
		$organizations = $this->Opencalendarshift->Organization->find('list');
		$boards = $this->Opencalendarshift->Board->find('list');
		$shifts = $this->Opencalendarshift->Shift->find('list');
		$this->set(compact('organizations', 'boards', 'shifts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Opencalendarshift->id = $id;
		if (!$this->Opencalendarshift->exists()) {
			throw new NotFoundException(__('Invalid opencalendarshift'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Opencalendarshift->delete()) {
			$this->Session->setFlash(__('The opencalendarshift has been deleted.'));
		} else {
			$this->Session->setFlash(__('The opencalendarshift could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
    
    public function saveOpenShifts($orgId = null,$boardId = null,$shiftId = null,$shiftDate = null,$noEmp = null){
        $result = $this->Opencalendarshift->saveOpenShift($orgId,$boardId,$shiftId,$shiftDate,$noEmp);

        $this->set(array(
            'result'=>$result,
            "_serialize"=>array('result'),
            "_jsonp"=>true
        ));
    }
    
    public function showOpenCalendarShifts($orgId=null,$boardId=null){
        $result = $this->Opencalendarshift->showOpenCalendarShift($orgId,$boardId);
        $this->set(array(
            'result'=>$result,
            "_serialize"=>array('result'),
            "_jsonp"=>true
        ));
    }
    

    public function showOrgOpenCalendarShifts($orgId=null){
        $result = $this->Opencalendarshift->showOrgOpenCalendarShift($orgId);
        $this->set(array(
            'result'=>$result,
            "_serialize"=>array('result'),
            "_jsonp"=>true
        ));
    }
    
    public function updateFromCalender($id = null,$date = null){
        $data['Opencalendarshift']['shiftdate']=$date;
        $this->Opencalendarshift->id = $id;
        if($this->Opencalendarshift->save($data)){
            $result = 1;
        }else{
            $result = 0;
        }
        $this->set(array(
            'result'=>$result,
            "_serialize"=>array('result'),
            "_jsonp"=>true
        ));
    }
    public function openScheduleForCalender($userId = null){
        $result = $this->Opencalendarshift->openScheduleForCalenders($userId);
        $this->set(array(
            'result'=>$result,
            "_serialize"=>array('result'),
            "_jsonp"=>true
        ));
    }
    
    public function UserResponseFromCalender(){
        $id=$_POST['openCalId'];
        $userId=$_POST['userId'];
        $result=$this->Opencalendarshift->UserResponseFromCalender($id,$userId);
        $this->set(array(
            'result'=>$result,
            '_serialize'=>array('result'),
            '_jsonp'=>true
        ));
    }
    
    public function updateOpenShifts($id = null,$shiftId = null,$noEmp = null){
        $result = $this->Opencalendarshift->updateOpenShift($id,$shiftId,$noEmp);
        $this->set(array(
            'result'=>$result,
            '_serialize'=>array('result'),
            '_jsonp'=>true
        ));
    }
    public function updateOpenShifts1($id = null,$boardId=null,$shiftId = null,$noEmp = null){
        $result = $this->Opencalendarshift->updateOpenShift1($id,$boardId,$shiftId,$noEmp);
        $this->set(array(
            'result'=>$result,
            '_serialize'=>array('result'),
            '_jsonp'=>true
        ));
    }

    public function getOpenShiftOfBoard($boardId = null)
    {
        $result = $this->Opencalendarshift->getOpenShiftOfBoard($boardId);

        $status = 0;

        if(isset($result) && !empty($result))
        {
            $status = 1;
        }
        $this->set(array(
            'status'=>$status,
            'result'=>$result,
            '_serialize'=>array('result', 'status'),
            '_jsonp'=>true
        ));
    }

    public function userResponseToShift($openShiftId = null, $userId = null){
        $result=$this->Opencalendarshift->userResponseToShift($openShiftId,$userId);
        $this->set(array(
            'status'=>$result,
            '_serialize'=>array('status'),
            '_jsonp'=>true
        ));
    }
}
