<?php
App::uses('AppController', 'Controller');
/**
 * Multiplypaymentfactortypes Controller
 *
 * @property Multiplypaymentfactortype $Multiplypaymentfactortype
 * @property PaginatorComponent $Paginator
 */
class MultiplypaymentfactortypesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
        
        public function addPaymentFactorType() {
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
                  /*  if($this->request->data['Multiplypaymentfactortype']['branch_id'] == 0){
                        $organization_id = $this->request->data['Multiplypaymentfactortype']['organization_id'];
                        $branchList = $this->Multiplypaymentfactortype->organizationBranchList($organization_id);
                        foreach($branchList as $key=>$val){
                            $this->request->data['Multiplypaymentfactortype']['branch_id'] = $key;
                            $this->Multiplypaymentfactortype->create();
                            $this->Multiplypaymentfactortype->save($this->request->data);
                        }
                        $output = array(
                                    'status' => 1
                                );
                    }else{*/
			$this->Multiplypaymentfactortype->create();
			if ($this->Multiplypaymentfactortype->save($this->request->data)) {
				$output = array(
                                    'status' => 1
                                );
			} else {
				$output = array(
                                    'status' => 0
                                );
			}
                    }
		//}
                $this->set(array(
                    'output' => $output,
                    '_serialize' => array('output')
                ));
	}
      
        public function listPaymentFactorTypes($org_id){
            $listPaymentFactorTypes = $this->Multiplypaymentfactortype->listPaymentFactorTypes($org_id);

            $this->set(array(
                'listPaymentFactorTypes' => $listPaymentFactorTypes,
                '_serialize' => array('listPaymentFactorTypes')
            ));
        }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Multiplypaymentfactortype->recursive = 0;
		$this->set('multiplypaymentfactortypes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Multiplypaymentfactortype->exists($id)) {
			throw new NotFoundException(__('Invalid multiplypaymentfactortype'));
		}
		$options = array('conditions' => array('Multiplypaymentfactortype.' . $this->Multiplypaymentfactortype->primaryKey => $id));
		$this->set('multiplypaymentfactortype', $this->Multiplypaymentfactortype->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Multiplypaymentfactortype->create();
			if ($this->Multiplypaymentfactortype->save($this->request->data)) {
				$this->Session->setFlash(__('The multiplypaymentfactortype has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The multiplypaymentfactortype could not be saved. Please, try again.'));
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
		if (!$this->Multiplypaymentfactortype->exists($id)) {
			throw new NotFoundException(__('Invalid multiplypaymentfactortype'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Multiplypaymentfactortype->save($this->request->data)) {
				$this->Session->setFlash(__('The multiplypaymentfactortype has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The multiplypaymentfactortype could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Multiplypaymentfactortype.' . $this->Multiplypaymentfactortype->primaryKey => $id));
			$this->request->data = $this->Multiplypaymentfactortype->find('first', $options);
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
		$this->Multiplypaymentfactortype->id = $id;
		if (!$this->Multiplypaymentfactortype->exists()) {
			throw new NotFoundException(__('Invalid multiplypaymentfactortype'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Multiplypaymentfactortype->delete()) {
			$this->Session->setFlash(__('The multiplypaymentfactortype has been deleted.'));
		} else {
			$this->Session->setFlash(__('The multiplypaymentfactortype could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function addPaymentFactorTypewithData($orgId = null) 
	{
		$this->Multiplypaymentfactortype->recursive = -1;
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) 
		{
            $this->request->data['Multiplypaymentfactortype']['organization_id'] = $orgId;    
			$this->Multiplypaymentfactortype->create();
			if ($this->Multiplypaymentfactortype->save($this->request->data)) {
				$mPayFacTypeId = $this->Multiplypaymentfactortype->getLastInsertId();
				$mpft = $this->Multiplypaymentfactortype->find('first',array('conditions'=>array('Multiplypaymentfactortype.id'=>$mPayFacTypeId)));
				$output = 1;
				$this->set('mpft',$mpft);
			} else {
				$output = 0;
			}
        }
        $this->set('output',$output);
        $this->set(
                        array(
                            "_serialize" =>array('output','mpft'),
                            "_jsonp"=>true
                        )
                );
	}  
}
