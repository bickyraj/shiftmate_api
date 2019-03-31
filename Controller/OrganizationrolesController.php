<?php
App::uses('AppController', 'Controller');
/**
 * Organizationroles Controller
 *
 * @property Organizationrole $Organizationrole
 * @property PaginatorComponent $Paginator
 */
class OrganizationrolesController extends AppController {

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
		$this->Organizationrole->recursive = 0;
		$this->set('organizationroles', $this->Paginator->paginate());
	}
        
        public function organizationRoleList($orgId = NULL){
            $roles = $this->Organizationrole->organizationRoleList($orgId);
            //debug($roles);die();
            $this->set('orgRoleList', $roles);
            $this->set(
                    array(
                        "_serialize" => array('orgRoleList')
                    )
            );
        }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Organizationrole->exists($id)) {
			throw new NotFoundException(__('Invalid organizationrole'));
		}
		$options = array('conditions' => array('Organizationrole.' . $this->Organizationrole->primaryKey => $id));
		$this->set('organizationrole', $this->Organizationrole->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	/*public function add() {
		if ($this->request->is('post')) {
			$this->Organizationrole->create();
			if ($this->Organizationrole->save($this->request->data)) {
				$this->Session->setFlash(__('The organizationrole has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The organizationrole could not be saved. Please, try again.'));
			}
		}
		$organizations = $this->Organizationrole->Organization->find('list');
		$this->set(compact('organizations'));
	}*/
        public function add() {
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
			$this->Organizationrole->create();
			if ($this->Organizationrole->save($this->request->data)) {
				//$this->Session->setFlash(__('The organizationrole has been saved.'));
				//return $this->redirect(array('action' => 'index'));
                            
                        $output = 1;
			} else {
				//$this->Session->setFlash(__('The organizationrole could not be saved. Please, try again.'));
			
                            $output = 0;
                        }
		}
		//$organizations = $this->Organizationrole->Organization->find('list');
		//$this->set(compact('organizations'));
           // $output = $this->request->data;
                $this->set('output', $output);
            $this->set(
                    array(
                        "_serialize" => array('output')
                    )
            );
        }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Organizationrole->exists($id)) {
			throw new NotFoundException(__('Invalid organizationrole'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Organizationrole->save($this->request->data)) {
				$this->Session->setFlash(__('The organizationrole has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The organizationrole could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Organizationrole.' . $this->Organizationrole->primaryKey => $id));
			$this->request->data = $this->Organizationrole->find('first', $options);
		}
		$organizations = $this->Organizationrole->Organization->find('list');
		$this->set(compact('organizations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Organizationrole->id = $id;
		if (!$this->Organizationrole->exists()) {
			throw new NotFoundException(__('Invalid organizationrole'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Organizationrole->delete()) {
			$this->Session->setFlash(__('The organizationrole has been deleted.'));
		} else {
			$this->Session->setFlash(__('The organizationrole could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function orgRoleList($orgId) {
            $orgRoleList = $this->Organizationrole->find('list',array(
            		'conditions'=>['Organizationrole.organization_id'=>$orgId]
            	));
            $this->set('orgRoleList', $orgRoleList);

            if (!empty($orgRoleList)){
                $status = 1;
            }else{
                $status = 0;
            }

            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "orgRoleList",
                "status" => $status,
                "error" => array("validation" => "")
            );
            $this->set('output', $output);

            $this->set(
                    array(
                        "_serialize" => array('orgRoleList', 'output')
                    )
            );
        }
        public function orgRoleData($orgId = null){
        	$this->Organizationrole->recursive = -1;
        	$orgRole = $this->Organizationrole->find('all',array('conditions'=>array('Organizationrole.organization_id' => $orgId)));
        	$this->set('orgRole', $orgRole);

            $this->set(
                    array(
                        "_serialize" => array('orgRole')
                    )
            );
        }
	public function addorgRolewithData($orgId = null) 
	{
		$this->Organizationrole->recursive = -1;
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Organizationrole']['organization_id'] = $orgId;
			$this->Organizationrole->create();
			$rule = array('Organizationrole.title'=>$this->request->data['Organizationrole']['title'],'Organizationrole.organization_id'=>$orgId, 'Organizationrole.status'=>1);

			if(!$this->Organizationrole->hasAny($rule)){
				if ($this->Organizationrole->save($this->request->data)) {
					$orgRoleId = $this->Organizationrole->getLastInsertId();
					$orgRole = $this->Organizationrole->find('first',array('conditions'=>array('Organizationrole.id'=>$orgRoleId)));
					$this->set('orgRole', $orgRole);
	                $output = 1;
				} else 
				{
	                $output = 0;
	            }
	        } else {
	        	$output = 2;
	        }   
		}
		$this->set('output', $output);
        $this->set(
                array(
                    "_serialize" => array('output','orgRole'),
                    "_jsonp"=>true
                )
        );
    }

    public function editRole($orgId){
    	$id = $this->request->data['Organizationrole']['id'];
    	
    	$this->Organizationrole->id = $id;
    	
    	$rule = array('Organizationrole.title'=>$this->request->data['Organizationrole']['title'],'Organizationrole.organization_id'=>$orgId,'Organizationrole.status'=>1);
    	if($this->Organizationrole->hasAny($rule)){
    		$output['status'] = 2; //already exist
    	} else {
	    	if($this->Organizationrole->save($this->request->data)){
	    		$output['status'] = 1; // updated
	    		$output['data'] = $this->request->data;
	    	} else {
	    		$output['status'] = 0; 
	    	}
	    }	

    	$this->set(array(
    			'output'=>$output,
    			'_serialize'=>'output'
    		));
    }

    public function deleteRole($id){
    	$this->Organizationrole->id = $id;
    	$this->request->data['Organizationrole']['status'] = 2;
    	if($this->Organizationrole->save($this->request->data)){
    		$output['status'] = 1; //deleted
    	} else {
    		$output['status'] = 0;
    	}

    	$this->set(array(
    			'output'=>$output,
    			'_serialize'=>'output'
    		));
    }
}
