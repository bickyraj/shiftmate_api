<?php
App::uses('AppController', 'Controller');
/**
 * Boardmessages Controller
 *
 * @property Boardmessage $Boardmessage
 * @property PaginatorComponent $Paginator
 */
class BoardmessagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
        
        public function getMessageDetail($message_id){
            $messageDetail = $this->Boardmessage->getMessageDetail($message_id);
            
            $this->set(array(
                'messageDetail' => $messageDetail,
                '_serialize' => array('messageDetail')
            ));
            
        }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Boardmessage->recursive = 0;
		$this->set('boardmessages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Boardmessage->exists($id)) {
			throw new NotFoundException(__('Invalid boardmessage'));
		}
		$options = array('conditions' => array('Boardmessage.' . $this->Boardmessage->primaryKey => $id));
		$this->set('boardmessage', $this->Boardmessage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
                    $this->request->data['Boardmessage']['date_time'] = date('Y-m-d H:i:s');
                    $this->request->data['Boardmessage']['status'] = 1;
			$this->Boardmessage->create();
			if ($this->Boardmessage->save($this->request->data)) {
				$output = 1;
			} else {
				$output = 0;
			}
		}
                $this->set(array(
                    'output' => $output,
                    '_serialize' => array('output')
                ));
		
		/*$boards = $this->Boardmessage->Board->find('list');
		$users = $this->Boardmessage->User->find('list');
		$this->set(compact('boards', 'users'));*/
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Boardmessage->exists($id)) {
			throw new NotFoundException(__('Invalid boardmessage'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Boardmessage->save($this->request->data)) {
				$this->Session->setFlash(__('The boardmessage has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The boardmessage could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Boardmessage.' . $this->Boardmessage->primaryKey => $id));
			$this->request->data = $this->Boardmessage->find('first', $options);
		}
		$boards = $this->Boardmessage->Board->find('list');
		$users = $this->Boardmessage->User->find('list');
		$this->set(compact('boards', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Boardmessage->id = $id;
		if (!$this->Boardmessage->exists()) {
			throw new NotFoundException(__('Invalid boardmessage'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Boardmessage->delete()) {
			$this->Session->setFlash(__('The boardmessage has been deleted.'));
		} else {
			$this->Session->setFlash(__('The boardmessage could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
