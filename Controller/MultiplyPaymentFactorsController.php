<?php
App::uses('AppController', 'Controller');
/**
 * MultiplyPaymentFactors Controller
 *
 * @property MultiplyPaymentFactor $MultiplyPaymentFactor
 * @property PaginatorComponent $Paginator
 */
class MultiplyPaymentFactorsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
        
        public function paymentFactorRates($org_id = NULL, $branch_id = NULL){
            $paymentFactorRates = $this->MultiplyPaymentFactor->paymentFactorRates($org_id, $branch_id);
            
            $this->set(array(
                'paymentFactorRates' => $paymentFactorRates,
                '_serialize' => array('paymentFactorRates')
            ));
        }
        
        public function listPaymentFactors($org_id = NULL, $branch_id = NULL, $date = NULL){
            if($date == NULL){
                $date = date('Y-m-d');
            }
            $listPaymentFactors = $this->MultiplyPaymentFactor->listPaymentFactors($org_id, $branch_id, $date);
            $this->set(array(
                'listPaymentFactors'=> $listPaymentFactors,
                '_serialize' => array('listPaymentFactors')
            ));
        }
        
        public function addPaymentFactor($orgId = null) {
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
				//$data = $this->request->data;
				if(isset($this->request->data['MultiplyPaymentFactor']['status'])){
				if($this->request->data['MultiplyPaymentFactor']['status'] == 'on'){
							$this->request->data['MultiplyPaymentFactor']['status'] = '2';
						}else{
							$this->request->data['MultiplyPaymentFactor']['status'] = '1';
						}
				}else{
					$this->request->data['MultiplyPaymentFactor']['status'] = '1';
				}

				if($this->request->data['MultiplyPaymentFactor']['multiplypaymentfactortype_id'] == 1 || $this->request->data['MultiplyPaymentFactor']['multiplypaymentfactortype_id'] == 2)
				{
					$this->request->data['MultiplyPaymentFactor']['status'] = '2';
				}

				$branchIds = array();
				$data = $this->request->data;
                    if($this->request->data['MultiplyPaymentFactor']['branch_id'] == 0){
                       //$organization_id = $this->request->data['MultiplyPaymentFactor']['organization_id'];
                        $branchList = $this->MultiplyPaymentFactor->organizationBranchList($orgId);
                        foreach($branchList as $key=>$val){
                            $this->request->data['MultiplyPaymentFactor']['branch_id'] = $key;
                            $this->MultiplyPaymentFactor->create();
                            $this->MultiplyPaymentFactor->save($this->request->data);

                            $branchIds[] = $this->MultiplyPaymentFactor->id;
                        }

                        $conditions = array('conditions'=>['MultiplyPaymentFactor.id'=>$branchIds]);

                        $list = $this->MultiplyPaymentFactor->find('all', $conditions);
                        $output = array(
		                        	'data'=>$list,
                                    'status' => 1,
                                    "error"=>array("validation"=>$this->MultiplyPaymentFactor->invalidfields())
                                );
                    }
                    else{
						$this->MultiplyPaymentFactor->create();
						if ($this->MultiplyPaymentFactor->save($this->request->data)) {
							$this->Session->setFlash(__('The multiply payment factor has been saved.'));

							$conditions = array('conditions'=>['MultiplyPaymentFactor.id' => $this->MultiplyPaymentFactor->id]);
							$list = $this->MultiplyPaymentFactor->find('first', $conditions);
							$output = array(
												'data'=>$list,
			                                    'status' => 1,
			                                    "error"=>array("validation"=>$this->MultiplyPaymentFactor->invalidfields())
			                                );
						} else {
							$output = array(
			                                    'status' => 0,
			                                    "error"=>array("validation"=>$this->MultiplyPaymentFactor->invalidfields())
			                                );
						}
                    }
		}
		$this->set(array(
                    'output' => $output,
                    '_serialize' => array('output')
                ));
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->MultiplyPaymentFactor->recursive = 0;
		$this->set('multiplyPaymentFactors', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MultiplyPaymentFactor->exists($id)) {
			throw new NotFoundException(__('Invalid multiply payment factor'));
		}
		$options = array('conditions' => array('MultiplyPaymentFactor.' . $this->MultiplyPaymentFactor->primaryKey => $id));
		$this->set('multiplyPaymentFactor', $this->MultiplyPaymentFactor->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MultiplyPaymentFactor->create();
			if ($this->MultiplyPaymentFactor->save($this->request->data)) {
				$this->Session->setFlash(__('The multiply payment factor has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The multiply payment factor could not be saved. Please, try again.'));
			}
		}
		$organizations = $this->MultiplyPaymentFactor->Organization->find('list');
		$multiplypaymentfactortypes = $this->MultiplyPaymentFactor->Multiplypaymentfactortype->find('list');
		$this->set(compact('organizations', 'multiplypaymentfactortypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->MultiplyPaymentFactor->exists($id)) {
			throw new NotFoundException(__('Invalid multiply payment factor'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MultiplyPaymentFactor->save($this->request->data)) {
				$this->Session->setFlash(__('The multiply payment factor has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The multiply payment factor could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MultiplyPaymentFactor.' . $this->MultiplyPaymentFactor->primaryKey => $id));
			$this->request->data = $this->MultiplyPaymentFactor->find('first', $options);
		}
		$organizations = $this->MultiplyPaymentFactor->Organization->find('list');
		$multiplypaymentfactortypes = $this->MultiplyPaymentFactor->Multiplypaymentfactortype->find('list');
		$this->set(compact('organizations', 'multiplypaymentfactortypes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->MultiplyPaymentFactor->id = $id;
		if (!$this->MultiplyPaymentFactor->exists()) {
			throw new NotFoundException(__('Invalid multiply payment factor'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->MultiplyPaymentFactor->delete()) {
			$this->Session->setFlash(__('The multiply payment factor has been deleted.'));
		} else {
			$this->Session->setFlash(__('The multiply payment factor could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function addPaymentFactorWithData($orgId = null) {
		 $this->MultiplyPaymentFactor->Behaviors->load('Containable');
		 $date = date('Y-m-d');
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
			if(isset($this->request->data['MultiplyPaymentFactor']['status'])){
				if($this->request->data['MultiplyPaymentFactor']['status'] == 'on'){
							$this->request->data['MultiplyPaymentFactor']['status'] = 2;
						}else{
							$this->request->data['MultiplyPaymentFactor']['status'] = 1;
						}
				}else{
					$this->request->data['MultiplyPaymentFactor']['status'] = 1;
				}
			//debug($this->request->data['MultiplyPaymentFactor']['status']);
                    if($this->request->data['MultiplyPaymentFactor']['branch_id'] == 0){
                    	
                        $organization_id = $this->request->data['MultiplyPaymentFactor']['organization_id'];
                        $branchList = $this->MultiplyPaymentFactor->organizationBranchList($organization_id);
                        foreach($branchList as $key=>$val){
                            $this->request->data['MultiplyPaymentFactor']['branch_id'] = $key;
                            $this->MultiplyPaymentFactor->create();
                            $this->MultiplyPaymentFactor->save($this->request->data);
                        }
                        $output = array(
                                    'status' => 1
                                );
                    }else{
			$this->MultiplyPaymentFactor->create();
			if ($this->MultiplyPaymentFactor->save($this->request->data)) {
			 	$multiplePaymentId = $this->MultiplyPaymentFactor->getLastInsertId();
			 	$mPaymentData = $this->MultiplyPaymentFactor->find('first',array(
					'conditions'=>array(
							'MultiplyPaymentFactor.organization_id' => $orgId,
							'MultiplyPaymentFactor.id' => $multiplePaymentId,
							'MultiplyPaymentFactor.implement_date <=' => $date,
		                    'MultiplyPaymentFactor.end_date >=' =>$date,
		                    'MultiplyPaymentFactor.status' => 1
						),
					'contain' => array(
							'Branch',
							'Multiplypaymentfactortype'
						)
				));
				$this->set('mpdata',$mPaymentData);
				$this->Session->setFlash(__('The multiply payment factor has been saved.'));
				$output = array(
                                    'status' => 1
                                );
			} else {
				$output = array(
                                    'status' => 0
                                );
			}
                    }
		}
		debug($status);
		$this->set(array(
                    'output' => $output,
                    '_serialize' => array('output','mpdata')
                ));
	}
}
