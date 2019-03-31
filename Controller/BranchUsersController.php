<?php
App::uses('AppController', 'Controller');
/**
 * BranchUsers Controller
 *
 * @property BranchUser $BranchUser
 * @property PaginatorComponent $Paginator
 */
class BranchUsersController extends AppController {

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
		$this->BranchUser->recursive = 0;
		$this->set('branchUsers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->BranchUser->exists($id)) {
			throw new NotFoundException(__('Invalid branch user'));
		}
		$options = array('conditions' => array('BranchUser.' . $this->BranchUser->primaryKey => $id));
		$this->set('branchUser', $this->BranchUser->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->BranchUser->create();
			if ($this->BranchUser->save($this->request->data)) {
				$this->Session->setFlash(__('The branch user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The branch user could not be saved. Please, try again.'));
			}
		}
		$branches = $this->BranchUser->Branch->find('list');
		$users = $this->BranchUser->User->find('list');
		$this->set(compact('branches', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->BranchUser->exists($id)) {
			throw new NotFoundException(__('Invalid branch user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->BranchUser->save($this->request->data)) {
				$this->Session->setFlash(__('The branch user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The branch user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('BranchUser.' . $this->BranchUser->primaryKey => $id));
			$this->request->data = $this->BranchUser->find('first', $options);
		}
		$branches = $this->BranchUser->Branch->find('list');
		$users = $this->BranchUser->User->find('list');
		$this->set(compact('branches', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->BranchUser->id = $id;
		if (!$this->BranchUser->exists()) {
			throw new NotFoundException(__('Invalid branch user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->BranchUser->delete()) {
			$this->Session->setFlash(__('The branch user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The branch user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
    
    public function getBranchUsers($branchId){
        $result = $this->BranchUser->getBranchUser($branchId);
        $this->set(array(
            'branchUser'=>$result,
            '_serialize'=>array('branchUser'),
            '_jsonp'=>true
        ));
    }

    public function getUserRelatedBranches($userId = null)
    {
    	$data = $this->BranchUser->getUserRelatedBranches($userId);
    	$status  = 0;

    	if(isset($data) && !empty($data))
    	{
    		$status = 1;
    	}

    	$this->set(array(
    		"status"=>$status,
    		"list"=>$data,
    		"_serialize"=>['status', 'list'],
    		"_jsonp"=>true
    		));
    }

    public function getBranchesOfUsers($userId = null,$orgId = null)
    {
    	$data = $this->BranchUser->getBranchesOfUsers($userId,$orgId);
    	$status  = 0;

    	if(isset($data) && !empty($data))
    	{
    		$status = 1;
    	}

    	$this->set(array(
    		"status"=>$status,
    		"list"=>$data,
    		"_serialize"=>['status', 'list'],
    		"_jsonp"=>true
    		));
    }
    
}
