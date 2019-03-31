<?php
App::uses('AppController', 'Controller');
/**
 * Boards Controller
 *
 * @property Board $Board
 * @property PaginatorComponent $Paginator
 */
class BoardsController extends AppController {

/**
 * Components
 *
 * @var array
 */
  public $components = array('Paginator');

        public function getBoardManagerWithBoardId($board_id = NULL){
            $boardDetail = $this->Board->boardDetail($board_id);
            
            $this->set('boardDetail',$boardDetail);
            $this->set(
                        array(
                            "_serialize" =>array('boardDetail')
                        )
                );
        }
        
        public function checkForBoardManager($user_id = NULL, $board_id = NULL){
            $check = $this->Board->checkForBoardManager($user_id, $board_id);
            $this->set('output', $check);
            $this->set(array('_serialize'=> array('output')));
        }
/**
 * index method
 *
 * @return void
 */
  public function index() {
    $this->Board->recursive = 0;
    $this->set('boards', $this->Paginator->paginate());
  }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
  public function view($id = null) {

    $this->Board->Behaviors->load('Containable');
    if (!$this->Board->exists($id)) {
      throw new NotFoundException(__('Invalid board'));
    }
    $options = array('conditions' => array('Board.' . $this->Board->primaryKey => $id),'contain'=>false);
    $this->set([
      'board'=>$this->Board->find('first', $options),
      '_serialize'=>['board'],
      '_jsonp'=>true

      ]);
  }

/**
 * add method
 *
 * @return void
 */
  public function add() {
    if ($this->request->is('post')) {
      $this->Board->create();
      if ($this->Board->save($this->request->data)) {
        $this->Session->setFlash(__('The board has been saved.'));
        return $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The board could not be saved. Please, try again.'));
      }
    }
    $organizations = $this->Board->Organization->find('list');
    $users = $this->Board->User->find('list');
    $branches = $this->Board->Branch->find('list');
    $this->set(compact('organizations', 'users', 'branches'));
  }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
  public function edit($id = null) {
    if (!$this->Board->exists($id)) {
      throw new NotFoundException(__('Invalid board'));
    }
    if ($this->request->is(array('post', 'put'))) {
      if ($this->Board->save($this->request->data)) {
        $this->Session->setFlash(__('The board has been saved.'));
        return $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The board could not be saved. Please, try again.'));
      }
    } else {
      $options = array('conditions' => array('Board.' . $this->Board->primaryKey => $id));
      $this->request->data = $this->Board->find('first', $options);
    }
    $organizations = $this->Board->Organization->find('list');
    $users = $this->Board->User->find('list');
    $branches = $this->Board->Branch->find('list');
    $this->set(compact('organizations', 'users', 'branches'));
  }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
  public function delete($id = null) {
    $this->Board->id = $id;
    if (!$this->Board->exists()) {
      throw new NotFoundException(__('Invalid board'));
    }
    $this->request->allowMethod('post', 'delete');
    if ($this->Board->delete()) {
      $this->Session->setFlash(__('The board has been deleted.'));
    } else {
      $this->Session->setFlash(__('The board could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
  }
        
        
        public function createBoard($orgId = null) {
    if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
                $boardUserId = $this->request->data['Board']['user_id'];
               
                $this->request->data['Board']['organization_id'] = $orgId;
                $this->request->data['Board']['status'] = 1;
                $boarduser['BoardUser']['user_id'] = $this->request->data['Board']['user_id'];
                $boarduser['BoardUser']['status'] = 1; 
                 $this->Board->create();
                if ($boardUserId == '0') {
                    if ($this->Board->save($this->request->data)) {
                        $output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                      "action" => "createBoard",
                                       "status"=>1,
                                        //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Board Created")
                                      );
                    }
                    else {
                        $output= array( 
                                               "params" =>$this->request,
                                               "method"=>$this->method,
                                              "action" => "createBoard",
                                               "status"=>0,
                                               //"user"=>$this->request->data,
                                               "error"=>array("validation"=>"Fails Creating Board. Please Try Again")
                                              );
                    }
                }
                else{
                
              if ($this->Board->save($this->request->data)) {
                                    $boarduser['BoardUser']['board_id'] = $this->Board->id;
                                    $this->Board->BoardUser->save($boarduser);
                $output= array( 
                                               "params" =>$this->request,
                                               "method"=>$this->method,
                                              "action" => "createBoard",
                                               "status"=>1,
                                                //"user"=>$this->request->data,
                                               "error"=>array("validation"=>"Board Created")
                                              );
              } else {
                $output= array( 
                                               "params" =>$this->request,
                                               "method"=>$this->method,
                                              "action" => "createBoard",
                                               "status"=>0,
                                               //"user"=>$this->request->data,
                                               "error"=>array("validation"=>"Fails Creating Board. Please Try Again")
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
        
        
        public function editBoard($id = null) {
    //$output1 = $this->request->data;
    if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {

    $this->Board->id = $id; 
                    if ($this->Board->save($this->request->data)) {

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
                                       "status"=>1,
                                        //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Fails Updating Board. Please Try Again")
                                      );
      }
                        
                         $this->set('output',$output);
      $this->set(
                                    array(
                                        "_serialize" =>array('output')
                                    )
                            );
                        
    } else {
                    $this->Board->recursive = -1;
      $options = array('conditions' => array('Board.' . $this->Board->primaryKey => $id));
      $board = $this->Board->find('first', $options);
                        
                         $this->set('board',$board);
      $this->set(
                                    array(
                                        "_serialize" =>array('board')
                                    )
                            );
    }
    
  }
        
        
        public function listBoards($orgId = null,$page = null)
        {
            //$this->Board->recursive = 1;
            $limit = 200;
            $this->Board->Behaviors->load('Containable');
            
            $this->paginate = array('conditions'=>array('Board.organization_id'=>$orgId, 'Board.status'=>1), 'contain'=>array('User', 'Branch', 'ShiftBoard.Shift.id', 'ShiftBoard.Shift.title','BoardUser'), 'limit'=>$limit, 'page'=>$page);

      
            $boards = $this->Paginator->paginate();
            $this->loadModel('BoardUser');
            $i = 0;

            foreach ($boards as $board) {
                $n = $this->BoardUser->find('count',array('conditions'=>['BoardUser.board_id' => $board['Board']['id']],'group' => 'BoardUser.user_id'));
                if (empty($n)){
                $boards[$i]['noOfBoardUser'] = 0;
              }
              else
              {
                $boards[$i]['noOfBoardUser'] = $n;

              }
              $i++;
            }
            $page=$this->params['paging']['Board']['pageCount'];
            $currentPage = $this->params['paging']['Board']['page'];
               // debug($boards);
               // die();        
            if (!empty($boards)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "listBoards",
                "status" => $status,
                "pageCount" => $page,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );

            $this->set('output', $output);
            $this->set('boards', $boards);

            $this->set(
                    array(
                        "_serialize" => array('boards', 'output'),
                        "_jsonp"=>true
                    )
            );
          }
        
        public function viewBoard($boardId = null, $page =1){
            $this->Board->Behaviors->load('Containable');
            $options = array('conditions' => array('Board.'. $this->Board->primaryKey => $boardId, 'Board.status'=>1), 'contain'=>array('User','Branch', 'ShiftBoard.Shift.id', 'ShiftBoard.Shift.title','BoardUser.User'));
              $board = $this->Board->find('first', $options);

              $this->paginate = array('conditions'=>['BoardUser.board_id'=>$boardId,'BoardUser.status'=>1],'limit'=>20, 'page'=>$page);
              $boardUsers = $this->paginate($this->Board->BoardUser);

                $page=$this->params['paging']['BoardUser']['pageCount'];
                $currentPage = $this->params['paging']['BoardUser']['page'];

                if (!empty($board)) {
                  $board['BoardUser'] = $boardUsers;
                    $status = 1;
                } else {
                    $status = 0;
                }
                $output = array(
                    "params" => $this->request,
                    "method" => $this->method,
                    "action" => "viewBoard",
                    "status" => $status,
                    "pageCount" => $page,
                    "currentPage" => $currentPage,
                    "error" => array("validation" => "")
                );

                $this->set('output', $output);
                $this->set('board', $board);

                $this->set(
                        array(
                            "_serialize" => array('board', 'output'),
                            "_jsonp"=>true
                        )
                );
        }
        
        public function getBranchIdFromBoardId($boardId = null){
            $branchId = $this->Board->find('list', array('fields'=>array('Board.branch_id'), 'conditions'=>array('Board.id'=>$boardId)));
               $branchId = current($branchId);
               //debug($branchId);die();
                if (!empty($branchId)) {
                    $status = 1;
                } else {
                    $status = 0;    
                }
                $output = array(
                    "params" => $this->request,
                    "method" => $this->method,
                    "action" => "getBranchIdFromboardId",
                    "status" => $status,
                    "error" => array("validation" => "")
                );

                $this->set('output', $output);
                $this->set('branchId', $branchId);

                $this->set(
                        array(
                            "_serialize" => array('branchId', 'output')
                        )
                );
        }
        
        public function getOrgIdFromBoardId($boardId = null){
            $branchId = $this->Board->find('list', array('fields'=>array('Board.branch_id'), 'conditions'=>array('Board.id'=>$boardId)));
               $orgId = $this->Board->Branch->find('list', array('fields'=>array('Branch.organization_id'), 'conditions'=>array('Branch.id'=>$branchId)));
                $org_Id = current($orgId);
                
               //debug($branchId);die();
                if (!empty($orgId)) {
                    $status = 1;
                } else {
                    $status = 0;    
                }
                $output = array(
                    "params" => $this->request,
                    "method" => $this->method,
                    "action" => "getOrgIdFromBoardId",
                    "status" => $status,
                    "error" => array("validation" => "")
                );

                $this->set('output', $output);
                $this->set('orgId', $org_Id);

                $this->set(
                        array(
                            "_serialize" => array('orgId', 'output')
                        )
                );
        }

        public function getBoardListOfBranch($branchId = null)
        {
           $boardList = $this->Board->find('all', array('conditions'=>array('Board.branch_id'=>$branchId, 'Board.status'=>1)));
           
                if (!empty($boardList)) {
                    $status = 1;
                } else {
                    $status = 0;    
                }
                $output = array(
                    "params" => $this->request,
                    "method" => $this->method,
                    "action" => "getBoardListOfBranch",
                    "status" => $status,
                    "error" => array("validation" => "")
                );

                $this->set('output', $output);
                $this->set('boardList', $boardList);

                $this->set(
                        array(
                            "_serialize" => array('boardList', 'output'),
                            "_jsonp"=>true
                        )
                ); 
        }
        public function createBoardWithInfo($orgId = null,$branchid = null)
        {
              $this->Board->Behaviors->load('Containable');
          
                if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
                {
                            $boardUserId = $this->request->data['Board']['user_id'];
                           
                            $this->request->data['Board']['organization_id'] = $orgId;
                            $this->request->data['Board']['status'] = 1;
                            $boarduser['BoardUser']['user_id'] = $this->request->data['Board']['user_id'];
                            $boarduser['BoardUser']['status'] = 1; 
                             $this->Board->create();
                            if ($boardUserId == '0') 
                            {
                                if ($this->Board->save($this->request->data)) 
                                {
                                    $boardId = $this->Board->getLastInsertId();
                                    $boardDetail = $this->Board->find('first',array(
                                      'conditions' => array(
                                          'Board.id' => $boardId
                                        ),
                                      'contain' => array(
                                          'User'
                                        )
                                    ));
                                  $folderImage = $this->webroot.'webroot/files/user/image/'.$boardDetail['User']['image_dir'].'/thumb2_'.$boardDetail['User']['image'];
                                  $image = $boardDetail['User']['image'];
                                  $gender = $boardDetail['User']['gender'];
                                  $genImage = 'webroot/files/user/image/'.$boardDetail['User']['image_dir'].'/thumb2_'.$boardDetail['User']['image'];
                                  $this->loadModel('User');
                                  $image =$this->User->checkImage($folderImage,$image,$gender,$genImage);
                                 
                                    $output= array( 
                                                   "params" =>$this->request,
                                                   "method"=>$this->method,
                                                  "action" => "createBoard",
                                                   "status"=>1,
                                                   "boardinfo"=>$boardDetail,
                                                   "image" => $image,
                                                    //"user"=>$this->request->data,
                                                   "error"=>array("validation"=>"Board Created")
                                                  );
                                }
                                else {
                                    $output= array( 
                                                           "params" =>$this->request,
                                                           "method"=>$this->method,
                                                          "action" => "createBoard",
                                                           "status"=>0,
                                                           //"user"=>$this->request->data,
                                                           "error"=>array("validation"=>"Fails Creating Board. Please Try Again")
                                                          );
                                }
                            }
                            else
                            {
                            
                                    if ($this->Board->save($this->request->data))
                                    {
                                        $boarduser['BoardUser']['board_id'] = $this->Board->id;
                                        $this->Board->BoardUser->save($boarduser);
                                        $boardId = $this->Board->getLastInsertId();
                                        $boardDetail = $this->Board->find('first',array(
                                                'conditions' => array(
                                                    'Board.id' => $boardId
                                                  ),
                                                'contain' => array(
                                                    'User'
                                                  )
                                              ));
                                        $folderImage = $this->webroot.'webroot/files/user/image/'.$boardDetail['User']['image_dir'].'/thumb2_'.$boardDetail['User']['image'];
                                        $image = $boardDetail['User']['image'];
                                        $gender = $boardDetail['User']['gender'];
                                        $genImage = 'webroot/files/user/image/'.$boardDetail['User']['image_dir'].'/thumb2_'.$boardDetail['User']['image'];
                                        $this->loadModel('User');
                                        $image =$this->User->checkImage($folderImage,$image,$gender,$genImage);

                                        $output= array( 
                                                         "params" =>$this->request,
                                                         "method"=>$this->method,
                                                        "action" => "createBoard",
                                                         "status"=>1,
                                                         "boardinfo"=>$boardDetail,
                                                         "image" => $image,
                                                          //"user"=>$this->request->data,
                                                         "error"=>array("validation"=>"Board Created")
                                                        );
                                    } 
                                    else 
                                    {
                                      $output= array( 
                                                     "params" =>$this->request,
                                                     "method"=>$this->method,
                                                    "action" => "createBoard",
                                                     "status"=>0,
                                                     //"user"=>$this->request->data,
                                                     "error"=>array("validation"=>"Fails Creating Board. Please Try Again")
                                                    );
                                    }
                            }
                                    
                              $this->set('output',$output);
                              $this->set(
                                                            array(
                                                                "_serialize" =>array('output'),
                                                                 "_jsonp" => true
                                                            )
                                                    );
                } 
        }
        public function createBoardwithdata($orgId = null)
        {
          $this->Board->Behaviors->load('Containable');
          
            if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) 
            {
                $boardUserId = $this->request->data['Board']['user_id'];

                $this->request->data['Board']['organization_id'] = $orgId;
                $this->request->data['Board']['status'] = 1;
                $boarduser['BoardUser']['user_id'] = $this->request->data['Board']['user_id'];
                $boarduser['BoardUser']['status'] = 1; 
                $this->Board->create();
                
                $rule = array('Board.branch_id'=>$this->request->data['Board']['branch_id'],'Board.title'=>$this->request->data['Board']['title']);
                if($this->Board->hasAny($rule)){
                  $output= array( 
                    "params" =>$this->request,
                    "method"=>$this->method,
                    "action" => "createBoard",
                    "status"=>2,
                    //"user"=>$this->request->data,
                    "error"=>array("validation"=>"Board already exist.")
                    );
                } else {  
                if ($boardUserId == '0') {
                  if ($this->Board->save($this->request->data)) {
                    $boardId = $this->Board->getLastInsertId();
                    $boards = $this->Board->find('all',array(
                      'conditions' => array(
                          'Board.organization_id' => $orgId,
                          'Board.id' => $boardId
                        ),
                      'contain' => array(
                          'User',
                          'Branch',
                          'ShiftBoard.Shift.id',
                          'ShiftBoard.Shift.title',
                          'BoardUser'
                        )
                    ));
                    $this->loadModel('BoardUser');
                    $i = 0;
                    foreach ($boards as $board) {
                        $n = $this->BoardUser->find('count',array('conditions'=>['BoardUser.board_id' => $board['Board']['id']],'group' => 'BoardUser.user_id'));
                        if (empty($n)){
                        $boards[$i]['noOfBoardUser'] = 0;
                      }
                      else
                      {
                        $boards[$i]['noOfBoardUser'] = $n;

                      }
                      $i++;
                    }
                    $output= array( 
                    "params" =>$this->request,
                    "method"=>$this->method,
                    "action" => "createBoard",
                    "status"=>1,
                    "boards"=>$boards,
                    //"user"=>$this->request->data,
                    "error"=>array("validation"=>"Board Created")
                    );
                  }
                  else {
                    $output= array( 
                    "params" =>$this->request,
                    "method"=>$this->method,
                    "action" => "createBoard",
                    "status"=>0,
                    //"user"=>$this->request->data,
                    "error"=>array("validation"=>"Fails Creating Board. Please Try Again")
                    );
                  }
                }
                else{
                  if ($this->Board->save($this->request->data)) {
                    $boarduser['BoardUser']['board_id'] = $this->Board->id;
                    $this->Board->BoardUser->save($boarduser);
                    $boardId = $this->Board->getLastInsertId();
                    $boards = $this->Board->find('all',array(
                      'conditions' => array(
                          'Board.organization_id' => $orgId,
                          'Board.id' => $boardId
                        ),
                      'contain' => array(
                          'User',
                          'Branch',
                          'ShiftBoard.Shift.id',
                          'ShiftBoard.Shift.title',
                          'BoardUser'
                        )
                    ));
                    $this->loadModel('BoardUser');
                    $i = 0;
                    foreach ($boards as $board) {
                        $n = $this->BoardUser->find('count',array('conditions'=>['BoardUser.board_id' => $board['Board']['id']],'group' => 'BoardUser.user_id'));
                        if (empty($n)){
                        $boards[$i]['noOfBoardUser'] = 0;
                      }
                      else
                      {
                        $boards[$i]['noOfBoardUser'] = $n;

                      }
                      $i++;
                    }

                    $output= array( 
                    "params" =>$this->request,
                    "method"=>$this->method,
                    "action" => "createBoard",
                    "status"=>1,
                    "boards"=>$boards,
                    //"user"=>$this->request->data,
                    "error"=>array("validation"=>"Board Created")
                    );
                  } else {
                    $output= array( 
                    "params" =>$this->request,
                    "method"=>$this->method,
                    "action" => "createBoard",
                    "status"=>0,
                    //"user"=>$this->request->data,
                    "error"=>array("validation"=>"Fails Creating Board. Please Try Again")
                    );
                  }
                }

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
        public function editBoardData($orgId = null,$boardId = null)
        {
            $this->loadModel('OrganizationUser');
           $orguser = $this->OrganizationUser->getOrgUsers($orgId);
           $this->loadModel('Branch');
           $branchList = $this->Branch->orgBranchList($orgId);
            $this->Board->Behaviors->load('Containable');
            $output = $this->Board->find('first',array(
                'conditions' => array(
                    'Board.id' => $boardId
                  ),
                'contain' => array(
                    'Branch',
                    'User',
                  )
              ));
            $this->set('orguser',$orguser);
            $this->set('branchList',$branchList);
           $this->set('output',$output);
            $this->set(
              array(
                "_serialize" =>array('orguser','branchList','output'),
                "_jsonp"=>true
              )
            );
        }
        public function editBoardwithdata($boardId = null , $orgid = null)
        {
            if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
                $rule = array('Board.organization_id'=>$orgid,'Board.title'=>$this->request->data['Board']['title'],'Board.id !='=>$boardId);
                $count = $this->Board->find('count',array(
                    'conditions'=>$rule
                  ));

                $this->Board->id = $boardId; 
                  if($count > 0){
                    $output = 2;
                  } else { 
                    if ($this->Board->save($this->request->data)) {
                      $output = 1;
                     }
                     else{
                      $output = 0;
                     }
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

      public function removeBoard($boardId = null)
      {
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
                $this->Board->id = $boardId; 
                    if ($this->Board->saveField('status', 0)) {
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
      
      public function getAllOrganizationBoards($orgId=null){
            $output = $this->Board->find("list",array('conditions'=>array('Board.organization_id'=>$orgId, 'Board.status'=>1),"fields"=>array("id","title")));
            $this->set(
                array(
                  "boards"=>$output,
                  "_serialize" =>array('boards'),
                  "_jsonp"=>true
                )
              );
      }

      public function getBoardUsersAndManagers($userId = null, $boardIds = null)
        {
            $this->Board->Behaviors->load('Containable');
            $this->Board->recursive = 2;
            $boardidlist = explode("_", $boardIds);

            $data1 = array();
            $data2 = array();
            $data3 = array();
            $orgId = array();

            foreach ($boardidlist as $bId)
            {

              $conditions = array('Board.user_id'=>$userId, 'Board.id'=> $bId,'Board.status'=>1);

              if($this->Board->hasAny($conditions))
              {

                $options = array(
                  'conditions'=>['Board.id'=>$bId,'Board.status'=>1],
                  'contain'=>['Organization.id', 'BoardUser.User'=>['conditions'=>['User.id !='=>$userId],'fields'=>['id','fname','lname', 'image', 'image_dir', 'imagepath', 'email']]]);


                $data = $this->Board->find('first', $options);
                $orgId[] = $data['Organization']['id'];

                foreach ($data['BoardUser'] as $value) {
                  if(isset($value['User']) && !empty($value['User']))
                  {
                    $data1[] = $value['User'];
                  }
                }
              }
              else
              {
                $options = array(
                  'conditions'=>['Board.id'=>$bId,'Board.status'=>1],
                  'contain'=>['User'=>['fields'=>['id','fname','lname', 'image', 'image_dir', 'imagepath', 'email']]],
                  );

                $data = $this->Board->find('first', $options);

               if (isset($data) && !empty($data)) {
                  $data2[] = $data['User'];
               }

              }
            }
            $data = array_merge($data1, $data2);
            $options = array(
                  'conditions'=>['Board.organization_id'=>$orgId,'Board.status'=>1, 'Board.user_id !='=>$userId],
                  'contain'=>['User'=>['fields'=>['id','fname','lname', 'image', 'image_dir', 'imagepath', 'email']]],
                  );

            $data3 = $this->Board->find('all', $options);

            $data = "";
            foreach ($data3 as $value) {
              if(!is_null($value['User']['id']))
              {
                $data[] = $value['User'];
              }
            }

            $finalData = $this->unique_multidim_array($data, 'id');

            $output = 0;
            if (isset($data) && !empty($data))
            {
                $output = 1;
            }

            $this->set(array(
                    'output'=>$output,
                    'list'=>$finalData,
                    '_serialize'=>['output', 'list'],
                    '_jsonp' => true
                ));


        }

        public function unique_multidim_array($array, $key) { 
                            $temp_array = array(); 
                            $i = 0; 
                            $key_array = array(); 
                            
                            foreach($array as $val) { 
                                if (!in_array($val[$key], $key_array)) { 
                                    $key_array[$i] = $val[$key]; 
                                    $temp_array[$i] = $val; 
                                } 
                                $i++; 
                            } 
                            return $temp_array; 
                        }

      public function getBoardOfOrg($orgId = null)
      {
        // $this->Board->recursive = 2;
        $this->Board->Behaviors->load('Containable');
        $options = array(
          'conditions'=>['Board.organization_id'=>$orgId],
          'contain'=>['ShiftBoard','ShiftBoard.Shift']
          );

        $list = $this->Board->find('all', $options);

        $this->set(array(
                    'list'=>$list,
                    '_serialize'=>['list'],
                    '_jsonp' => true
                ));
      }

      public function getBoards()
      {
        // $this->Board->recursive = 2;
        $this->Board->Behaviors->load('Containable');

        $options = array(
          'conditions'=>['Board.id'=>$this->request->data],
          'contain'=>['ShiftBoard','ShiftBoard.Shift']
          );

        $list = $this->Board->find('all', $options);

        $this->set(array(
                    'list'=>$list,
                    '_serialize'=>['list'],
                    '_jsonp' => true
                ));
      }

}
