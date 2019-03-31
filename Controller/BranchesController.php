<?php
App::uses('AppController', 'Controller');
/**
 * Branches Controller
 *
 * @property Branch $Branch
 * @property PaginatorComponent $Paginator
 */
class BranchesController extends AppController {

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
		$this->Branch->recursive = 0;
                 $this->paginate = array('limit'=>1);
		$this->set('branches', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Branch->exists($id)) {
			throw new NotFoundException(__('Invalid branch'));
		}
		$options = array('conditions' => array('Branch.' . $this->Branch->primaryKey => $id));
		$this->set('branch', $this->Branch->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Branch->create();
			if ($this->Branch->save($this->request->data)) {
				$this->Session->setFlash(__('The branch has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The branch could not be saved. Please, try again.'));
			}
		}
		$organizations = $this->Branch->Organization->find('list');
		$users = $this->Branch->User->find('list');
		$cities = $this->Branch->City->find('list');
		$countries = $this->Branch->Country->find('list');
		$this->set(compact('organizations', 'users', 'cities', 'countries'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Branch->exists($id)) {
			throw new NotFoundException(__('Invalid branch'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Branch->save($this->request->data)) {
				$this->Session->setFlash(__('The branch has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The branch could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Branch.' . $this->Branch->primaryKey => $id));
			$this->request->data = $this->Branch->find('first', $options);
		}
		$organizations = $this->Branch->Organization->find('list');
		$users = $this->Branch->User->find('list');
		$cities = $this->Branch->City->find('list');
		$countries = $this->Branch->Country->find('list');
		$this->set(compact('organizations', 'users', 'cities', 'countries'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Branch->id = $id;
		if (!$this->Branch->exists()) {
			throw new NotFoundException(__('Invalid branch'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Branch->delete()) {
			$this->Session->setFlash(__('The branch has been deleted.'));
		} else {
			$this->Session->setFlash(__('The branch could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        
        public function createBranches($orgId = null){
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')){
            $BranchUserId = $this->request->data['Branch']['user_id'];
            //$this->request->data['Branch']['user_id'] = $userId;

            $this->request->data['Branch']['organization_id'] = $orgId;
            $this->request->data['Branch']['status'] = 1;
            $branchuser['BranchUser']['user_id'] = $this->request->data['Branch']['user_id'];
            $branchuser['BranchUser']['status'] = 1; 
            $this->Branch->create();
            if($BranchUserId == '0'){
                if ($this->Branch->save($this->request->data)) {
                    $branch_id = $this->Branch->id;
                    $output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                      "action" => "createBranches",
                                       "status"=>1,
                                        "id"=>$branch_id,
                                        //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Organization Branch Created")
                                      );
                }else {
                    $output= array( 
                                           "params" =>$this->request,
                                           "method"=>$this->method,
                                          "action" => "createBranches",
                                           "status"=>0,
                                           //"user"=>$this->request->data,
                                           "error"=>array("validation"=>"Fails Creating Organization Branche. Please Try Again")
                                          );
                }
            }
            else{
    			if ($this->Branch->save($this->request->data)) {
                    $branchuser['BranchUser']['branch_id'] = $this->Branch->id;
                    $this->Branch->BranchUser->save($branchuser);
                     $branch_id = $this->Branch->id;          
                                
    				$output= array( 
                                           "params" =>$this->request,
                                           "method"=>$this->method,
                                          "action" => "createBranches",
                                           "status"=>1,
                                            "id"=>$branch_id,
                                            //"user"=>$this->request->data,
                                           "error"=>array("validation"=>"Organization Branch Created")
                                          );
    			} else {
    				$output= array( 
                                           "params" =>$this->request,
                                           "method"=>$this->method,
                                          "action" => "createBranches",
                                           "status"=>0,
                                           //"user"=>$this->request->data,
                                           "error"=>array("validation"=>"Fails Creating Organization Branche. Please Try Again")
                                          );
    			}
            }
                
            $this->set('output',$output);
			$this->set(
                                    array(
                                        "_serialize" =>array('output')
                                    )
                            );
		}
		
	}
        
        
        //list all branches related to orgId
        public function listBranches($orgId = null,$page = 1) {
           /* if($this->request->isMobile()){
                debug($orgid);die('success');
            }*/
            $this->Branch->recursive = 0;
            $limit = 10;
            $this->paginate = array('conditions'=>array('organization_id'=>$orgId),'order' => array('Branch.id' => 'DESC'), 'limit'=>$limit, "page"=>$page);
      
            $branches = $this->Paginator->paginate();
             $page=$this->params['paging']['Branch']['pageCount'];
             $currentPage = $this->params['paging']['Branch']['page'];
             

            if (!empty($branches)) {
                $status = 1;
            } else {
                $status = 0;
            }
            
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "listBranches",
                "status" => $status,
                "pageCount" => $page,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );
//debug($output);
            $this->set('output', $output);
            $this->set('branches', $branches);

            $this->set(
                    array(
                        "_serialize" => array('branches', 'output'),
                        "_jsonp"=>true
                    )
            );
	}
        
        //list all branches name related to orgId
        public function listBranchesName($orgId = null) {
            $this->Branch->recursive = 0;
            $branches = $this->Branch->find('list', 
                            array(
                                'fields'=>array(
                                    'id', 'title'
                                    ), 
                                'conditions'=>array(
                                    'organization_id'=>$orgId)));
           
//debug($branches);
            if (!empty($branches)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "listBranchesName",
                "status" => $status,
                "error" => array("validation" => "")
            );

            $this->set('output', $output);
            $this->set('branches', $branches);

            $this->set(
                    array(
                        "_serialize" => array('branches', 'output')
                    )
            );
	}
        
        public function editBranch($id = null) {
		$this->Branch->Behaviors->load('Containable');
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
			if ($this->Branch->save($this->request->data)) {

                $this->loadModel('BranchUser');

                $conditions = array('BranchUser.branch_id'=>$this->request->data['Branch']['id'],
                                    'BranchUser.user_id'=>$this->request->data['Branch']['user_id']
                                    );

                if(!$this->BranchUser->hasAny($conditions) && $this->request->data['Branch']['user_id'] != 0)
                {
                    $this->BranchUser->create();

                    $data['BranchUser']['branch_id'] = $this->request->data['Branch']['id'];
                    $data['BranchUser']['user_id'] = $this->request->data['Branch']['user_id'];
                    $data['BranchUser']['status'] = 1;

                    $this->BranchUser->save($data);
                }
				$output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                      "action" => "editBranches",
                                       "status"=>1,
                                        //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Organization Branch Updated")
                                      );
			} else {
				$output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                      "action" => "editBranches",
                                       "status"=>0,
                                        //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Organization Branch Updated Fails. Please Try Again.")
                                      );
			}
                        
                        $this->set('output',$output);
			$this->set(
                                    array(
                                        "_serialize" =>array('output')
                                    )
                            );
                        
		} else {
			$options = array('conditions' => array('Branch.' . $this->Branch->primaryKey => $id), 'contain'=>array(
                'Organization.title',
                'User.fname',
                'User.lname'

                ));
			$branch = $this->Branch->find('first', $options);
                        $this->set('branch',$branch);
                        $this->set(
                                    array(
                                        "_serialize" =>array('branch')
                                    )
                            );
		}
		
	}
        
        public function viewBranch($id = null) {
            $this->Branch->Behaviors->load('Containable');
		if (!$this->Branch->exists($id)) {
			throw new NotFoundException(__('Invalid organization'));
		}
		$options = array(
                    'conditions' => array(
                        'Branch.' . $this->Branch->primaryKey => $id
                        ), 
                   // 'order' => array('Branch.id' => 'DESC'),
                    'contain'=>array(
                        'Country', 
                        'City', 
                        'Board'=>array('conditions'=>array('Board.status'=> 1),'order'=>array('Board.id'=>'DESC')), 
                        'User',
                        'Board.User', 
                        'ShiftBranch', 
                        'ShiftBranch.Shift',
                        'OrganizationUser'=>array('conditions'=>['OrganizationUser.status'=>3]),
                        'OrganizationUser.User'
                        ));
		$branch = $this->Branch->find('first', $options);
                
                 if (!empty($branch)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "viewBranch",
                "status" => $status,
                "error" => array("validation" => "")
            );
            
            $this->set('output', $output);
            $this->set('branch', $branch);

            $this->set(
                    array(
                        "_serialize" => array('branch', 'output'),
                        "_jsonp"=>true
                    )
            );
	}
        
        
        public function orgBranches($orgId = null) {
            $this->Branch->recursive = -1;
            $branches = $this->Branch->find('all', array('conditions'=>array('Branch.organization_id'=>$orgId)));
            // debug($branches);
            // die();
            if (!empty($branches)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "listBranches",
                "status" => $status,
                "error" => array("validation" => "")
            );

            $this->set('output', $output);
            $this->set('branches', $branches);

            $this->set(
                    array(
                        "_serialize" => array('branches', 'output')
                    )
            );
	}
        
        
        //list branches related to $orgId. this is only used for selectbox.
        public function BranchesList($orgId = null) {
            $this->Branch->recursive = 0;
            //$branches = $this->Branch->find('list', array('conditions'=>array('Branch.organization_id'=>$orgId)));
            
            $branches = $this->Branch->BranchesList($orgId);

            if (!empty($branches)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "listBranches",
                "status" => $status,
                "error" => array("validation" => "")
            );

            $this->set('output', $output);
            $this->set('branches', $branches);

            $this->set(
                    array(
                        "_serialize" => array('branches', 'output'),
                        "_jsonp"=>true
                    )
            );
	}
    // public function branchUserlist($orgId = null ,$branchId = null){
    //     //$this->Branch->Behaviors->load('Containable');
    //     $branches = $this->Branch->find('list',array(
    //             'fields' => 'Branch.id',
    //             'conditions' => array(
    //                     'Branch.organization_id' => $orgId
    //                 )
                
    //         ));
    //     $branchUser = $this->Branch->BranchUser->find('list',array(
    //             'fields' => 'BranchUser.user_id',
    //             'conditions' => array(
    //                     'BranchUser.branch_id' => $branches
    //                 )
                
    //         ));
    //     $orgUser = $this->Branch->find('all');
    //     debug($orgUser);
    // }
     public function createBranch($orgId = null,$createdUser = null) {
     
      if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
            $BranchUserId = $this->request->data['Branch']['user_id'];
            
                        //$this->request->data['Branch']['user_id'] = $userId;
            $this->request->data['Branch']['organization_id'] = $orgId;
            $this->request->data['Branch']['status'] = 1;
            $branchuser['BranchUser']['user_id'] = $this->request->data['Branch']['user_id'];
            $branchuser['BranchUser']['status'] = 1; 
            $this->request->data['Branch']['created_by'] = $createdUser;
            $this->Branch->create();

            $rule =  ['Branch.title'=>$this->request->data['Branch']['title'],'Branch.organization_id'=>$orgId];
            if($this->Branch->hasAny($rule)){
                $output= array( 
                       "params" =>$this->request,
                       "method"=>$this->method,
                      "action" => "createBranches",
                       "status"=>2,
                       //"user"=>$this->request->data,
                       "error"=>array("validation"=>"This branch already exist. Please Try Again")
                      );
            } else {
            if($BranchUserId == '0'){
                if ($this->Branch->save($this->request->data)) {
                    $branch_id = $this->Branch->id;
                   $branches = $this->Branch->find('all',array(
                        'conditions' => array(
                                'Branch.id' => $branch_id,
                                'Branch.organization_id' => $orgId
                            )
                    ));
                $output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                      "action" => "createBranches",
                                       "status"=>1,
                                        "id"=>$branch_id,
                                        "branch"=>$branches,
                                        //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Organization Branch Created")
                                      );
                } else {
                    $output= array( 
                                           "params" =>$this->request,
                                           "method"=>$this->method,
                                          "action" => "createBranches",
                                           "status"=>0,
                                           //"user"=>$this->request->data,
                                           "error"=>array("validation"=>"Fails Creating Organization Branche. Please Try Again")
                                          );
                }
            }
            else{
                if ($this->Branch->save($this->request->data)) {
                    $branchuser['BranchUser']['branch_id'] = $this->Branch->id;
                    $this->Branch->BranchUser->save($branchuser);
                     $branch_id = $this->Branch->id;          
                      $branches = $this->Branch->find('all',array(
                        'conditions' => array(
                                'Branch.id' => $branch_id,
                                'Branch.organization_id' => $orgId
                            )
                    ));      
                    $output= array( 
                                           "params" =>$this->request,
                                           "method"=>$this->method,
                                          "action" => "createBranches",
                                           "status"=>1,
                                            "id"=>$branch_id,
                                            "branch"=>$branches,
                                            //"user"=>$this->request->data,
                                           "error"=>array("validation"=>"Organization Branch Created")
                                          );
                } else {
                    $output= array( 
                                           "params" =>$this->request,
                                           "method"=>$this->method,
                                          "action" => "createBranches",
                                           "status"=>0,
                                           //"user"=>$this->request->data,
                                           "error"=>array("validation"=>"Fails Creating Organization Branche. Please Try Again")
                                          );
                }
            }
            } 
            $this->set('output',$output);
            $this->set(
                                    array(
                                        "_serialize" =>array('output')
                                    )
                            );
        }
    }
     public function orgBranchList($orgId = null) {
            $this->Branch->recursive = -1;
            $branchlist = $this->Branch->find('all', array('conditions'=>array('Branch.organization_id'=>$orgId)));
           
            $this->set('branchlist',$branchlist);
            $this->set(
                        array(
                            "_serialize" =>array('branchlist'),
                            "_jsonp"=>true
                        )
                );
        } 
    public function orgRelatedToBranch($orgId = null,$userId = null){
        $this->Branch->recursive = -1;
        $branch=$this->Branch->find('all',array(
                'conditions' => array(
                        'Branch.organization_id'=>$orgId,
                        'Branch.user_id' => $userId
                    )
            ));
        $this->set('branch',$branch);
            $this->set(
                    array(
                        "_serialize" =>array('branch'),
                        "_jsonp"=>true
                    )
            );
    } 
    public function inductionList($orgId)
    {
        $this->Branch->Behaviors->load('Containable');
        $inductionList =$this->Branch->find('all',array(
                'conditions' => array(
                        'Branch.organization_id' => $orgId
                    ),
                'contain' => array(
                        'Userinduction'=>array('conditions' =>array('Userinduction.status' => 2))
                    )
            ));
        $this->set('inductionList',$inductionList);
        $this->set(
                array(
                    "_serialize" =>array('inductionList')
                )
        );
    }
    public function inductionListofnotTodo($orgId)
    {
        $this->Branch->Behaviors->load('Containable');
        $inductionList =$this->Branch->find('all',array(
                'conditions' => array(
                        'Branch.organization_id' => $orgId
                    ),
                'contain' => array(
                        'Userinduction'=>array('conditions' =>array('Userinduction.status' => 1))
                    )
            ));
        $this->set('inductionList',$inductionList);
        $this->set(
                array(
                    "_serialize" =>array('inductionList')
                )
        );
    }
    public function inductionListofTodo($orgId)
    {
        $this->Branch->Behaviors->load('Containable');
        $inductionList =$this->Branch->find('all',array(
                'conditions' => array(
                        'Branch.organization_id' => $orgId
                    ),
                'contain' => array(
                        'Userinduction'=>array('conditions' =>array('Userinduction.status' => 0))
                    )
            ));
        $this->set('inductionList',$inductionList);
        $this->set(
                array(
                    "_serialize" =>array('inductionList')
                )
        );
    }
}

