<?php
App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');
/**
 * BoardUser Model
 *
 * @property Board $Board
 * @property User $User
 */
class BoardUser extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'board_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Board' => array(
			'className' => 'Board',
			'foreignKey' => 'board_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        public function myBoard($user_id = NULL, $orgId = NULL){
            $myBoard = $this->find('all', array(
                'conditions'=>array(
                    'BoardUser.user_id' => $user_id,
                    'BoardUser.organization_id' => $orgId,
                    'BoardUser.status'=>1
                    )
            ));
            return $myBoard;
        }
        
        public function boardInBranch($orgId = NULL, $branch_id = NULL){
            $boardInBranch = $this->Board->find('all', array(
                'conditions' => array(
                    'Board.organization_id' => $orgId,
                    'Board.branch_id' => $branch_id,
                    'Board.status'=>1
                )
            ));
           return $boardInBranch;
        }
        
        public function myOrgBranchBoard($user_id = NULL, $orgId = NULL, $branch_id = NUll){
            $boardInBranch = $this->boardInBranch($orgId, $branch_id);
            foreach($boardInBranch as $boardInBranches){
                $board_id[] = $boardInBranches['Board']['id'];
               
            }
             $myOrgBranchBoard = $this->find('all', array(
                    'conditions'=>array(
                        'BoardUser.user_id'=>$user_id,
                        'BoardUser.board_id' => $board_id,
                        'BoardUser.status'=>1
                    )
                ));
            return $myOrgBranchBoard;
        }
        
        public function myOrgBranchBoardDetail($board_id = NULL){
            $myOrgBranchBoardDetail = $this->find('all', array(
                'conditions' => array(
                    'BoardUser.board_id' => $board_id,
                    'BoardUser.status' => 1
                )
            ));
            
            return $myOrgBranchBoardDetail;
        }

        
        public function listUserFromBoardId($boardId=null){


		$UserId = $this->find('all',array(
			'conditions' => array('BoardUser.board_id'=>$boardId, 'BoardUser.status'=>1),
			'fields' => array('BoardUser.user_id')
			));
		return $UserId;
		//debug($UserId);
	}

	 	public function filterByDepartment($departmentId = null,$name = null){
        	$this->Behaviors->load('Containable');
        	$names = explode(" ",$name);
        	$contain = array('User'=>array('fields'=>array('id','fname','lname','email','image','imagepath','image_dir','image_size','gender','address','phone')));
        	
        	foreach($names as $n){
        		$conditions = array('BoardUser.board_id'=>$departmentId,'BoardUser.status'=>1,"OR"=>['User.fname LIKE' => $n.'%','User.lname LIKE' => $n.'%']);

        	}
        	
        	$results = $this->find('all',array(
        		'contain'=>$contain,
        		'conditions'=>$conditions
        		));
        	return $results;
        }

        // to find departments of user
        public function findBoardOfUser($userId = null,$branchId){
            $this->Behaviors->load('Containable');
            $conditions = array('BoardUser.user_id'=>$userId);
            $contain = array('Board','User'=>array('fields'=>['id','fname','lname']),'Board.Branch'=>array('fields'=>['id','title']));
            $results = $this->find('all',array(
                'conditions'=>$conditions,
                'recursive'=>2,
                'contain'=>$contain
                ));

            $departments = array();
            foreach($results as $k=>$r){
                if($branchId == $r['Board']['Branch']['id']){
                    $departments['board_list'][$k]['board_title'] = $r['Board']['title'];
                    $departments['board_list'][$k]['board_id'] = $r['Board']['id'];
                }
            }
            
            return $departments;
        }

        // to find all branch of user
        public function findBranchOfUser($userId){
            $this->Behaviors->load('Containable');
            $conditions = array('BoardUser.user_id'=>$userId);
            $contain = array('Board'=>['fields'=>['id']],'Board.Branch'=>array('fields'=>['id','title']));
            
            $results = $this->find('all',array(
                'conditions'=>$conditions,
                'recursive'=>2,
                'contain'=>$contain
                ));

            
            $branch = array();
            foreach($results as $k=>$r){
                $branch['Branch'][$r['Board']['branch_id']] = $r['Board']['Branch'];
            }

            return $branch;
        }

    public function emailToEmployee($userId = null,$boardId = null)
    {
        $this->Behaviors->load('Containable');
        $userinfo = $this->find('first',array(
                'conditions' =>array(
                        'BoardUser.user_id' => $userId,
                        'BoardUser.board_id' => $boardId
                    ),
                'contain' => array(
                    'User',
                    )
            ));

        $Email = new CakeEmail();
        $Email->template('email_for_user_addedto_board')
                    ->emailFormat('html')
                    ->to($userinfo['User']['email'])
                    ->from(array('noreply@shiftmate.com.au' => 'Shiftmate'))
                    ->subject('Appointment To Board')
                    ->viewVars(array('userinfo' => $userinfo));
        return $Email->send();
    }

    public function myBoardDetail($user_id = NULL){
            
            $this->Behaviors->load('Containable');
            $contain = array('Board','Board.Organization'=>['id','title'],'Board.User'=>['fname','lname','status'],'Board.Branch'=>['id','title']);
            $myBoard = $this->find('all', array(
                'conditions'=>array(
                    'BoardUser.user_id' => $user_id,
                    'BoardUser.status'=>1
                    ),
                'contain'=>$contain
            ));

            $boards = array();
            if(isset($myBoard) && !empty($myBoard)){
                foreach($myBoard as $key=>$b){
                    $noOfEmployee =  $this->find('count',array(
                        'conditions'=>array('BoardUser.board_id'=>$b['BoardUser']['board_id'])
                        ));

                    $boards[$b['Board']['Organization']['title']][$key] = $b['Board'];
                    $boards[$b['Board']['Organization']['title']][$key]['noOfEmployee']  = $noOfEmployee;
                    
                    $myBoard[$key]['noOfEmployee'] = $noOfEmployee;
                }
            }

            return $boards;
        }

    public function getBoardsOfUser($userId = null)
    {
        $this->Behaviors->load('Containable');
            $myBoard = $this->find('all', array(
                'conditions'=>array(
                    'BoardUser.user_id' => $userId,
                    'BoardUser.status'=>1
                    ),
                'contain'=>false
            ));

            return $myBoard;
    }

    public function getBoardManager($boardId = null)
    {
        // $this->Behaviors->load('Containable');
        $this->recursive = -1;
            $boardManager = $this->find('first', array(
                'conditions'=>array(
                    'BoardUser.board_id' => $boardId,
                    'BoardUser.status'=>1
                    ),
                'fields'=>'user_id'
            ));

            return $boardManager;
    }

}
