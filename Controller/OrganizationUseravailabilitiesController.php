<?php
App::uses('AppController', 'Controller');
/**
 * OrganizationUseravailabilities Controller
 *
 * @property OrganizationUseravailability $OrganizationUseravailability
 * @property PaginatorComponent $Paginator
 */
class OrganizationUseravailabilitiesController extends AppController {

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
		$this->OrganizationUseravailability->recursive = 0;
		$this->set('organizationUseravailabilities', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->OrganizationUseravailability->exists($id)) {
			throw new NotFoundException(__('Invalid organization useravailability'));
		}
		$options = array('conditions' => array('OrganizationUseravailability.' . $this->OrganizationUseravailability->primaryKey => $id));
		$this->set('organizationUseravailability', $this->OrganizationUseravailability->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->OrganizationUseravailability->create();
			if ($this->OrganizationUseravailability->save($this->request->data)) {
				$this->Session->setFlash(__('The organization useravailability has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The organization useravailability could not be saved. Please, try again.'));
			}
		}
		$organizations = $this->OrganizationUseravailability->Organization->find('list');
		$users = $this->OrganizationUseravailability->User->find('list');
		$useravailabilities = $this->OrganizationUseravailability->Useravailability->find('list');
		$this->set(compact('organizations', 'users', 'useravailabilities'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->OrganizationUseravailability->exists($id)) {
			throw new NotFoundException(__('Invalid organization useravailability'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->OrganizationUseravailability->save($this->request->data)) {
				$this->Session->setFlash(__('The organization useravailability has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The organization useravailability could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('OrganizationUseravailability.' . $this->OrganizationUseravailability->primaryKey => $id));
			$this->request->data = $this->OrganizationUseravailability->find('first', $options);
		}
		$organizations = $this->OrganizationUseravailability->Organization->find('list');
		$users = $this->OrganizationUseravailability->User->find('list');
		$useravailabilities = $this->OrganizationUseravailability->Useravailability->find('list');
		$this->set(compact('organizations', 'users', 'useravailabilities'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->OrganizationUseravailability->id = $id;
		if (!$this->OrganizationUseravailability->exists()) {
			throw new NotFoundException(__('Invalid organization useravailability'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->OrganizationUseravailability->delete()) {
			$this->Session->setFlash(__('The organization useravailability has been deleted.'));
		} else {
			$this->Session->setFlash(__('The organization useravailability could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
