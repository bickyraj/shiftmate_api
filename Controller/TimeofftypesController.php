<?php
App::uses('AppController', 'Controller');
/**
 * Timeofftypes Controller
 *
 * @property Timeofftype $Timeofftype
 * @property PaginatorComponent $Paginator
 */
class TimeofftypesController extends AppController {

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
		$this->Timeofftype->recursive = 0;
		$this->set('timeofftypes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Timeofftype->exists($id)) {
			throw new NotFoundException(__('Invalid timeofftype'));
		}
		$options = array('conditions' => array('Timeofftype.' . $this->Timeofftype->primaryKey => $id));
		$this->set('timeofftype', $this->Timeofftype->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Timeofftype->create();
			if ($this->Timeofftype->save($this->request->data)) {
				$this->Session->setFlash(__('The timeofftype has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The timeofftype could not be saved. Please, try again.'));
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
		if (!$this->Timeofftype->exists($id)) {
			throw new NotFoundException(__('Invalid timeofftype'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Timeofftype->save($this->request->data)) {
				$this->Session->setFlash(__('The timeofftype has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The timeofftype could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Timeofftype.' . $this->Timeofftype->primaryKey => $id));
			$this->request->data = $this->Timeofftype->find('first', $options);
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
		$this->Timeofftype->id = $id;
		if (!$this->Timeofftype->exists()) {
			throw new NotFoundException(__('Invalid timeofftype'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Timeofftype->delete()) {
			$this->Session->setFlash(__('The timeofftype has been deleted.'));
		} else {
			$this->Session->setFlash(__('The timeofftype could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
