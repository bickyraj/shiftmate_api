<?php
App::uses('AppController', 'Controller');
/**
 * UserGroups Controller
 *
 * @property UserGroup $UserGroup
 * @property PaginatorComponent $Paginator
 */
class UserGroupsController extends AppController {

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
		$this->UserGroup->recursive = 0;
		$this->set('userGroups', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserGroup->exists($id)) {
			throw new NotFoundException(__('Invalid user group'));
		}
		$options = array('conditions' => array('UserGroup.' . $this->UserGroup->primaryKey => $id));
		$this->set('userGroup', $this->UserGroup->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserGroup->create();
			if ($this->UserGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The user group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user group could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserGroup->User->find('list');
		$groups = $this->UserGroup->Group->find('list');
		$this->set(compact('users', 'groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserGroup->exists($id)) {
			throw new NotFoundException(__('Invalid user group'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The user group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user group could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserGroup.' . $this->UserGroup->primaryKey => $id));
			$this->request->data = $this->UserGroup->find('first', $options);
		}
		$users = $this->UserGroup->User->find('list');
		$groups = $this->UserGroup->Group->find('list');
		$this->set(compact('users', 'groups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserGroup->id = $id;
		if (!$this->UserGroup->exists()) {
			throw new NotFoundException(__('Invalid user group'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UserGroup->delete()) {
			$this->Session->setFlash(__('The user group has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user group could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function getEmployeeListNotInGroup($groupId = null, $orgId = null){
             $this->UserGroup->Group->Organization->OrganizationUser->Behaviors->load('Containable');
             
             //get list of users in group
             $groupUsers = $this->UserGroup->find('list', array('fields'=>array('user_id'), 'conditions'=>array('UserGroup.group_id'=>$groupId)));
           
             // get list of organization users not assigned in group.
             $orgUsersNotInGroup = $this->UserGroup->Group->Organization->OrganizationUser->find('all', array('conditions'=>array('OrganizationUser.organization_id'=>$orgId,'OrganizationUser.status'=>3, 'NOT'=>array('OrganizationUser.user_id'=>$groupUsers)), 'contain'=>array('User')));
                
             if (!empty($orgUsersNotInGroup)) {
                 $status = 1;
             } else {
                 $status = 0;
             }
             $output = array(
                 "params" => $this->request,
                 "method" => $this->method,
                 "action" => "getEmployeeListNotInGroup",
                 "status" => $status,
                 "error" => array("validation" => "")
             );

             $this->set('output', $output);
             $this->set('orgUsersNotInGroup', $orgUsersNotInGroup);

             $this->set(
                     array(
                         "_serialize" => array('orgUsersNotInGroup', 'output')
                     )
             );
        }
        
        public function assignEmployeeToGroup($groupId = null){
            if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
                
                //managing array for saveMany function
                foreach($this->request->data['UserGroup']['user_id'] as $groupUsers):
                    $data[] = array('group_id'=>$groupId, 'user_id'=>$groupUsers, 'status'=>'1');
                endforeach;
                
                if ($this->UserGroup->saveMany($data)) {
				 $output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                       "action" => "assignEmployeeToGroup",
                                       "status"=>1,
                                       //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Employees assigned to Group.")
                                      );
			} else {
				$output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                       "action" => "assignEmployeeToGroup",
                                       "status"=>0,
                                       //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Employees Assign to Group Fails. Please Try Again.")
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
        
        public function listEmployeesInGroup($groupId = null,$page=1){
            //$userGroups = $this->UserGroup->find('all', array('conditions'=>array('UserGroup.group_id'=>$groupId)));
            
            $limit = 20;
            $this->paginate = array('conditions'=>array('UserGroup.group_id'=>$groupId), 'limit'=>$limit,'page'=>$page);
            $userGroups = $this->Paginator->paginate();
            
            $page=$this->params['paging']['UserGroup']['pageCount'];
            $currentPage = $this->params['paging']['UserGroup']['page'];
            
            
            if (!empty($userGroups)){
                    $status = 1;
                }else{
                    $status = 0;
                }

            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "listEmployeesInGroup",
                "status" => $status,
                "pageCount" => $page,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );
            $this->set('userGroups', $userGroups);
            $this->set('output', $output);

            $this->set(
                    array(
                        "_serialize" => array('userGroups', 'output')
                    )
            );
        }
        
        public function listAllEmployeeInGroup($groupID=null){
            $result=$this->UserGroup->listAllEmployeesInGroup($groupID);
            $this->set(array(
                'allInGroup'=>$result,
                '_serialize'=>array('allInGroup'),
                '_jsonp'=>true
            ));
        }

        //manohar
        public function findGroupOfUser($userId = null){

            $group = $this->UserGroup->findGroupOfUser($userId);

            $this->set(array(
                'group' => $group,
                '_serialize' => 'group'
                ));

        }  

        public function findAllUserOfGroup($groupId = null){

            
            $user =  $this->UserGroup->findAllUserOfGroup($groupId);

            $this->set(array(
                'user'=>$user,
                '_serialize'=>'user'
                ));

        }  
}
