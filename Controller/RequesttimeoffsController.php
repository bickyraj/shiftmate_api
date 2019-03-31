<?php
App::uses('AppController', 'Controller');
/**
 * Requesttimeoffs Controller
 *
 * @property Requesttimeoff $Requesttimeoff
 * @property PaginatorComponent $Paginator
 */
class RequesttimeoffsController extends AppController {

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
		$this->Requesttimeoff->recursive = 0;
		$this->set('requesttimeoffs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Requesttimeoff->exists($id)) {
			throw new NotFoundException(__('Invalid requesttimeoff'));
		}
		$options = array('conditions' => array('Requesttimeoff.' . $this->Requesttimeoff->primaryKey => $id));
		$this->set('requesttimeoff', $this->Requesttimeoff->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Requesttimeoff->create();
			if ($this->Requesttimeoff->save($this->request->data)) {
				$this->Session->setFlash(__('The requesttimeoff has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requesttimeoff could not be saved. Please, try again.'));
			}
		}
		$timeoffdaytypes = $this->Requesttimeoff->Timeoffdaytype->find('list');
		$timeofftypes = $this->Requesttimeoff->Timeofftype->find('list');
		$organizations = $this->Requesttimeoff->Organization->find('list');
		$branches = $this->Requesttimeoff->Branch->find('list');
		$boards = $this->Requesttimeoff->Board->find('list');
		$users = $this->Requesttimeoff->User->find('list');
		$this->set(compact('timeoffdaytypes', 'timeofftypes', 'organizations', 'branches', 'boards', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Requesttimeoff->exists($id)) {
			throw new NotFoundException(__('Invalid requesttimeoff'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Requesttimeoff->save($this->request->data)) {
				$this->Session->setFlash(__('The requesttimeoff has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requesttimeoff could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Requesttimeoff.' . $this->Requesttimeoff->primaryKey => $id));
			$this->request->data = $this->Requesttimeoff->find('first', $options);
		}
		$timeoffdaytypes = $this->Requesttimeoff->Timeoffdaytype->find('list');
		$timeofftypes = $this->Requesttimeoff->Timeofftype->find('list');
		$organizations = $this->Requesttimeoff->Organization->find('list');
		$branches = $this->Requesttimeoff->Branch->find('list');
		$boards = $this->Requesttimeoff->Board->find('list');
		$users = $this->Requesttimeoff->User->find('list');
		$this->set(compact('timeoffdaytypes', 'timeofftypes', 'organizations', 'branches', 'boards', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Requesttimeoff->id = $id;
		if (!$this->Requesttimeoff->exists()) {
			throw new NotFoundException(__('Invalid requesttimeoff'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Requesttimeoff->delete()) {
			$this->Session->setFlash(__('The requesttimeoff has been deleted.'));
		} else {
			$this->Session->setFlash(__('The requesttimeoff could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function addRequesttimeoff(){

       if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
        
        	$this->Requesttimeoff->create();

        	$status = 0;
        	if($this->Requesttimeoff->save($this->request->data))
        	{
        		$status = 1;
        	}

        	$this->set(array(
        		"status"=>$status,
        		"_serialize"=>['status'],
        		"_jsonp"=>true
        		));
    	}
   }

   public function getAllRequests($orgId = null)
   {
   		$data = $this->Requesttimeoff->getAllRequests($orgId);

   		$status = 0;

   		if(isset($data) && !empty($data))
   		{
   			$status = 1;
   		}
   		$this->set(array(
        "status"=>$status,
   			"list"=>$data,
   			"_serialize"=>['list', 'status'],
   			"_jsonp"=>true
   			));
   }

   public function getSingleRequests($reqId = null)
   {
   		$data = $this->Requesttimeoff->getSingleRequests($reqId);

   		$status = 0;

   		if(isset($data) && !empty($data))
   		{
   			$status = 1;
   		}
   		$this->set(array(
        "status"=>$status,
   			"list"=>$data,
   			"_serialize"=>['list', 'status'],
   			"_jsonp"=>true
   			));
   }

   public function approveRequest($reqId = null)
   {
   		$this->Requesttimeoff->id = $reqId;

   		$status = 0;
   		if($this->Requesttimeoff->saveField('status', 2))
   		{
   			$status = 1;
   		}

   		$this->set(array(
   			"status"=>$status,
   			"_serialize"=>['status'],
   			"_jsonp"=>true
   			));
   }

   public function denyRequest($reqId = null)
   {
   		$this->Requesttimeoff->id = $reqId;

   		$status = 0;
   		if($this->Requesttimeoff->saveField('status', 1))
   		{
   			$status = 1;
   		}

   		$this->set(array(
   			"status"=>$status,
   			"_serialize"=>['status'],
   			"_jsonp"=>true
   			));
   }

   public function getAllUserRequests($userId = null)
   {
      $data = $this->Requesttimeoff->getAllUserRequests($userId);

      $status = 0;

      if(isset($data) && !empty($data))
      {
        $status = 1;
      }
      $this->set(array(
        "status"=>$status,
        "list"=>$data,
        "_serialize"=>['list', 'status'],
        "_jsonp"=>true
        ));
   }

   public function getAllEmployeeLeaves($orgId = null)
   {
    $data = $this->Requesttimeoff->getAllEmployeeLeaves($orgId);

      $status = 0;

      if(isset($data) && !empty($data))
      {
        $status = 1;
      }
      $this->set(array(
        "status"=>$status,
        "list"=>$data,
        "_serialize"=>['list', 'status'],
        "_jsonp"=>true
        ));
   }

}
