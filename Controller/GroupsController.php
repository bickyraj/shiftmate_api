<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 * @property PaginatorComponent $Paginator
 */
class GroupsController extends AppController {

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
		$this->Group->recursive = 0;
		$this->set('groups', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}
		$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
		$this->set('group', $this->Group->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Group->create();
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
		}
		$organizations = $this->Group->Organization->find('list');
		$this->set(compact('organizations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
			$this->request->data = $this->Group->find('first', $options);
		}
		$organizations = $this->Group->Organization->find('list');
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
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Group->delete()) {
			$this->Session->setFlash(__('The group has been deleted.'));
		} else {
			$this->Session->setFlash(__('The group could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        
        public function createGroup($orgId = null) {
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
			$this->Group->create();
                        $this->request->data['Group']['organization_id'] = $orgId;
                        $this->request->data['Group']['status'] = 1;
			if ($this->Group->save($this->request->data)) {
				$output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                      "action" => "createGroup",
                                       "status"=>1,
                                        //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Group Created")
                                      );
			} else {
				$output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                      "action" => "createGroup",
                                       "status"=>0,
                                       //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Fails Creating Group. Please Try Again")
                                      );
			}
                        
                        $this->set('output',$output);
			$this->set(
                                    array(
                                        "_serialize" =>array('output')
                                    )
                            );
		}
		
	}
        
        public function editGroup($GroupId = null) {
            $this->Group->recursive = -1;
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Group->save($this->request->data)) {
				$output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                      "action" => "editGroup",
                                       "status"=>1,
                                        //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Group Updated")
                                      );
			} else {
				$output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                      "action" => "editGroup",
                                       "status"=>0,
                                       //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Fails Updating Group. Please Try Again")
                                      );
			}
                         $this->set('output',$output);
			$this->set(
                                    array(
                                        "_serialize" =>array('output')
                                    )
                            );
                        
		} else {
			$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $GroupId));
			$group = $this->Group->find('first', $options);
                        $this->set('group',$group);
			$this->set(
                                    array(
                                        "_serialize" =>array('group')
                                    )
                            );
		}
		
	}
        
        public function listGroups($orgId = null,$page=1){
            $this->Group->recursive = 1;
            $limit = 20;
            $this->Group->Behaviors->load('Containable');
            $this->paginate = array('conditions'=>array('Group.organization_id'=>$orgId), 'limit'=>$limit,'page'=>$page);
            $groups = $this->Paginator->paginate();

            $this->loadModel('UserGroup');

            $i=0;
            foreach ($groups as $group) {

              
              $n= $this->UserGroup->find('count', array('conditions'=>['UserGroup.group_id'=>$group['Group']['id']], 'group'=>'UserGroup.user_id'));
              if(empty($n))
              {

                $groups[$i]['UserCount'] = 0;
              }
              else
              {
                $groups[$i]['UserCount'] = $n;

              }
              $i++;
            }
            
            $page=$this->params['paging']['Group']['pageCount'];
            $currentPage = $this->params['paging']['Group']['page'];
            
            if (!empty($groups)){
                    $status = 1;
                }else{
                    $status = 0;
                }

            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "listGroup",
                "status" => $status,
                "pageCount" => $page,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );
            // debug($groups);
            // die();
            $this->set('groups', $groups);
            $this->set('output', $output);

            $this->set(
                    array(
                        "_serialize" => array('groups', 'output')
                    )
            );
        }
        
        public function getOrgIdFromGroupId($groupId = null){
            $organizationId = $this->Group->find('list', array('fields'=>array('organization_id'), 'conditions'=>array('Group.id'=>$groupId)));
            $orgId = current($organizationId);
            
            if (!empty($orgId)){
                    $status = 1;
                }else{
                    $status = 0;
                }

            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "getOrgIdFromGroupId",
                "status" => $status,
                "error" => array("validation" => "")
            );
            $this->set('orgId', $orgId);
            $this->set('output', $output);

            $this->set(
                    array(
                        "_serialize" => array('orgId', 'output')
                    )
            );
                    
            
        }

        public function findUserOfGroup($orgId = null){

          $user = $this->Group->findUserOfGroup($orgId);

          $this->set(array(

            'user'=>$user,
            '_serialize'=>'user'
            ));

        }  

        public function listGroup($orgId=null){

          $group = $this->Group->listGroup($orgId);

          $this->set(array(
            'group'=>$group,
            '_serialize'=>'group'
            ));
        }
        public function getGroup($group_id = null)
        {
          $this->Group->recursive = -1;
          $groupList = $this->Group->find('first',array(
                'conditions' => array(
                    'Group.id' => $group_id
                  )
            ));  
          $this->set(array(
            'group'=>$groupList,
            '_serialize'=>'group'
            ));
        }
        public function createGroupWithData($orgId = null)
        {
          $this->Group->recursive = -1;
          
            if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
                $this->Group->create();
                $this->request->data['Group']['organization_id'] = $orgId;
                $this->request->data['Group']['status'] = 1;
                $rule = array('Group.organization_id'=>$orgId,'Group.title'=>$this->request->data['Group']['title']); 

                if($this->Group->hasAny($rule)){
                  $output= array( 
                        "params" =>$this->request,
                        "method"=>$this->method,
                        "action" => "createGroup",
                        "status"=>2,
                        //"user"=>$this->request->data,
                        "error"=>array("validation"=>"Group Created")
                        );
                } else {   
                    if ($this->Group->save($this->request->data)) 
                    {
                      $groupId = $this->Group->getLastInsertId();
                      $group = $this->Group->find('first',array('conditions' => array('Group.id'=>$groupId)));
                        $output= array( 
                        "params" =>$this->request,
                        "method"=>$this->method,
                        "action" => "createGroup",
                        "status"=>1,
                        "group" => $group,
                        //"user"=>$this->request->data,
                        "error"=>array("validation"=>"Group Created")
                        );
                    } else 
                    {
                        $output= array( 
                        "params" =>$this->request,
                        "method"=>$this->method,
                        "action" => "createGroup",
                        "status"=>0,
                        //"user"=>$this->request->data,
                        "error"=>array("validation"=>"Fails Creating Group. Please Try Again")
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
        public function editGroupData($orgId = null,$groupId = null)
        {
          $this->Group->recursive = -1;
          $groupData = $this->Group->find('first',array(
            'conditions' => array(
                'Group.id' => $groupId,
                'Group.organization_id' => $orgId
              )
            ));
          $this->set('output',$groupData);
          $this->set(
                  array(
                  "_serialize" =>array('output')
                  )
                );
        }
        public function editGroupwithdata($orgId = null,$GroupId = null){
            if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {

              $this->Group->id = $GroupId; 
              $rule = array('Group.organization_id'=>$orgId,'Group.title'=>$this->request->data['Group']['title']);
              if($this->Group->hasAny($rule)){
                $output= array( 
                               "params" =>$this->request,
                               "method"=>$this->method,
                              "action" => "editBoard",
                               "status"=>2,
                                //"user"=>$this->request->data,
                               "error"=>array("validation"=>"Group already exist")
                              );
              } else {
              if ($this->Group->save($this->request->data)) {

                  $output= array( 
                               "params" =>$this->request,
                               "method"=>$this->method,
                              "action" => "editBoard",
                               "status"=>1,
                                //"user"=>$this->request->data,
                               "error"=>array("validation"=>"Board Updated")
                              );
                  } else {
                    $output= array( 
                                 "params" =>$this->request,
                                 "method"=>$this->method,
                                "action" => "editBoard",
                                 "status"=>0,
                                  //"user"=>$this->request->data,
                                 "error"=>array("validation"=>"Fails Updating Board. Please Try Again")
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
}
