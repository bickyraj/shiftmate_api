<?php
App::uses('AppController', 'Controller');
/**
 * Userleaves Controller
 *
 * @property Userleave $Userleave
 * @property PaginatorComponent $Paginator
 */
class UserleavesController extends AppController {

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
		$this->Userleave->recursive = 0;
		$this->set('userleaves', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Userleave->exists($id)) {
			throw new NotFoundException(__('Invalid userleave'));
		}
		$options = array('conditions' => array('Userleave.' . $this->Userleave->primaryKey => $id));
		$this->set('userleave', $this->Userleave->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Userleave->create();
			if ($this->Userleave->save($this->request->data)) {
				$this->Session->setFlash(__('The userleave has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userleave could not be saved. Please, try again.'));
			}
		}
		$users = $this->Userleave->User->find('list');
		$organizations = $this->Userleave->Organization->find('list');
		$boards = $this->Userleave->Board->find('list');
		$shifts = $this->Userleave->Shift->find('list');
		$this->set(compact('users', 'organizations', 'boards', 'shifts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Userleave->exists($id)) {
			throw new NotFoundException(__('Invalid userleave'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Userleave->save($this->request->data)) {
				$this->Session->setFlash(__('The userleave has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userleave could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Userleave.' . $this->Userleave->primaryKey => $id));
			$this->request->data = $this->Userleave->find('first', $options);
		}
		$users = $this->Userleave->User->find('list');
		$organizations = $this->Userleave->Organization->find('list');
		$boards = $this->Userleave->Board->find('list');
		$shifts = $this->Userleave->Shift->find('list');
		$this->set(compact('users', 'organizations', 'boards', 'shifts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Userleave->id = $id;
		if (!$this->Userleave->exists()) {
			throw new NotFoundException(__('Invalid userleave'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Userleave->delete()) {
			$this->Session->setFlash(__('The userleave has been deleted.'));
		} else {
			$this->Session->setFlash(__('The userleave could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
