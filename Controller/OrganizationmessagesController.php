<?php
App::uses('AppController', 'Controller');
/**
 * Organizationmessages Controller
 *
 * @property Organizationmessage $Organizationmessage
 * @property PaginatorComponent $Paginator
 */
class OrganizationmessagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
        
        public function getMessageDetail($message_id){
            $messageDetail = $this->Organizationmessage->getMessageDetail($message_id);
            
            $this->set(array(
                'messageDetail' => $messageDetail,
                '_serialize' => array('messageDetail')
            ));
            
        }
        
        public function myOrganizationMessages($organization_id = NULL){
            $myOrganizationMessages = $this->Organizationmessage->myOrganizationMessages($organization_id);
            
                        
            $this->set('message', $myOrganizationMessages);
            $this->set(array(
                '_serialize' => array('message')
            ));
        }
        
        public function add_message() {
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
			$this->Organizationmessage->create();
			if ($this->Organizationmessage->save($this->request->data)) {
				$message = '1';
			} else {
				$message = '0';
			}
		}
                //$message = $this->request->data;
		$this->set('message', $message);
                $this->set(array('_serialize'=>array('message')));
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Organizationmessage->recursive = 0;
		$this->set('organizationmessages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Organizationmessage->exists($id)) {
			throw new NotFoundException(__('Invalid organizationmessage'));
		}
		$options = array('conditions' => array('Organizationmessage.' . $this->Organizationmessage->primaryKey => $id));
		$this->set('organizationmessage', $this->Organizationmessage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
                    $this->request->data['Organizationmessage']['date_time'] = date('Y-m-d H:i:s');
                    $this->request->data['Organizationmessage']['status'] = 1;
			$this->Organizationmessage->create();
			if ($this->Organizationmessage->save($this->request->data)) {
				$output = 1;
			} else {
				$output = 0;
			}
		}
		$this->set(array(
                    'output' => $output,
                    '_serialize' => array('output')
                ));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Organizationmessage->exists($id)) {
			throw new NotFoundException(__('Invalid organizationmessage'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Organizationmessage->save($this->request->data)) {
				$this->Session->setFlash(__('The organizationmessage has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The organizationmessage could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Organizationmessage.' . $this->Organizationmessage->primaryKey => $id));
			$this->request->data = $this->Organizationmessage->find('first', $options);
		}
		$organizations = $this->Organizationmessage->Organization->find('list');
		$users = $this->Organizationmessage->User->find('list');
		$this->set(compact('organizations', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Organizationmessage->id = $id;
		if (!$this->Organizationmessage->exists()) {
			throw new NotFoundException(__('Invalid organizationmessage'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Organizationmessage->delete()) {
			$this->Session->setFlash(__('The organizationmessage has been deleted.'));
		} else {
			$this->Session->setFlash(__('The organizationmessage could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
