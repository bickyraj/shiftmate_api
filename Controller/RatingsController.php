<?php
App::uses('AppController', 'Controller');
/**
 * Ratings Controller
 *
 * @property Rating $Rating
 * @property PaginatorComponent $Paginator
 */
class RatingsController extends AppController {

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
		$this->Rating->recursive = 0;
		$this->set('ratings', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Rating->exists($id)) {
			throw new NotFoundException(__('Invalid rating'));
		}
		$options = array('conditions' => array('Rating.' . $this->Rating->primaryKey => $id));
		$this->set('rating', $this->Rating->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Rating->create();
			if ($this->Rating->save($this->request->data)) {
				$this->Session->setFlash(__('The rating has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rating could not be saved. Please, try again.'));
			}
		}
		$users = $this->Rating->User->find('list');
		$organizations = $this->Rating->Organization->find('list');
		$this->set(compact('users', 'organizations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Rating->exists($id)) {
			throw new NotFoundException(__('Invalid rating'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Rating->save($this->request->data)) {
				$this->Session->setFlash(__('The rating has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rating could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Rating.' . $this->Rating->primaryKey => $id));
			$this->request->data = $this->Rating->find('first', $options);
		}
		$users = $this->Rating->User->find('list');
		$organizations = $this->Rating->Organization->find('list');
		$this->set(compact('users', 'organizations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Rating->id = $id;
		if (!$this->Rating->exists()) {
			throw new NotFoundException(__('Invalid rating'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Rating->delete()) {
			$this->Session->setFlash(__('The rating has been deleted.'));
		} else {
			$this->Session->setFlash(__('The rating could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function updateEmpRatings($orgId = null, $empId = null, $rating = null)
	{
		$conditions = array('Rating.organization_id'=>$orgId, 'Rating.user_id'=>$empId);

		$this->request->data['Rating']['organization_id'] = $orgId;
		$this->request->data['Rating']['user_id'] = $empId;
		$this->request->data['Rating']['ratings'] = $rating;

		$status = 0;
		if($this->Rating->hasAny($conditions))
		{
			$opt = $this->Rating->find('first', array('conditions'=>['Rating.organization_id'=>$orgId, 'Rating.user_id'=>$empId]));
			$id = $opt['Rating']['id'];

			$this->Rating->id = $id;
			$this->Rating->saveField('ratings', $rating);

			$status = 1;
		}else
		{
			$this->Rating->create();

			if($this->Rating->save($this->request->data))
			{
				$status = 1;
			}
		}
			$data = $this->request->data;
			$this->set(array(
				'data'=>$data,
				'status'=>$status,
				'_serialize'=>['data', 'status'],
				'_jsonp'=>true
				));
	}
}
