<?php
App::uses('AppController', 'Controller');
/**
 * Liscenses Controller
 *
 * @property Liscense $Liscense
 * @property PaginatorComponent $Paginator
 */
class LiscensesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function saveLiscense($userId){
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
		$this->request->data['Liscense']['user_id'] = $userId;
		
		$liscenseType = $this->request->data['Liscense']['type'];
		$issueDate = date('Y-m-d');//$this->request->data['Liscense']['issuedate'];
		$expiryDate = $this->request->data['Liscense']['expirydate'];

		$this->loadModel('Vaccination');
		
		if(isset($this->request->data['Vaccination']) && !empty($this->request->data['Vaccination'])){
			$this->Vaccination->deleteAll(array('Vaccination.user_id'=>$userId));
			$this->Vaccination->saveAll($this->request->data['Vaccination']);
		} else {
			$this->Vaccination->deleteAll(array('Vaccination.user_id'=>$userId));
		}
		
		$conditions = ['Liscense.user_id'=>$userId];
		if($this->Liscense->hasAny($conditions)){
			$liscenseId = $this->Liscense->find("first",array(
				'conditions'=>$conditions,
				'fields'=>'id'
				));
			$this->Liscense->id = $liscenseId['Liscense']['id'];
			
			$this->Liscense->save($this->request->data);
			
			$output['status'] = 1;//saved
		} else {
			$this->Liscense->create();
			if($this->Liscense->save($this->request->data)){
				$output['status'] = 1;
			}
		}

		$this->set(array(
			'output'=>$output,
			'_serialize'=>'output'
			));
	}
	}

	public function view($userId = null){
		$output = $this->Liscense->view($userId);
		
		$this->set(array(
			'output'=>$output,
			'_serialize'=>'output'
			));
	}

	public function getUserExpLiscenseList($userId = null)
	{
		$output = $this->Liscense->getUserExpLiscenseList($userId);
		
		$status = 0;

		if(isset($output) && !empty($output))
		{
			$status = 1;
		}
		$this->set(array(
			'status'=>$status,
			'output'=>$output,
			'_serialize'=>['output', 'status'],
			'_jsonp'=>true
			));

	}

}
