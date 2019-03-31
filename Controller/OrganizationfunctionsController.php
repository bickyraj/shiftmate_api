<?php
App::uses('AppController', 'Controller');
/**
 * Organizationfunctions Controller
 *
 * @property Organizationfunction $Organizationfunction
 * @property PaginatorComponent $Paginator
 */
class OrganizationfunctionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
       
        public function test($org_id){
            $branchList = $this->Organizationfunction->organizationBranchList($org_id);
            debug($branchList);
            
        }
        
        public function addFunction() {
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
                    if($this->request->data['Organizationfunction']['branch_id'] == 0){
                        $organization_id = $this->request->data['Organizationfunction']['organization_id'];
                        $branchList = $this->Organizationfunction->organizationBranchList($organization_id);

                        foreach($branchList as $key=>$val){
                            $this->request->data['Organizationfunction']['branch_id'] = $key;
                            $this->Organizationfunction->create();
                            if($this->Organizationfunction->save($this->request->data))
                                {
                                    $id = $this->Organizationfunction->id;

                                    $organizationFunctions[] = $this->Organizationfunction->find('first', array(
                                          'conditions'=> array(
                                              'Organizationfunction.id' => $id
                                          )
                                      ));
                                }
                        }

                        $fxn1=[];
                        $count=1;
                        foreach($organizationFunctions as $fxn){
                            $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['id'][$count]=$fxn['Organizationfunction']['id'];
                            $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['status']=$fxn['Organizationfunction']['status'];
                            $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['note']=$fxn['Organizationfunction']['note'];
                            $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['function_date']=$fxn['Organizationfunction']['function_date'];
                            $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['branch_id'][$count]=$fxn['Organizationfunction']['branch_id'];
                            $count++;
                        }
                        $output = array(
                                    'data'=>$fxn1,
                                    'status' => 1
                                );
                    }else{
            			$this->Organizationfunction->create();
            			if ($this->Organizationfunction->save($this->request->data)) {

            				$output = array(
                                                'data'=> $organizationfunction,
                                                'status' => 1
                                            );
            			} else {
            				$output = array(
                                                'status' => 0
                                            );
            			}
                    }
		}
		$this->set(array(
                    'output' => $output,
                    '_serialize' => array('output'),
                    '_jsonp'=>true
                ));
	}

	public function editFunction() {
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
		  $fxns=json_decode($this->request->data['Organizationfunction']['id']);
		  foreach($fxns as $fxnid){
		      $this->Organizationfunction->delete($fxnid);
		  }
        if($this->request->data['Organizationfunction']['branch_id'] == 0){
            $organization_id = $this->request->data['Organizationfunction']['organization_id'];
            $branchList = $this->Organizationfunction->organizationBranchList($organization_id);
            foreach($branchList as $key=>$val){
                $this->request->data['Organizationfunction']['branch_id'] = $key;
                $this->Organizationfunction->save($this->request->data);
            }
            $output = array(
                        'status' => 1
                    );
        }else{
			if ($this->Organizationfunction->save($this->request->data)) {
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
		$this->set(array(
                    'output' => $output,
                    '_serialize' => array('output'),
                    '_jsonp'=>true
                ));
	}
        
        public function listFunctionForOrganization($org_id = NULL){
            $functions = $this->Organizationfunction->listFunctionForOrganization($org_id);
            $fxn1=[];
            $count=1;
            foreach($functions as $fxn){
                $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['id'][$count]=$fxn['Organizationfunction']['id'];
                $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['status']=$fxn['Organizationfunction']['status'];
                $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['note']=$fxn['Organizationfunction']['note'];
                $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['function_date']=$fxn['Organizationfunction']['function_date'];
                $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['branch_id'][$count]=$fxn['Organizationfunction']['branch_id'];
                $count++;
            }
            $this->set(array(
                'functions' => $fxn1,
                '_serialize' => array('functions'),
                '_jsonp'=>true
            ));
        }
        
        public function holidays($org_id = NULL, $branch_id = NULL, $start_date = NULL, $end_date = NULL){
            $holidays = $this->Organizationfunction->holidays($org_id, $branch_id, $start_date, $end_date);
            
            $this->set(array(
                'holidays' => $holidays,
                '_serialize' => array('holidays')
            ));
        }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Organizationfunction->recursive = 0;
		$this->set('organizationfunctions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Organizationfunction->exists($id)) {
			throw new NotFoundException(__('Invalid organizationfunction'));
		}
		$options = array('conditions' => array('Organizationfunction.' . $this->Organizationfunction->primaryKey => $id));
		$this->set('organizationfunction', $this->Organizationfunction->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Organizationfunction->create();
			if ($this->Organizationfunction->save($this->request->data)) {
				$this->Session->setFlash(__('The organizationfunction has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The organizationfunction could not be saved. Please, try again.'));
			}
		}
		$organizations = $this->Organizationfunction->Organization->find('list');
		$branches = $this->Organizationfunction->Branch->find('list');
		$this->set(compact('organizations', 'branches'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Organizationfunction->exists($id)) {
			throw new NotFoundException(__('Invalid organizationfunction'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Organizationfunction->save($this->request->data)) {
				$this->Session->setFlash(__('The organizationfunction has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The organizationfunction could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Organizationfunction.' . $this->Organizationfunction->primaryKey => $id));
			$this->request->data = $this->Organizationfunction->find('first', $options);
		}
		$organizations = $this->Organizationfunction->Organization->find('list');
		$branches = $this->Organizationfunction->Branch->find('list');
		$this->set(compact('organizations', 'branches'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Organizationfunction->id = $id;
		if (!$this->Organizationfunction->exists()) {
			throw new NotFoundException(__('Invalid organizationfunction'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Organizationfunction->delete()) {
			$this->Session->setFlash(__('The organizationfunction has been deleted.'));
		} else {
			$this->Session->setFlash(__('The organizationfunction could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
    
    /**
     * OrganizationfunctionsController::addFunctionAjax()
     * 
     * @return void
     */
    public function addFunctionAjax(){
        $result=$this->Organizationfunction->addFunctionAjax($this->request->data);

        $fxn1=[];

        $count = 0;

        $fxn1[$result['Organizationfunction']['function_date'].$result['Organizationfunction']['note']]['id'][$count]=$result['Organizationfunction']['id'];
        $fxn1[$result['Organizationfunction']['function_date'].$result['Organizationfunction']['note']]['status']=$result['Organizationfunction']['status'];
        $fxn1[$result['Organizationfunction']['function_date'].$result['Organizationfunction']['note']]['note']=$result['Organizationfunction']['note'];
        $fxn1[$result['Organizationfunction']['function_date'].$result['Organizationfunction']['note']]['function_date']=$result['Organizationfunction']['function_date'];
        $fxn1[$result['Organizationfunction']['function_date'].$result['Organizationfunction']['note']]['branch_id'][$count]=$result['Organizationfunction']['branch_id'];

        $this->set(array(
            'fxn'=>$fxn1,
            '_serialize'=>array('fxn'),
            '_jsonp'=>true
        ));       
    }
    
    public function deleteFunction(){
        $functions = $this->request->data['Organizationfunction']['ids'];
        
        $function=json_decode($functions);
        
        $count = 0;
        foreach($function as $fxn){
            $this->Organizationfunction->delete($fxn);
            $count++;
        }
        if($count > 0){
            $result = 1;
        }else{
            $result = 0;
        }
        $this->set(array(
            'called'=>$result,
            '_serialize'=>array('called'),
            '_jsonp'=>true
        ));
    }
    
    public function editFunctionDate(){
        $functions = json_decode($this->request->data['Organizationfunction']['ids']);
        $count = 0;
        foreach($functions as $fxn){
            $data['Organizationfunction']['id']=$fxn;
            $data['Organizationfunction']['function_date']=$this->request->data['Organizationfunction']['function_date'];
            $data['Organizationfunction']['organization_id']=$this->request->data['Organizationfunction']['organization_id'];
            if($this->Organizationfunction->save($data)){
                $count++;
            }
        }
        if($count > 0){
            $result = 1;
        }else{
            $result = 0;
        }
        $this->set(array(
            'success'=>$result,
            '_serialize'=>array('success'),
            '_jsonp'=>true
        ));
    }

    public function listOrganizationHolidays($org_id = null)
    {
        $orgHolidays = $this->Organizationfunction->listFunctionForOrganization($org_id);

        if(isset($orgHolidays) && !empty($orgHolidays))
        {
            $countxyz=1;
                    foreach($orgHolidays as $fxn){
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['title']="Function";
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['description'] = $fxn['Organizationfunction']['note'];
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['start']=$fxn['Organizationfunction']['function_date'];
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['end']=$fxn['Organizationfunction']['function_date'];
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['org']['id']=$fxn['Organization']['id'];
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['org']['title']=$fxn['Organization']['title'];
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['status']=$fxn['Organizationfunction']['status'];
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['id']=$fxn['Organizationfunction']['id'];
                        
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['branch_name'][$countxyz]=$fxn['Branch']['title'];
                        $countxyz++;
                    }
            $status = 1;
        }
        else
        {
            $status = 0;
        }
        $this->set(array(
            'orgHolidays'=>$fxn1,
            'status'=>$status,
            '_serialize'=>['orgHolidays','status'],
            '_jsonp'=>true
            ));
    }
}
