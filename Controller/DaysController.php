<?php
App::uses('AppController', 'Controller');
/**
 * Days Controller
 *
 * @property Day $Day
 * @property PaginatorComponent $Paginator
 */
class DaysController extends AppController {

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
		$this->Day->recursive = 0;
		$this->set('days', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Day->exists($id)) {
			throw new NotFoundException(__('Invalid day'));
		}
		$options = array('conditions' => array('Day.' . $this->Day->primaryKey => $id));
		$this->set('day', $this->Day->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Day->create();
			if ($this->Day->save($this->request->data)) {
				$this->Session->setFlash(__('The day has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The day could not be saved. Please, try again.'));
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
		if (!$this->Day->exists($id)) {
			throw new NotFoundException(__('Invalid day'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Day->save($this->request->data)) {
				$this->Session->setFlash(__('The day has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The day could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Day.' . $this->Day->primaryKey => $id));
			$this->request->data = $this->Day->find('first', $options);
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
		$this->Day->id = $id;
		if (!$this->Day->exists()) {
			throw new NotFoundException(__('Invalid day'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Day->delete()) {
			$this->Session->setFlash(__('The day has been deleted.'));
		} else {
			$this->Session->setFlash(__('The day could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
         public function dayList() {
            $days = $this->Day->find('list');
            $this->set('days', $days);

            if (!empty($days)){
                $status = 1;
            }else{
                $status = 0;
            }

            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "dayList",
                "status" => $status,
                "error" => array("validation" => "")
            );
            $this->set('output', $output);

            $this->set(
                    array(
                        "_serialize" => array('days', 'output')
                    )
            );
        }
}
