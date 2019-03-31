<?php
App::uses('AppController', 'Controller');
/**
 * UserChecklists Controller
 *
 * @property UserChecklist $UserChecklist
 * @property PaginatorComponent $Paginator
 */
class UserChecklistsController extends AppController {

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
		$this->UserChecklist->recursive = 0;
		$this->set('userChecklists', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserChecklist->exists($id)) {
			throw new NotFoundException(__('Invalid user checklist'));
		}
		$options = array('conditions' => array('UserChecklist.' . $this->UserChecklist->primaryKey => $id));
		$this->set('userChecklist', $this->UserChecklist->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserChecklist->create();
			if ($this->UserChecklist->save($this->request->data)) {
				$this->Session->setFlash(__('The user checklist has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user checklist could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserChecklist->User->find('list');
		$checklists = $this->UserChecklist->Checklist->find('list');
		$this->set(compact('users', 'checklists'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserChecklist->exists($id)) {
			throw new NotFoundException(__('Invalid user checklist'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserChecklist->save($this->request->data)) {
				$this->Session->setFlash(__('The user checklist has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user checklist could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserChecklist.' . $this->UserChecklist->primaryKey => $id));
			$this->request->data = $this->UserChecklist->find('first', $options);
		}
		$users = $this->UserChecklist->User->find('list');
		$checklists = $this->UserChecklist->Checklist->find('list');
		$this->set(compact('users', 'checklists'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserChecklist->id = $id;
		if (!$this->UserChecklist->exists()) {
			throw new NotFoundException(__('Invalid user checklist'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UserChecklist->delete()) {
			$this->Session->setFlash(__('The user checklist has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user checklist could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function addUserCheckList()
	{
		$this->request->data['UserChecklist']['taskcompleteddate'] = date('Y-m-d');
		$this->UserChecklist->create();
		if($this->UserChecklist->save($this->request->data))
		{
			$output=['status'=>1];
		}
		else
		{
			$output=['status'=>0];
		}
		$this->set(array(
					'output'=>$output,
					'_serialize'=>['output'],
					'_jsonp'=>true
				));
	}
}
