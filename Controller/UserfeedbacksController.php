<?php
App::uses('AppController', 'Controller');
/**
 * Userfeedbacks Controller
 *
 * @property Userfeedback $Userfeedback
 * @property PaginatorComponent $Paginator
 */
class UserfeedbacksController extends AppController {

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
		$this->Userfeedback->recursive = 0;
		$this->set('userfeedbacks', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Userfeedback->exists($id)) {
			throw new NotFoundException(__('Invalid userfeedback'));
		}
		$options = array('conditions' => array('Userfeedback.' . $this->Userfeedback->primaryKey => $id));
		$this->set('userfeedback', $this->Userfeedback->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Userfeedback->create();
			if ($this->Userfeedback->save($this->request->data)) {
				$this->Session->setFlash(__('The userfeedback has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userfeedback could not be saved. Please, try again.'));
			}
		}
		$feeds = $this->Userfeedback->Feed->find('list');
		$this->set(compact('feeds'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Userfeedback->exists($id)) {
			throw new NotFoundException(__('Invalid userfeedback'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Userfeedback->save($this->request->data)) {
				$this->Session->setFlash(__('The userfeedback has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userfeedback could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Userfeedback.' . $this->Userfeedback->primaryKey => $id));
			$this->request->data = $this->Userfeedback->find('first', $options);
		}
		$feeds = $this->Userfeedback->Feed->find('list');
		$this->set(compact('feeds'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Userfeedback->id = $id;
		if (!$this->Userfeedback->exists()) {
			throw new NotFoundException(__('Invalid userfeedback'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Userfeedback->delete()) {
			$this->Session->setFlash(__('The userfeedback has been deleted.'));
		} else {
			$this->Session->setFlash(__('The userfeedback could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function forwardFeedback()
	{
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
		{
			$status = 0;

			$this->Userfeedback->create();
			$this->request->data['Userfeedback']['status'] = 1;

			$conditions = array(
							    'Userfeedback.user_id' => $this->request->data['Userfeedback']['user_id'],
							    'Userfeedback.feed_id' => $this->request->data['Userfeedback']['feed_id']
							);

			if ($this->Userfeedback->hasAny($conditions)){
				
				$status = 2;
			}
			else
			{
				if($this->Userfeedback->save($this->request->data))
				{
					$status = 1;
				}
			}
			

			$data = $this->request->data;
			$this->set(array(
				"status"=>$status,
				"_serialize"=>['status'],
				"_jsonp"=>true
			));	
		}
	}

	public function getAllUserFeeds($user_id = null)
	{
		$data = $this->Userfeedback->getAllUserFeeds($user_id);

		$status = 0;

		if(isset($data) && !empty($data))
		{
			$status = 1;
		}

		$this->set(array(
			"status"=>$status,
			"feedbacks"=>$data,
			"_serialize"=>['status', 'feedbacks'],
			"_jsonp"=>true
			));
	}

	public function viewFeeds($userFeedback_id = null)
	{
		$data = $this->Userfeedback->viewFeeds($userFeedback_id);

		$status = 0;

		if(isset($data) && !empty($data))
		{
			$status = 1;
		}

		$this->set(array(
			"status"=>$status,
			"feedback"=>$data,
			"_serialize"=>['status', 'feedback'],
			"_jsonp"=>true
			));
	}
}
