<?php
App::uses('AppController', 'Controller');
/**
 * BoardUsers Controller
 *
 * @property BoardUser $BoardUser
 * @property PaginatorComponent $Paginator
 */
class BoardUsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'RequestHandler');
	
	public function beforeFilter() {
            parent::beforeFilter();
			//$this->Auth->allow(array('addUserInShift'));
            
        }
        
        public function myOrgBranchBoardDetail($board_id = NULL){
            $myOrgBranchBoardDetail = $this->BoardUser->myOrgBranchBoardDetail($board_id);
            
            $this->set(array(
                    'myOrgBranchBoardDetail' => $myOrgBranchBoardDetail,
                    '_serialize' => array('myOrgBranchBoardDetail')
                
                ));
        }
        
        public function myOrgBranchBoard($user_id = NULL, $orgId = NULL, $branch_id = NULL){
           $myOrgBranchBoard = $this->BoardUser->myOrgBranchBoard($user_id, $orgId, $branch_id);
           // debug($myOrgBranchBoard);
            $this->set(array(
                    'myOrgBranchBoard' => $myOrgBranchBoard,
                    '_serialize' => array('myOrgBranchBoard')
                
                ));	
            
             
        }
        
        
        public function boardEmployeeList($board_id){
		$this->loadModel('OrganizationUser');
        //debug($user);
		$userInBoard = $this->BoardUser->find('all', array('conditions'=>array('BoardUser.board_id'=>$board_id, 'BoardUser.status'=>1), 'fields'=>array('BoardUser.id','Board.id', 'Board.title','User.id', 'User.fname', 'User.lname', 'User.imagepath', 'User.gender')));
                $output= array("employeeList" => $userInBoard);
                //debug($output);
                $count = 0;
                foreach($output['employeeList'] as $u){
                    $userId = $u['User']['id'];
                    if($this->OrganizationUser->hasAny(['user_id'=>$userId,'status'=>3])){
                        $user['employeeList'][$count] =  $this->OrganizationUser->find('first',array('conditions'=>array('OrganizationUser.user_id'=>$userId,'OrganizationUser.status'=>3),'fields'=>array('User.id','User.fname',"User.lname", "User.imagepath", "User.gender")));
                        $count++;
                    }    
                }
            
                $this->set(array(
                    'message' => $user,
                    '_serialize' => array('message'),
                    '_jsonp'=>true
                
                ));	
		
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->BoardUser->recursive = 0;
		$this->set('boardUsers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->BoardUser->exists($id)) {
			throw new NotFoundException(__('Invalid board user'));
		}
		$options = array('conditions' => array('BoardUser.' . $this->BoardUser->primaryKey => $id));
		$this->set('boardUser', $this->BoardUser->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->BoardUser->create();
			if ($this->BoardUser->save($this->request->data)) {
				$this->Session->setFlash(__('The board user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The board user could not be saved. Please, try again.'));
			}
		}
		$boards = $this->BoardUser->Board->find('list');
		$users = $this->BoardUser->User->find('list');
		$this->set(compact('boards', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->BoardUser->exists($id)) {
			throw new NotFoundException(__('Invalid board user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->BoardUser->save($this->request->data)) {
				$this->Session->setFlash(__('The board user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The board user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('BoardUser.' . $this->BoardUser->primaryKey => $id));
			$this->request->data = $this->BoardUser->find('first', $options);
		}
		$boards = $this->BoardUser->Board->find('list');
		$users = $this->BoardUser->User->find('list');
		$this->set(compact('boards', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->BoardUser->id = $id;
		if (!$this->BoardUser->exists()) {
			throw new NotFoundException(__('Invalid board user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->BoardUser->delete()) {
			$this->Session->setFlash(__('The board user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The board user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function assignEmployeeToBoard($boardId = null){
            if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
                
                //managing array for saveMany function
                foreach($this->request->data['BoardUser']['user_id'] as $boardUsers):
                    $data[] = array('board_id'=>$boardId, 'user_id'=>$boardUsers, 'status'=>1);
                endforeach;
               
                if ($this->BoardUser->saveMany($data)) {
                foreach($this->request->data['BoardUser']['user_id'] as $boardUsers):
                    //$this->BoardUser->emailToEmployee($boardUsers,$boardId);
                endforeach;
                 $output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                       "action" => "assignEmployeeToBoard",
                                       "status"=>1,
                                       //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Employees assigned to Board.")
                                      );
			} else {
				$output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                       "action" => "assignEmployeeToBoard",
                                       "status"=>0,
                                       //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Employees Assign to Board Fails. Please Try Again.")
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
        
        
        public function listBoardEmployees($boardId = null){
            //$boardUsers = $this->BoardUser->find('all', array('conditions'=>array('BoardUser.board_id'=>$boardId)));
            $limit = 20;
            $this->paginate = array('conditions'=>array('BoardUser.board_id'=>$boardId, 'BoardUser.status'=>1), 'limit'=>$limit);
      
            $boardUsers = $this->Paginator->paginate();
            $page=$this->params['paging']['BoardUser']['pageCount'];
            $currentPage = $this->params['paging']['BoardUser']['page'];
            

            if (!empty($boardUsers)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "listBoardEmployees",
                "status" => $status,
                "pageCount" => $page,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );

            $this->set('output', $output);
            $this->set('boardUsers', $boardUsers);

            $this->set(
                    array(
                        "_serialize" => array('boardUsers', 'output')
                    )
            );
        }


        public function getBoardRelatedUsers($boardIds=null, $userId)
        {
            $this->BoardUser->Behaviors->load('Containable');
            $boardIdArr = explode('_', $boardIds);

            $limit = 20;
            $this->paginate = array(
                'conditions'=>array('BoardUser.board_id'=>$boardIdArr, 'not'=>array('BoardUser.user_id'=>$userId), 'BoardUser.status'=>1),
                 'limit'=>$limit,
                 'group'=>'BoardUser.user_id'
                 );
      
            $boardUsers = $this->Paginator->paginate();
            $page=$this->params['paging']['BoardUser']['pageCount'];
            $currentPage = $this->params['paging']['BoardUser']['page'];

            if (!empty($boardUsers)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "listBoardEmployees",
                "status" => $status,
                "pageCount" => $page,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );

            $this->set('output', $output);
            $this->set('boardUsers', $boardUsers);

            $this->set(
                    array(
                        "_serialize" => array('boardUsers', 'output')
                    )
            );
        }

        public function removeEmployee($boardUserId = null)
        {
            if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
                $this->BoardUser->id = $boardUserId; 
                    if ($this->BoardUser->saveField('status', 0)) {
                      $output = 1;
                     }
                     else{
                      $output = 0;
                     }
               $this->set('output',$output);
              $this->set(
                array(
                  "_serialize" =>array('output'),
                  "_jsonp"=>true
                )
              );
        }
        }


        public function getRelatedBoardOfUser($userId = null)
        {
            $options = array('conditions'=>['BoardUser.user_id'=>$userId, 'BoardUser.status'=>1]);

            $listBoards = $this->BoardUser->find('all', $options);

            if(isset($listBoards) && !empty($listBoards))
            {
                $status = 1;
                $boardIds = array();
                foreach ($listBoards as $board) {
                    $boardIds[] = $board['Board']['id'];
                }

                $this->set(array(
                'boardUser'=>$listBoards,
                'status'=>$status,
                'boardIds'=>$boardIds,
                '_serialize'=>['boardUser', 'status','boardIds'],
                '_jsonp'=>true
                ));
            }else
            {
                $status = 0;

                $this->set(array(
                'boardUser'=>$listBoards,
                'status'=>$status,
                '_serialize'=>['boardUser', 'status'],
                '_jsonp'=>true
                ));
            }
            
        }

        public function getUserBoard($userId = null){
            $this->BoardUser->recursive = -1;
            $result=$this->BoardUser->find("all",array("conditions"=>array("BoardUser.user_id"=>$userId,"BoardUser.status"=>1),"fields"=>array("board_id")));
            $this->set(array(
                "Boards"=>$result,
                "_serialize"=>array("Boards"),
                "_jsonp"=>true
            ));

        }

        public function filterByDepartment($departmentId,$name){
            $output = $this->BoardUser->filterByDepartment($departmentId,$name);
            $this->set(array(
                    'output'=>$output,
                    '_serialize'=>'output'
                ));
        }

        public function findBoardOfUser($userId,$branchId){
            $output = $this->BoardUser->findBoardOfUser($userId,$branchId);
            $this->set(array(
                    'output'=>$output,
                    '_serialize'=>'output'
                ));
        }

        public function myBoardDetail($userId = null){
            $output = $this->BoardUser->myBoardDetail($userId);
            
            $this->set(array(
                'output'=>$output,
                '_serialize'=>'output'
                ));
        }

        public function getBoardManager($boardId = null)
        {
            $output = $this->BoardUser->getBoardManager($boardId);
            
            $this->set(array(
                'output'=>$output,
                '_serialize'=>'output',
                '_jsonp'=>true
                ));
        }
}
