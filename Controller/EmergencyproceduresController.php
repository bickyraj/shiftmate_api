<?php
App::uses('AppController', 'Controller');
/**
 * Emergencyprocedures Controller
 *
 * @property Emergencyprocedure $Emergencyprocedure
 * @property PaginatorComponent $Paginator
 */
class EmergencyproceduresController extends AppController {

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
		$this->Emergencyprocedure->recursive = 0;
		$this->set('emergencyprocedures', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Emergencyprocedure->exists($id)) {
			throw new NotFoundException(__('Invalid emergencyprocedure'));
		}
		$options = array('conditions' => array('Emergencyprocedure.' . $this->Emergencyprocedure->primaryKey => $id));
		$this->set('emergencyprocedure', $this->Emergencyprocedure->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Emergencyprocedure->create();
			if ($this->Emergencyprocedure->save($this->request->data)) {
				$this->Session->setFlash(__('The emergencyprocedure has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The emergencyprocedure could not be saved. Please, try again.'));
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
		if (!$this->Emergencyprocedure->exists($id)) {
			throw new NotFoundException(__('Invalid emergencyprocedure'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Emergencyprocedure->save($this->request->data)) {
				$this->Session->setFlash(__('The emergencyprocedure has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The emergencyprocedure could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Emergencyprocedure.' . $this->Emergencyprocedure->primaryKey => $id));
			$this->request->data = $this->Emergencyprocedure->find('first', $options);
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
		$this->Emergencyprocedure->id = $id;
		if (!$this->Emergencyprocedure->exists()) {
			throw new NotFoundException(__('Invalid emergencyprocedure'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Emergencyprocedure->delete()) {
			$this->Session->setFlash(__('The emergencyprocedure has been deleted.'));
		} else {
			$this->Session->setFlash(__('The emergencyprocedure could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function addProcedure()
	{
		if($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
		{
			$this->request->data['Emergencyprocedure']['status'] = 1;

			if(isset($this->request->data['Emergencyprocedureinstructionlist']) && !empty($this->request->data['Emergencyprocedureinstructionlist']))
			{
				foreach ($this->request->data['Emergencyprocedureinstructionlist'] as $key => $value)
				{
					if(empty($value['instruction']))
					{
						unset($this->request->data['Emergencyprocedureinstructionlist'][$key]);
					}else
					{
						$this->request->data['Emergencyprocedureinstructionlist'][$key]['status'] = 1;
					}
				}
			}
			$this->Emergencyprocedure->create();

			if($this->Emergencyprocedure->saveAssociated($this->request->data))
			{
				$id = $this->Emergencyprocedure->id;
				$title = $this->request->data['Emergencyprocedure']['title'];
				$output=array(
					'status'=>1,
					'data'=>['id'=>$id,'title'=>$title]);
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

	public function editProcedure($procedureId = null)
	{
		if($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
		{
			if($this->Emergencyprocedure->save($this->request->data))
			{
				$id = $this->Emergencyprocedure->id;
				$procedure = $this->request->data['Emergencyprocedure']['title'];
				$output=array(
					'status'=>1,
					'data'=>['id'=>$id,'procedure'=>$procedure]);
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

	public function procedureDetail($procedureId = null)
	{

		$this->Emergencyprocedure->Behaviors->load('Containable');

		$options = array('conditions'=>['Emergencyprocedure.id'=>$procedureId], 'contain'=>false);
		$procedure = $this->Emergencyprocedure->find('first', $options);

		$this->set(array(
			'procedure'=>$procedure,
			'_serialize'=>['procedure'],
			'_jsonp'=>true
			));
	}

	public function procedureList($orgId = null, $page = 1)
	{

    	   $this->Emergencyprocedure->recursive = 0;
            $limit = 20;
            $this->paginate = array('conditions'=>array('Emergencyprocedure.organization_id'=>$orgId), 'limit'=>$limit,"page"=>$page);
      
            $procedureList = $this->Paginator->paginate();
            $page=$this->params['paging']['Emergencyprocedure']['pageCount'];
            $currentPage = $this->params['paging']['Emergencyprocedure']['page'];

            if (!empty($procedureList)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "procedureList",
                "pageCount" => $page,
                "status" => $status,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );

            $this->set('output', $output);
            $this->set('procedureList', $procedureList);

            $this->set(
                    array(
                        "_serialize" => array('procedureList', 'output')
                    )
            );
    }

    public function deleteProcedure($procedureId = null)
    {
    	$this->Emergencyprocedure->id = $procedureId;
		if (!$this->Emergencyprocedure->exists()) {
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Emergencyprocedure->delete()) {
			$output = 1;

		} else {
			$output = 0;
		}

		$this->set(array(
			'output'=>$output,
			'_serialize'=>['output'],
			'_jsonp'=>true
			));
    }

}
