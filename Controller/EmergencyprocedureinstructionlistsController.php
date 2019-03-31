<?php
App::uses('AppController', 'Controller');
/**
 * Emergencyprocedureinstructionlists Controller
 *
 * @property Emergencyprocedureinstructionlist $Emergencyprocedureinstructionlist
 * @property PaginatorComponent $Paginator
 */
class EmergencyprocedureinstructionlistsController extends AppController {

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
		$this->Emergencyprocedureinstructionlist->recursive = 0;
		$this->set('emergencyprocedureinstructionlists', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Emergencyprocedureinstructionlist->exists($id)) {
			throw new NotFoundException(__('Invalid emergencyprocedureinstructionlist'));
		}
		$options = array('conditions' => array('Emergencyprocedureinstructionlist.' . $this->Emergencyprocedureinstructionlist->primaryKey => $id));
		$this->set('emergencyprocedureinstructionlist', $this->Emergencyprocedureinstructionlist->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Emergencyprocedureinstructionlist->create();
			if ($this->Emergencyprocedureinstructionlist->save($this->request->data)) {
				$this->Session->setFlash(__('The emergencyprocedureinstructionlist has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The emergencyprocedureinstructionlist could not be saved. Please, try again.'));
			}
		}
		$emergencyprocedures = $this->Emergencyprocedureinstructionlist->Emergencyprocedure->find('list');
		$this->set(compact('emergencyprocedures'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Emergencyprocedureinstructionlist->exists($id)) {
			throw new NotFoundException(__('Invalid emergencyprocedureinstructionlist'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Emergencyprocedureinstructionlist->save($this->request->data)) {
				$this->Session->setFlash(__('The emergencyprocedureinstructionlist has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The emergencyprocedureinstructionlist could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Emergencyprocedureinstructionlist.' . $this->Emergencyprocedureinstructionlist->primaryKey => $id));
			$this->request->data = $this->Emergencyprocedureinstructionlist->find('first', $options);
		}
		$emergencyprocedures = $this->Emergencyprocedureinstructionlist->Emergencyprocedure->find('list');
		$this->set(compact('emergencyprocedures'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Emergencyprocedureinstructionlist->id = $id;
		if (!$this->Emergencyprocedureinstructionlist->exists()) {
			throw new NotFoundException(__('Invalid emergencyprocedureinstructionlist'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Emergencyprocedureinstructionlist->delete()) {
			$this->Session->setFlash(__('The emergencyprocedureinstructionlist has been deleted.'));
		} else {
			$this->Session->setFlash(__('The emergencyprocedureinstructionlist could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function addInstruction($procedureId = null)
	{
		if($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
		{

			$n = 0;
			foreach ($this->request->data['Emergencyprocedureinstructionlist'] as $instruction) {

				$data['Emergencyprocedureinstructionlist']['emergencyprocedure_id'] = $procedureId;
				$data['Emergencyprocedureinstructionlist']['instruction'] = $instruction;
				$data['Emergencyprocedureinstructionlist']['status'] =1;
				$this->Emergencyprocedureinstructionlist->create();

				if($this->Emergencyprocedureinstructionlist->save($data))
				{
					$id = $this->Emergencyprocedureinstructionlist->id;

					$dataArr[$n]['id'] = $id;
					$dataArr[$n]['instruction'] = $instruction;
					$n++;
				}
			}
			

			$this->set(array(

					'dataArr'=>$dataArr,
					'_serialize'=>['dataArr'],
					'_jsonp'=>true
				));
		}
	}

	public function editInstruction()
	{
		if($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
		{

			if($this->Emergencyprocedureinstructionlist->save($this->request->data))
			{
				$id = $this->Emergencyprocedureinstructionlist->id;
				$instruction = $this->request->data['Emergencyprocedureinstructionlist']['instruction'];
				$output=array(
					'status'=>1,
					'data'=>['id'=>$id,'instruction'=>$instruction]);
			}else
			{
				$output= array('status'=>0);
			}

			$this->set(array(

					'output'=>$output,
					'_serialize'=>['output'],
					'_jsonp'=>true
				));
		}
	}

	public function instructionDetail($instructionId = null)
	{
		if($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
		{
			$this->Emergencyprocedureinstructionlist->recursive = -1;
			$options = array('conditions'=>['Emergencyprocedureinstructionlist.id'=>$instructionId]);

			$instruction = $this->Emergencyprocedureinstructionlist->find('first', $options);
			if(!empty($instruction))
			{	

				$output=array(
					'status'=>1,
					'instruction'=>$instruction);
			}else
			{
				$output= array('status'=>0);
			}

			$this->set(array(

					'output'=>$output,
					'_serialize'=>['output'],
					'_jsonp'=>true
				));
		}
	}

	public function getInstruction($procedureId = null, $page = 1)
	{
		$this->Emergencyprocedureinstructionlist->recursive = -1;
            $limit = 20;
            $this->paginate = array('conditions'=>array('Emergencyprocedureinstructionlist.emergencyprocedure_id'=>$procedureId, 'Emergencyprocedureinstructionlist.status'=>1), 'limit'=>$limit,"page"=>$page);
      
            $instructions = $this->Paginator->paginate();
            $page=$this->params['paging']['Emergencyprocedureinstructionlist']['pageCount'];
            $currentPage = $this->params['paging']['Emergencyprocedureinstructionlist']['page'];

            if (!empty($instructions)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "getInstruction",
                "pageCount" => $page,
                "status" => $status,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );

            $this->set('output', $output);
            $this->set('instructions', $instructions);

            $this->set(
                    array(
                        "_serialize" => array('instructions', 'output')
                    )
            );
	}


	public function deleteInst($id = null) {

		$this->Emergencyprocedureinstructionlist->id = $id;
		if (!$this->Emergencyprocedureinstructionlist->exists()) {
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Emergencyprocedureinstructionlist->delete()) {

			$output = 1;

		} else {
			$output = 0;
		}

		$this->set(array(
			"output"=>$output,
			"_serialize"=>['output'],
			"_jsonp"=>true
			));

	}
}
