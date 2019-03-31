<?php
App::uses('AppController', 'Controller');
/**
 * Timeoffdaytypes Controller
 *
 * @property Timeoffdaytype $Timeoffdaytype
 * @property PaginatorComponent $Paginator
 */
class TimeoffdaytypesController extends AppController {

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
		$this->Timeoffdaytype->recursive = 0;
		$this->set('timeoffdaytypes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Timeoffdaytype->exists($id)) {
			throw new NotFoundException(__('Invalid timeoffdaytype'));
		}
		$options = array('conditions' => array('Timeoffdaytype.' . $this->Timeoffdaytype->primaryKey => $id));
		$this->set('timeoffdaytype', $this->Timeoffdaytype->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Timeoffdaytype->create();
			if ($this->Timeoffdaytype->save($this->request->data)) {
				$this->Session->setFlash(__('The timeoffdaytype has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The timeoffdaytype could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Timeoffdaytype->exists($id)) {
			throw new NotFoundException(__('Invalid timeoffdaytype'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Timeoffdaytype->save($this->request->data)) {
				$this->Session->setFlash(__('The timeoffdaytype has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The timeoffdaytype could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Timeoffdaytype.' . $this->Timeoffdaytype->primaryKey => $id));
			$this->request->data = $this->Timeoffdaytype->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Timeoffdaytype->id = $id;
		if (!$this->Timeoffdaytype->exists()) {
			throw new NotFoundException(__('Invalid timeoffdaytype'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Timeoffdaytype->delete()) {
			$this->Session->setFlash(__('The timeoffdaytype has been deleted.'));
		} else {
			$this->Session->setFlash(__('The timeoffdaytype could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
