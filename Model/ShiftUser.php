<?php
App::uses('AppModel', 'Model');
/**
 * ShiftUser Model
 *
 * @property Board $Board
 * @property Shift $Shift
 * @property User $User
 */
class ShiftUser extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'organization_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
		'shift_id' => array(
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
		'date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'check_status' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'earlytime' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'latetime' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'latestatus' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'check_in_time' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'check_out_time' => array(
			'datetime' => array(
				'rule' => array('datetime'),
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
        'managernotifications' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'orgnotifications' => array(
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
		'Shift' => array(
			'className' => 'Shift',
			'foreignKey' => 'shift_id',
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
		),
  /* ********************** Ashok Neupane *********************** */
        'Organization' => array(
			'className' => 'Organization',
			'foreignKey' => 'organization_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        //************************
    public $hasMany=array(
        'ShiftplanUser' => array(
			'className' => 'ShiftplanUser',
			'foreignKey' => 'shift_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
/*****************************Ashok senpai*****************************/
		'Employeeshiftexpense' => array(
			'className' => 'Employeeshiftexpense',
			'foreignKey' => 'shiftuser_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
    );
    //***********************
      
        public function shiftRequests($user_id){
           return $this->find('all',array('conditions'=>array('ShiftUser.user_id'=>$user_id,'ShiftUser.status'=>'1','ShiftUser.shift_date >= '=>date('Y-m-d'))));
        }
        
        public function usersRequests($org_id){
            $limit=10;
            return $this->find('all',array('conditions'=>array('ShiftUser.organization_id'=>$org_id,'ShiftUser.shift_date >= '=>date('Y-m-d')),'order'=>array('ShiftUser.id DESC'),'limit'=>$limit));
        }
 /* *********************************************************** */       
        public function openShift(){
            $openShift = $this->find('all', array(
                'conditions'=>array(
                    'ShiftUser.status' => 0,
                    'ShiftUser.shift_date >='=>date('Y-m-d')
                )
            ));
            
            return $openShift;
        }
        
        public function myTempShifts($user_id = NULL){
            $this->Behaviors->load('Containable');
            $today = date('Y-m-d');
            $temp_shift = $this->find('all', array(
                'contain'=>array(
                    'Shift',
                    'Shift.Organization'=>array('fields'=>array('Organization.title'))
                ),
                'conditions'=>array(
                    'ShiftUser.user_id' => $user_id,
                    'ShiftUser.status' => 3,
                    'ShiftUser.shift_date >=' =>$today
                )
            ));
           return $temp_shift;
        }
        
        public function myOrgShiftRange($user_id = NULL, $org_id = NULL, $branch_id = NULL, $start_date = NULL, $end_date = NULL){
           $myOrgShiftRange = $this->find('all', array(
                'conditions' => array(
                    'Board.organization_id' => $org_id,
                    'Board.branch_id' => $branch_id,
                    'ShiftUser.user_id' => $user_id,
                    'ShiftUser.shift_date >=' => $start_date,
                    'ShiftUser.shift_date <=' => $end_date,
                    'ShiftUser.status' => 3
                )
            ));
            return $myOrgShiftRange;
        }

        public function myShifts($user_id = null)
        {
        	$this->Behaviors->load('Containable');
        	$myShifts = $this->find('all', array(
        		'conditions'=>array('ShiftUser.user_id'=>$user_id),
        		'contain'=>array(
        			'Board.Organization',
        			 'Shift',
        			  'Shift.Shiftnote',
        			    'Board.ShiftUser.User'=>array('fields' => array('id','fname', 'lname'))

        			    )
        		// 'order'=>array('ShiftUser.shift_date' => 'DESC')
        		));

        	return $myShifts;
        }

        //manohar
        public function checkShiftToAssignUser($userId=null){
        	

        	$user = $this->find('all',array(
        		'conditions'=>array('ShiftUser.user_id'=>$userId,'ShiftUser.status'=>3)
        		));
        	return $user;
        }

        //manohar
        public function findShiftUserById($userId=null,$date=null){
        	$user = $this->find('all',array(
        		'conditions' => array('ShiftUser.user_id'=>$userId,'ShiftUser.shift_date'=>$date,'ShiftUser.status'=>3),
        		'contain' => array('ShiftUser'=>array('ShiftUser.user_id','ShiftUser.shift_id'))
        		));
        	
        	return $user;
        }

        public function findShiftUserForNoStatus($userId=null,$date=null){
        	$user1 = $this->find('all',array(
        		'conditions' => array('ShiftUser.user_id'=>$userId,'ShiftUser.shift_date'=>$date),
        		'contain' => array('ShiftUser'=>array('ShiftUser.user_id','ShiftUser.shift_id'))
        		));
        	
        	return $user1;
        }


        
    /**
     * ShiftUser::getShiftUserId()
     * 
     * @param mixed $userId
     * @return
     */
    public function getShiftUserId($userId){
        $this->Behaviors->load('containable');
       return $this->find('all',array('contain'=>array(),'conditions'=>array('ShiftUser.user_id'=>$userId,'ShiftUser.status'=>3)));
    }

    // public function getShiftUserByDate($shiftDate){
    // 	$Users = ClassRegistry::init("User");
    // 	$shiftUsers = $this->find('all',array('conditions'=>array('ShiftUser.shift_date'=>$shiftDate)));
    	
    // 	$shifts = array();
    // 	$count = 0;
    // 	if($shiftUsers){
    // 		foreach($shiftUsers as $shift){
    // 			$shifts[$count]['fname'] = $shift['User']['fname'];
    // 			$shifts[$count]['lname'] = $shift['User']['lname'];
    // 			$shifts[$count]['date'] = $shift['ShiftUser']['shift_date'];
    // 			$count++;
 			// }
    // 	}

    // 	return $shifts;
    // 	//debug($userids)

    // }

    public function myScheduleForCalender($user_id){
        $conditions=array("OR" => array(
                                array('ShiftUser.user_id'=>$user_id,'ShiftUser.status !='=> 0),
                                array('ShiftUser.status'=> 0,'ShiftUser.user_id != '=>$user_id)
                            ));
    $results = $this->find('all', array('conditions'=>$conditions));
         $count=0;
         $mySch=array();
            foreach($results as $result){

                if ($result['Shift']['starttime'] > $result['Shift']['endtime']) {

                    $incDay = strtotime("+1 day", strtotime($result['ShiftUser']['shift_date']));

                    $mySch[$count]['end']=date('Y-m-d',$incDay)."T".$result['Shift']['endtime'];
                }
                else
                {
                    $mySch[$count]['end']=$result['ShiftUser']['shift_date']."T".$result['Shift']['endtime'];
                }
                $mySch[$count]['title']=$result['Shift']['title'];
                $mySch[$count]['start']=$result['ShiftUser']['shift_date']."T".$result['Shift']['starttime'];
                // $mySch[$count]['end']=$result['ShiftUser']['shift_date']."T".$result['Shift']['endtime'];
                $mySch[$count]['org']['id']=$result['Organization']['id'];
                $mySch[$count]['org']['title']=$result['Organization']['title'];
                $mySch[$count]['org']['img_dir']=$result['Organization']['logo_dir'];
                $mySch[$count]['org']['img']=$result['Organization']['logo'];
                $mySch[$count]['status']=$result['ShiftUser']['status'];  
                $mySch[$count]['shiftUserId']=$result['ShiftUser']['id'];
                $count++;
            }
            return $mySch;
    }

    //manohar
    public function checkUserIfAvailable($shiftId,$boardId,$shift_date,$userId,$orgId){
    	//$this->Behaviors->load('Containable');

    	$available = ClassRegistry::init("Useravailability");
    	$Users=$available->listAllAvailableUser($shiftId,$boardId,$shift_date);

        $status = "";
    	if($Users != 'User not Found'){
        	foreach($Users as $key=>$user){
        		if($key==$userId){
        			$data['ShiftUser']['shift_id']=$shiftId;
        			$data['ShiftUser']['board_id']=$boardId;
        			$data['ShiftUser']['user_id']=$userId;
        			$data['ShiftUser']['shift_date']=$shift_date;
        			$data['ShiftUser']['organization_id']=$orgId;
        			$data['ShiftUser']['status']=1;

                    $rule = array('ShiftUser.shift_id'=>$shiftId,'ShiftUser.shift_date'=>$shift_date,'ShiftUser.user_id'=>$userId);

                    if($this->hasAny($rule)){
                        $status['status'] = "exist";
                    } else {
        			$this->create();
            			if($this->save($data)){
            				$this->recursive = 0;
            				$status['id']=$this->getLastInsertID();
            				$shiftuser = $this->find('first',array(
            					'conditions'=>array('ShiftUser.id'=>$status['id'])
            					));

                            if ($shiftuser['Shift']['starttime'] > $shiftuser['Shift']['endtime']) {

                                $incDay = strtotime("+1 day", strtotime($data['ShiftUser']['shift_date']));

                                $status['end']=date('Y-m-d',$incDay)."T".$shiftuser['Shift']['endtime'];
                            }
                            else
                            {
                                $status['end']=$data['ShiftUser']['shift_date']."T".$shiftuser['Shift']['endtime'];
                            }
            				$status['shift_status'] = $shiftuser['ShiftUser']['status'];
            				$status['start'] = $data['ShiftUser']['shift_date'].'T'.$shiftuser['Shift']['starttime'];
            				// $status['end'] = $data['ShiftUser']['shift_date'].'T'.$shiftuser['Shift']['endtime'];
                            $status['shift_title'] = $shiftuser['Shift']['title'];
            				$status['status']="Saved";
            				return $status;
            			}else{
            				$status['status']="Could not save";
            				return $status;
            			}
                    }
        		}
        	}

        }else
        {
        	$status['status']="User not available";
        }

    	return $status;			
    }

    public function updateUserFromCalender($shiftId,$boardId,$shift_date,$userId,$shiftUserId){
    	$available = ClassRegistry::init("Useravailability");
    	$Users=$available->listAllAvailableUser($shiftId,$boardId,$shift_date);
    	if($Users != 'User not Found'){
    	foreach($Users as $key=>$user){
    		if($key==$userId){
    			$data['ShiftUser']['shift_date']=$shift_date;
    			$data['ShiftUser']['shift_id']=$shiftId;
    			$this->id=$shiftUserId;    			
    			if($this->save($data)){
    				$status['id']=$shiftUserId;
    				$result=$this->find('first',array(
    					'conditions'=>array('ShiftUser.id'=>$shiftUserId)
    					));
    			$status['title']=ucwords($result['User']['fname'].' '.$result['User']['lname']);
                $status['start']=$result['ShiftUser']['shift_date']."T".$result['Shift']['starttime'];
                $status['end']=$result['ShiftUser']['shift_date']."T".$result['Shift']['endtime'];
                $status['Shift']['id']=$result['Shift']['id'];
                $status['shiftUserId']=$result['ShiftUser']['id'];
                $status['userId']=$result['User']['id'];
    			$status['status']="Saved";
    				return $status;
    			}else{
    				$status['status']="Could not Update";
    				return $status;
    			}
    		}
    	}
    }
    	$status['status']="User not available";
    	return $status;			
    }

     public function showShiftUserOfBoard($orgId,$boardId){
            $results = $this->find('all', array(
                'conditions'=>array(
                    'ShiftUser.board_id'=>$boardId,
                    'ShiftUser.organization_id'=>$orgId
                    )
            ));
            $count=0;
            if(isset($results) && !empty($results)){
                foreach($results as $result){
                    //debug($result);
                    if ($result['Shift']['starttime'] > $result['Shift']['endtime']) {

                        $incDay = strtotime("+1 day", strtotime($result['ShiftUser']['shift_date']));

                        $shiftUser[$count]['end']=date('Y-m-d',$incDay)."T".$result['Shift']['endtime'];
                    }
                    else
                    {
                        $shiftUser[$count]['end']=$result['ShiftUser']['shift_date']."T".$result['Shift']['endtime'];
                    }
                    $shiftUser[$count]['title']=ucwords($result['User']['fname'].' '.$result['User']['lname']);
                    $shiftUser[$count]['start']=$result['ShiftUser']['shift_date']."T".$result['Shift']['starttime'];
                    $shiftUser[$count]['Shift']['id']=$result['Shift']['id'];
                    $shiftUser[$count]['Shift']['title']=$result['Shift']['title'];
                    $shiftUser[$count]['shiftUserId']=$result['ShiftUser']['id'];
                    $shiftUser[$count]['shift_status']=$result['ShiftUser']['status'];
                    $shiftUser[$count]['userId']=$result['User']['id'];

                    $count++;
                }
            }else{
                $shiftUser = array();
            }
        
        	return $shiftUser;
    }
    
    public function UserResponseFromCalender($id,$data){
        $this->id=$id;
        if($this->save($data)){
            return 1;
        }else{
            return 0;
        }
    }
    
    public function overallInCalendar($user_id){
        $conditions=array("OR" => array(
                                array('ShiftUser.user_id'=>$user_id,'ShiftUser.status !='=> 0),
                                array('ShiftUser.status'=> 0,'ShiftUser.user_id != '=>$user_id)
                            ));
    $results = $this->find('all', array('conditions'=>$conditions));
         $count=0;
         $mySch=array();
            foreach($results as $result){
                $mySch[$count]['title']="Shift";
                $mySch[$count]['description'] = $result['Shift']['title'];
                $mySch[$count]['start']=$result['ShiftUser']['shift_date']."T".$result['Shift']['starttime'];
                $mySch[$count]['end']=$result['ShiftUser']['shift_date']."T".$result['Shift']['endtime'];
                $mySch[$count]['org']['id']=$result['Organization']['id'];
                $mySch[$count]['org']['title']=$result['Organization']['title'];
                //$mySch[$count]['board']=$result['Board']['title'];
                $mySch[$count]['status']=$result['ShiftUser']['status'];  
                $mySch[$count]['id']=$result['ShiftUser']['id'];
                $count++;
            }
            return $mySch;
    }
    
    public function getOrganizationShiftUser($orgId){
        $conditions=array('ShiftUser.organization_id'=>$orgId);
        $results = $this->find('all', array('conditions'=>$conditions));
         $count=0;
         $mySch=array();
        foreach($results as $result){

            if ($result['Shift']['starttime'] > $result['Shift']['endtime']) {

                $incDay = strtotime("+1 day", strtotime($result['ShiftUser']['shift_date']));

                $mySch[$count]['end']=date('Y-m-d',$incDay)."T".$result['Shift']['endtime'];
            }
            else
            {
                $mySch[$count]['end']=$result['ShiftUser']['shift_date']."T".$result['Shift']['endtime'];
            }
            $mySch[$count]['user']['id']=$result['User']['id'];
            $mySch[$count]['user']['name']=$result['User']['fname']." ".$result['User']['lname'];
            $mySch[$count]['description'] = $result['Shift']['title'];
            $mySch[$count]['start']=$result['ShiftUser']['shift_date']."T".$result['Shift']['starttime'];
            // $mySch[$count]['end']=$result['ShiftUser']['shift_date']."T".$result['Shift']['endtime'];
            $mySch[$count]['shift']['id']=$result['Shift']['id'];
            $mySch[$count]['shift']['title']=$result['Shift']['title'];
            $mySch[$count]['board']['id']=$result['Board']['id'];
            $mySch[$count]['board']['title']=$result['Board']['title'];
            $mySch[$count]['status']=$result['ShiftUser']['status'];  
            $mySch[$count]['id']=$result['ShiftUser']['id'];
            $count++;
        }
        return $mySch;
    }

    public function filterEmployeeList($orgId,$name){
        $this->Behaviors->load('Containable');
        $names = explode(" ",$name);

        $contain = array('User'=>['fields'=>array('id','fname','lname','email','address','phone','image_dir','image','gender','status','imagepath')],'Board');
        $dateToday = date('Y-m-d');
        
        foreach($names as $n){
            $conditions = array(
                "ShiftUser.organization_id"=>$orgId,
                "ShiftUser.check_status >="=>'1',
                "ShiftUser.shift_date"=> $dateToday,
                "OR"=>array('User.fname LIKE' => $n.'%','User.lname LIKE' => $n.'%')
                );
        }
        

        $results = $this->find('all',array(
                'conditions'=>$conditions,
                'contain'=>$contain
            ));
        
        return $results;

    }

    public function todaysShift($userId){
        $this->recursive = 2;
        $date = date('Y-m-d');
        $this->Behaviors->load('Containable');
        
        $output = array();
        $results = $this->find('all',array(
                'conditions'=>array('ShiftUser.user_id'=>$userId,'ShiftUser.shift_date'=>$date,'ShiftUser.status'=>3),
                'contain'=>array(
                    'Organization'=>array('fields'=>['title']),
                     'Shift',
                     'Board'
                        )
                ));

        if(!empty($results)){
            foreach($results as $r){
                $c = $r['Shift']['id'];
                $rule = array('ShiftUser.shift_date'=>$date,'ShiftUser.status'=>3,'ShiftUser.shift_id'=>$c);
                
                $cnt = $this->find('count',array(
                        'conditions'=>$rule
                    ));
                
                $output[$c]['shiftId'] = $r['Shift']['id'];
                $output[$c]['shift'] = $r['Shift']['title'];
                $output[$c]['start'] = $r['Shift']['starttime'];
                $output[$c]['end'] = $r['Shift']['endtime'];
                $output[$c]['board'] = $r['Board']['title'];
                $output[$c]['check_status'] = $r['ShiftUser']['check_status'];

                $output[$c]['org'] = $r['Organization']['title'];
                $output[$c]['count'] = $cnt;
            }
        }

        return $output;
    }

    public function todaysShiftForOrg($orgId){
        $this->recursive = 2;
        $date = date('Y-m-d');
        $this->Behaviors->load('Containable');
        $results = $this->find('all',array(
                'conditions'=>array('ShiftUser.organization_id'=>$orgId,'ShiftUser.shift_date'=>$date,'ShiftUser.status'=>3),
                'contain'=>array(
                    'Board.Organization'=>array('fields'=>['title']),
                    'Shift',
                    'User'=>array('fields'=>['fname','lname','imagepath','image','gender','image_dir'])

                        )
                ));
        return $results;
    }


    /**** find if shift can be changed ****/
    public function changeShift($shiftId = null){
        $shiftOnProgress = 0;
        $date = date('Y-m-d');
        if($this->hasAny(['ShiftUser.shift_id'=>$shiftId,'ShiftUser.status'=>3])){
            $shiftOnProgress = 1; // can't change  shift time
        } else if($this->hasAny(['ShiftUser.shift_id'=>$shiftId,'ShiftUser.status !='=>3])){
            $shiftOnProgress = 2; // need to delete user before changing shift
        } else {
            $shiftOnProgress = 0; // can change shift time
        }
        return $shiftOnProgress;
    }

    public function filterTodayShift($orgId,$branchId,$boardId){
        $this->recursive = 2;
        $board = ClassRegistry::init('Board');
        $this->Behaviors->load('Containable');
        $date = date('Y-m-d');
        $boardIds = $board->findBoardId($branchId);
        //debug($boardIds);
        if($branchId != '0' && $boardId == '0'){
            if(!empty($boardIds)){
            $conditions = array('ShiftUser.organization_id'=>$orgId,'ShiftUser.board_id IN'=>$boardIds,'ShiftUser.shift_date'=>$date,'ShiftUser.status'=>3);

            }

        } else if($branchId != '0' && $boardId != '0'){
            $conditions = array('ShiftUser.organization_id'=>$orgId,'ShiftUser.board_id'=>$boardId,'ShiftUser.shift_date'=>$date,'ShiftUser.status'=>3);
        } 
        
        $contain = array(
                    'Board.Organization'=>array('fields'=>['title']),
                    'Shift',
                    'User'=>array('fields'=>['fname','lname','imagepath','image','gender','image_dir'])

                        );

        if(!empty($boardIds)){
           $results = $this->find('all',array(
                'conditions'=> $conditions,
                'contain' => $contain

            )); 
       } else {
            $results = array();
       }
        
        
        return $results;
    }


    public function getShiftHistoryOfEmp($userId = null, $orgId = null)
    {
        $account = ClassRegistry::init('Account'); 
        $data = $account->getEmpRelatedOrgHistory($orgId, $userId);

        

        $data = $data['Account'];
        $data['totalLateCheckin'] = $this->getTotalLateCheckIn($userId, $orgId);
        $data['totalAbsent'] = $this->getTotalAbsentOFEmp($userId, $orgId);
        $data['totalEarlyCheckout'] = $this->getEarlyCheckoutOfEmp($userId, $orgId);
        $data['totalLateCheckout'] = $this->getLateCheckoutOfEmp($userId, $orgId);
        $data['totalLateCheckinHours'] = $this->getTotalLateCheckinHoursOfEmp($userId, $orgId);
        $data['totalAttendance'] = $this->getTotalAttendance($userId, $orgId);

        return $data;
    }

    public function getAllShiftHistoryOfEmp($userId = null, $sDate = null, $eDate = null)
    {
        $account = ClassRegistry::init('Account');

        $orgs = ClassRegistry::init('OrganizationUser');

        $orgdata = $orgs->getOrgListOfUser($userId);

        $data[0]['Organization']= "All";
        $data[0]['workedhours'] = 0; 
        $data[0]['morehours'] = 0;
        $data[0]['totalAmount'] = 0;
        $data[0]['totalShifts'] = 0;
        $data[0]['lesshours'] = 0;
        $data[0]['totalLateCheckin'] = 0;
        $data[0]['totalAbsent'] = 0;
        $data[0]['totalEarlyCheckout'] = 0;
        $data[0]['totalLateCheckout'] = 0;
        $data[0]['totalLateCheckinHours'] = 0;
        $data[0]['totalAttendance'] = 0;

        foreach ($orgdata as $org) {

            $orgId = $org['Organization']['id'];
            $data[$orgId] = $account->getEmpRelatedOrgHistory($orgId, $userId, $sDate, $eDate)['Account'];
            $data[$orgId]['Organization'] = $org['Organization']['title']; 
            $data[$orgId]['totalLateCheckin'] = $this->getTotalLateCheckIn($userId, $orgId, $sDate, $eDate);
            $data[$orgId]['totalAbsent'] = $this->getTotalAbsentOFEmp($userId, $orgId, $sDate, $eDate);
            $data[$orgId]['totalEarlyCheckout'] = $this->getEarlyCheckoutOfEmp($userId, $orgId, $sDate, $eDate);
            $data[$orgId]['totalLateCheckout'] = $this->getLateCheckoutOfEmp($userId, $orgId, $sDate, $eDate);
            $data[$orgId]['totalLateCheckinHours'] = $this->getTotalLateCheckinHoursOfEmp($userId, $orgId, $sDate, $eDate);
            $data[$orgId]['totalAttendance'] = $this->getTotalAttendance($userId, $orgId, $sDate, $eDate);
            $data[$orgId]['totalShifts'] = $this->getTotalshifts($userId, $orgId, $sDate, $eDate);

            $data[0]['workedhours'] += $data[$orgId]['workedhours']; 
            $data[0]['morehours'] += $data[$orgId]['morehours'];
            $data[0]['totalAmount'] += $data[$orgId]['totalAmount'];
            $data[0]['totalShifts'] += $data[$orgId]['totalShifts'];
            $data[0]['lesshours'] += $data[$orgId]['lesshours'];
            $data[0]['totalLateCheckin'] += $data[$orgId]['totalLateCheckin'];
            $data[0]['totalAbsent'] += $data[$orgId]['totalAbsent'];
            $data[0]['totalEarlyCheckout'] += $data[$orgId]['totalEarlyCheckout'];
            $data[0]['totalLateCheckout'] += $data[$orgId]['totalLateCheckout'];
            $data[0]['totalLateCheckinHours'] += $data[$orgId]['totalLateCheckinHours'];
            $data[0]['totalAttendance'] += $data[$orgId]['totalAttendance'];
        }

        return $data;
    }

    public function getTotalshifts($userId = null, $orgId = null, $sDate = null, $eDate = null)
    {
        if (empty($sDate))
        {
            $options = array(
            'conditions'=>['ShiftUser.organization_id'=>$orgId, 'ShiftUser.user_id'=>$userId, 'ShiftUser.status'=> 3],
            'contain'=>false,
            );
        }else
        {
            $options = array(
            'conditions'=>['ShiftUser.organization_id'=>$orgId, 'ShiftUser.user_id'=>$userId, 'ShiftUser.status'=> 3, 'ShiftUser.shift_date >='=>$sDate, 'ShiftUser.shift_date <='=>$eDate],
            'contain'=>false,
            );
        }


        return $this->find('count', $options);
    }

    public function getTotalLateCheckIn($userId = null, $orgId = null, $sDate = null, $eDate = null)
    {
        if (empty($sDate))
        {
            $options = array(
            'conditions'=>['ShiftUser.organization_id'=>$orgId, 'ShiftUser.user_id'=>$userId, 'ShiftUser.latestatus'=>1],
            'contain'=>false,
            'fields'=>['Count(ShiftUser.latestatus) as totalLateStatus']
            );
        }else
        {
            $options = array(
            'conditions'=>['ShiftUser.organization_id'=>$orgId, 'ShiftUser.user_id'=>$userId, 'ShiftUser.shift_date >='=>$sDate, 'ShiftUser.shift_date <='=>$eDate, 'ShiftUser.latestatus'=>1],
            'contain'=>false,
            'fields'=>['Count(ShiftUser.latestatus) as totalLateStatus']
            );
        }


        return $this->find('all', $options)[0][0]['totalLateStatus'];
    }

    public function getTotalAbsentOFEmp($userId = null, $orgId = null, $sDate = null, $eDate = null)
    {
        $todayDate = date('Y-m-d');

        if(empty($sDate))
        {
            $options = array(
            'conditions'=>['ShiftUser.organization_id'=>$orgId, 'ShiftUser.user_id'=>$userId, 'ShiftUser.check_status'=>0, 'ShiftUser.shift_date <'=> $todayDate],
            'contain'=>false,
            );
        }else
        {
            $options = array(
            'conditions'=>['ShiftUser.organization_id'=>$orgId, 'ShiftUser.user_id'=>$userId, 'ShiftUser.shift_date >='=>$sDate, 'ShiftUser.shift_date <='=>$eDate, 'ShiftUser.check_status'=>0, 'ShiftUser.shift_date <'=> $todayDate],
            'contain'=>false,
            );
        }

        

        return $this->find('count', $options);


    }

    public function getEarlyCheckoutOfEmp($userId = null, $orgId = null, $sDate = null, $eDate = null)
    {

        if(empty($sDate))
        {
            $data = $this->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.earlytime >'=> 0]]);
        }else
        {
            $data = $this->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId, 'ShiftUser.shift_date >='=>$sDate, 'ShiftUser.shift_date <='=>$eDate, 'ShiftUser.organization_id'=>$orgId,'ShiftUser.earlytime >'=> 0]]);
        }
        


        return $data;

    }

    public function getLateCheckoutOfEmp($userId = null, $orgId = null, $sDate = null, $eDate = null)
    {
        if(empty($sDate))
        {
            $data = $this->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.latetime >'=> 0]]);
        }else
        {
            $data = $this->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId, 'ShiftUser.shift_date >='=>$sDate, 'ShiftUser.shift_date <='=>$eDate, 'ShiftUser.organization_id'=>$orgId,'ShiftUser.latetime >'=> 0]]);
        }
        

        return $data;

    }

    public function getTotalLateCheckinHoursOfEmp($userId = null, $orgId = null, $sDate = null, $eDate = null)
    {
        $this->Behaviors->load('Containable');

        $this->virtualFields['checkinTime'] = 0;
        $this->virtualFields['shiftStartTime'] = 0;

        if(empty($sDate))
        {
            $options = array(
            'conditions'=>['ShiftUser.organization_id'=>$orgId, 'ShiftUser.user_id'=>$userId, 'ShiftUser.latestatus'=>1],
            'fields'=>['check_in_time as ShiftUser__checkinTime', 'Shift.starttime as ShiftUser__shiftStartTime']
            );
        }else
        {
            $options = array(
            'conditions'=>['ShiftUser.organization_id'=>$orgId, 'ShiftUser.user_id'=>$userId, 'ShiftUser.shift_date >='=>$sDate, 'ShiftUser.shift_date <='=>$eDate, 'ShiftUser.latestatus'=>1],
            'fields'=>['check_in_time as ShiftUser__checkinTime', 'Shift.starttime as ShiftUser__shiftStartTime']
            );
        }

        

        $list = $this->find('all', $options);

        $totalDiff = 0;
        foreach ($list as $key => $value) {

            $t1 = DateTime::createFromFormat("Y-m-d H:i:s", $value['ShiftUser']['checkinTime']);
            $t1 = $t1->format("H:i:s");
            $t1 = new DateTime("1970-01-01 $t1", new DateTimeZone('UTC'));
            $s1 = (int)$t1->getTimestamp();


            $t2 = DateTime::createFromFormat("H:i:s",$value['ShiftUser']['shiftStartTime']);
            $t2 = $t2->format("H:i:s");
            $t2 = new DateTime("1970-01-01 $t2", new DateTimeZone('UTC'));
            $s2 = (int)$t2->getTimestamp();

            $totalDiff += $s1 - $s2;
        }

        return (float)$totalDiff/3600;
    }

    public function getTotalAttendance($userId = null, $orgId = null, $sDate = null, $eDate = null)
    {
        if(empty($sDate))
        {
            $options = array(
            'conditions'=>['ShiftUser.organization_id'=>$orgId, 'ShiftUser.user_id'=>$userId, 'ShiftUser.check_status'=>2],
            'contain'=>false,
            );
        }else
        {
            $options = array(
            'conditions'=>['ShiftUser.organization_id'=>$orgId, 'ShiftUser.user_id'=>$userId, 'ShiftUser.shift_date >='=>$sDate, 'ShiftUser.shift_date <='=>$eDate, 'ShiftUser.check_status'=>2],
            'contain'=>false,
            );
        }
        

        return $this->find('count', $options);
    }

    public function getEmpShiftOnBoard( $userId = null, $boardId = null)
    {
        $this->Behaviors->load('Containable');
        $options = array(
            'conditions'=>['ShiftUser.user_id'=>$userId, 'ShiftUser.board_id'=>$boardId, 'ShiftUser.status !='=>4],
            'contain'=>['Shift']);
        $results = $this->find('all', $options);
        $count=0;
         $mySch=array();

         $openShiftIds =array();
            foreach($results as $result){
                
                if ($result['Shift']['starttime'] > $result['Shift']['endtime']) {

                    $incDay = strtotime("+1 day", strtotime($result['ShiftUser']['shift_date']));

                    $mySch[$count]['end']=date('Y-m-d',$incDay)."T".$result['Shift']['endtime'];
                }
                else
                {
                    $mySch[$count]['end']=$result['ShiftUser']['shift_date']."T".$result['Shift']['endtime'];
                }


                $openShiftIds[] = $result['ShiftUser']['opencalendarshift_id'];
                $mySch[$count]['title']="Shift";
                $mySch[$count]['description'] = $result['Shift']['title'];
                $mySch[$count]['start']=$result['ShiftUser']['shift_date']."T".$result['Shift']['starttime'];
                // $mySch[$count]['end']=$result['ShiftUser']['shift_date']."T".$result['Shift']['endtime'];
                //$mySch[$count]['board']=$result['Board']['title'];
                $mySch[$count]['status']=$result['ShiftUser']['status'];  
                $mySch[$count]['id']=$result['ShiftUser']['id'];
                $mySch[$count]['shift_id']=$result['Shift']['id'];
                $count++;
            }

        $opencalendarshift = ClassRegistry::init("Opencalendarshift");

        $openshifts = $opencalendarshift->getOpenShiftOfBoard($boardId);

        foreach($openshifts as $openShift){

            if(!in_array($openShift['openCShiftId'], $openShiftIds))
            {
                $mySch[$count]['title']="Shift";
                $mySch[$count]['description'] = $openShift['Shift']['title'];
                $mySch[$count]['start']=$openShift['start'];
                $mySch[$count]['end']=$openShift['end'];
                $mySch[$count]['shift_id']=$openShift['Shift']['id'];
                $mySch[$count]['status']="0";
                $mySch[$count]['openCShiftId']=$openShift['openCShiftId'];
                $mySch[$count]['openCShiftcount']=$openShift['openCShiftcount'];
                $count++;
            }
        }
            return $mySch;
    }

    public function getEmpShiftSchedule( $userId = null)
    {
        $this->Behaviors->load('Containable');
        $options = array(
            'conditions'=>['ShiftUser.user_id'=>$userId, 'ShiftUser.status !='=>4],
            'contain'=>['Shift', 'Organization'=>['id', 'title', 'logo_dir', 'logo']]
            );

        $results = $this->find('all', $options);
        $count=0;
        $mySch=array();

        $openShiftIds =array();
        
        foreach($results as $result){

            if ($result['Shift']['starttime'] > $result['Shift']['endtime']) {

                $incDay = strtotime("+1 day", strtotime($result['ShiftUser']['shift_date']));

                $mySch[$count]['end']=date('Y-m-d',$incDay)."T".$result['Shift']['endtime'];
            }
            else
            {
                $mySch[$count]['end']=$result['ShiftUser']['shift_date']."T".$result['Shift']['endtime'];
            }

            $openShiftIds[] = $result['ShiftUser']['opencalendarshift_id'];
            $mySch[$count]['orgId']=$result['Organization']['id'];
            $mySch[$count]['orgTitle']=$result['Organization']['title'];
            $mySch[$count]['orgDir']=$result['Organization']['logo_dir'];
            $mySch[$count]['orgImage']=$result['Organization']['logo'];

            $mySch[$count]['title']="Shift";
            $mySch[$count]['description'] = $result['Shift']['title'];
            $mySch[$count]['start']=$result['ShiftUser']['shift_date']."T".$result['Shift']['starttime'];
            // $mySch[$count]['end']=$result['ShiftUser']['shift_date']."T".$result['Shift']['endtime'];
            //$mySch[$count]['board']=$result['Board']['title'];
            $mySch[$count]['status']=$result['ShiftUser']['status'];  
            $mySch[$count]['id']=$result['ShiftUser']['id'];
            $mySch[$count]['shift_id']=$result['Shift']['id'];
            $count++;
        }

        $boardUser = ClassRegistry::init("BoardUser");

        $boardIdArr = $boardUser->getBoardsOfUser($userId);


        $boardIds = array();

        if(isset($boardIdArr) && !empty($boardIdArr))
        {
            foreach ($boardIdArr as $key => $value) {
                $boardIds[] = $value['BoardUser']['id'];

            }
        }

        $opencalendarshift = ClassRegistry::init("Opencalendarshift");

        $openshifts = $opencalendarshift->getOpenShiftOfBoard($boardIds);

        foreach($openshifts as $openShift){

            if(!in_array($openShift['openCShiftId'], $openShiftIds))
            {
                $mySch[$count]['orgId']=$openShift['orgId'];
                $mySch[$count]['orgTitle']=$openShift['orgTitle'];
                $mySch[$count]['orgDir']=$openShift['orgDir'];
                $mySch[$count]['orgImage']=$openShift['orgImage'];

                $mySch[$count]['title']="Shift";
                $mySch[$count]['description'] = $openShift['Shift']['title'];
                $mySch[$count]['start']=$openShift['start'];
                $mySch[$count]['end']=$openShift['end'];
                $mySch[$count]['shift_id']=$openShift['Shift']['id'];
                $mySch[$count]['status']="0";
                $mySch[$count]['openCShiftId']=$openShift['openCShiftId'];
                $mySch[$count]['openCShiftcount']=$openShift['openCShiftcount'];
                $count++;
            }
        }
        
        return $mySch;
    }

    public function getRunningShifts($userId = null)
    {
        $this->Behaviors->load('Containable');
        // $this->recursive = 2;
        $date = date('Y-m-d');
        $time = date('H:i:s');

        $finalData = array();
        // auto check out for previous shift
        $this->autoCheckOut($userId);

        $shift = array();

        $runningOptions = array(
                        'conditions'=>
                            [   'ShiftUser.user_id' => $userId,
                                'ShiftUser.shift_date'=>$date,
                                'ShiftUser.status'=>'3',
                                'ShiftUser.check_status'=>array('1'),
                                // 'Shift.starttime >=' => date("H:i:s", strToTime($time)-(60*30)),
                            ],
                            'contain'=>['Board', 'Shift', 'Shift.Shiftchecklist.id'],
                        );


        $runningShift = $this->find('first', $runningOptions);

        if(!empty($runningShift) && $time >= $runningShift['Shift']['endtime'])
        {
            $this->id = $runningShift['ShiftUser']['id'];

            $d = $runningShift['ShiftUser']['shift_date'].' '.$runningShift['Shift']['endtime'];
            $this->saveField('check_status', 2);
            $this->saveField('check_out_time', $d);

            $runningShift =[];

        }

        if(empty($runningShift))
        {
            $runningOptions = array(
                        'conditions'=>
                            [   'ShiftUser.user_id' => $userId, 
                                'ShiftUser.shift_date'=>$date,
                                'ShiftUser.status'=>'3',
                                'ShiftUser.check_status'=>array('0'),
                                'Shift.starttime >=' => date("H:i:s", strToTime($time)-(60*30)),
                            ],
                            'contain'=>['Board', 'Shift'=>['order'=>'Shift.starttime ASC'], 'Shift.Shiftchecklist.id'],
                        );

            $runningShift = $this->find('first', $runningOptions);

            if(isset($runningShift) && !empty($runningShift))
            {
                if(date("H:i:s", strToTime($time)-(60*30)) <= $runningShift['Shift']['starttime'] && date("H:i:s", strToTime($time)+(60*30)) >= $runningShift['Shift']['starttime'])
                    {  
                    }
                    else
                    {
                        $runningShift =[];
                    }
            }
        }


        if(isset($runningShift) && !empty($runningShift) && $runningShift['Shift']['starttime'] <= date("H:i:s", strToTime($time)+(60*30)))
        {

            // debug('h');die();
            $runningShift['Shift']['stime']= $this->hisToTime($runningShift['Shift']['starttime']);
            $runningShift['Shift']['etime'] = $this->hisToTime($runningShift['Shift']['endtime']);

            $shift['runningShift']=$runningShift;

            $runningShiftId = $runningShift['ShiftUser']['id'];

            $nextOptions = array(
                        'conditions'=>
                            [   
                                'ShiftUser.id !=' => $runningShiftId, 
                                'ShiftUser.user_id' => $userId, 
                                'ShiftUser.shift_date >='=>$date,
                                'ShiftUser.status'=>'3',
                                'ShiftUser.check_status'=>array('0','1')
                            ],
                        'contain'=>['Board', 'Shift']
                        );
            $nextAllShift = $this->find('all', $nextOptions);
            $nextShift = array();

            $todaysDateTime= strtotime($date) + strtotime($time);
            foreach ($nextAllShift as $next) {

                $nextTime = strtotime($next['ShiftUser']['shift_date']) + strtotime($next['Shift']['starttime']);

                if($nextTime >= $todaysDateTime)
                {
                    $nextShift = $next;
                    break;
                }

            }

             if(isset($nextShift) && !empty($nextShift))
             {
                $nextShift['Shift']['stime'] = $this->hisToTime($nextShift['Shift']['starttime']);
                $nextShift['Shift']['etime'] = $this->hisToTime($nextShift['Shift']['endtime']);
                $nextShift['ShiftUser']['sdate'] = $this->ymdtofjy($nextShift['ShiftUser']['shift_date']);
                $shift['nextShift']=$nextShift;
             }
             else
             {
                $shift['nextShift']=[];
             }

             $this->set('runningShift', $shift);

             $finalData['runningShift'] = $shift;
             $finalData['output'] = 1;
            
        }
        else
        {
            $shift['runningShift']=[];

            $nextOptions = array(
                        'conditions'=>
                            [   'ShiftUser.user_id' => $userId, 
                                'ShiftUser.shift_date >='=>$date,
                                'ShiftUser.status'=>'3',
                                'ShiftUser.check_status'=>array('0','1')
                            ],
                        'contain'=>['Board', 'Shift'=>['order'=>'Shift.starttime ASC']],
                        'order'=>['ShiftUser.shift_date ASC']
                        );
            $nextAllShift = $this->find('all', $nextOptions);

            // debug($nextAllShift);die();
            $nextShift = array();

            $todaysDateTime= strtotime($date) + strtotime($time);
            foreach ($nextAllShift as $next) {

                $nextTime = strtotime($next['ShiftUser']['shift_date']) + strtotime($next['Shift']['starttime']);

                if($nextTime >= $todaysDateTime)
                {
                    $nextShift = $next;
                    break;
                }

            }


             if(isset($nextShift) && !empty($nextShift))
             {
                $nextShift['Shift']['stime'] = $this->hisToTime($nextShift['Shift']['starttime']);
                $nextShift['Shift']['etime'] = $this->hisToTime($nextShift['Shift']['endtime']);
                $nextShift['ShiftUser']['sdate'] = $this->ymdtofjy($nextShift['ShiftUser']['shift_date']);
                $shift['nextShift']=$nextShift;
             }
             else
             {
                $shift['nextShift']=[];
             }

             $finalData['runningShift'] = $shift;
             $finalData['output'] = 1;
        }

        if(!empty($shift['runningShift']))
        {
            $runningShiftStatus = 1;
        }else
        {
            $runningShiftStatus = 0;
        }

        if(!empty($shift['nextShift']))
        {
            $nextShiftStatus = 1;
        }else
        {
            $nextShiftStatus = 0;
        }

        $finalData['runningShiftStatus'] = $runningShiftStatus;
        $finalData['nextShiftStatus'] = $nextShiftStatus;

        return array(
            $finalData
            );

    }

    public function autoCheckOut($userId = null)
    {
        $date = date('Y-m-d');
        $time = date('H:i:s');

        $options = array(
            'conditions'=>[
                            'ShiftUser.user_id' => $userId,
                            'ShiftUser.shift_date <'=>$date,
                            'ShiftUser.status'=>'3',
                            'ShiftUser.check_status'=>array('1'),
                            ]);

        $shifts = $this->find('all', $options);

        // debug($shifts);

        $account = ClassRegistry::init('Account');
        if(isset($shifts) && !empty($shifts))
        {
            foreach ($shifts as $shift) {

                $this->id = $shift['ShiftUser']['id'];
                $checkoutTime = date("H:i:s",strToTime($shift['Shift']['endtime']) + (60*30));

                $checkoutDateTime = $shift['ShiftUser']['shift_date']." ".$checkoutTime;

                $data = array('check_out_time'=>$checkoutDateTime, 'check_status'=>'2', 'latetime'=>$checkoutDateTime);

                if($this->exists())
                {
                    if($this->save($data))
                    {
                        $shift1 = $this->find('first', [
                            'conditions'=>['ShiftUser.id'=>$this->id],
                        ]);

                        $done = $account->saveDate($shift1);
                    }
                }
            }
        }


        return true;
    }

    public function hisToTime($hisTime)
    {
        $startTime = new DateTime($hisTime);
        return $startTime->format('g:i A');
    }

    public function ymdtofjy($date)
        {   
            $date = strtotime($date);
            return date('F j, Y', $date);
        }

    public function myFriend($id){
        $this->Behaviors->load('Containable');
        
        $result = $this->find('first',array(
                'recursive'=>-1,
                'conditions'=>array('ShiftUser.id'=>$id),
                'fields'=>array('organization_id','board_id','shift_id','shift_date','status')
            ));
        
        $condition = array();
        if(!empty($result['ShiftUser'])){
            $condition['ShiftUser.organization_id'] = $result['ShiftUser']['organization_id'];
            $condition['ShiftUser.board_id'] = $result['ShiftUser']['board_id'];
            $condition['ShiftUser.shift_id'] = $result['ShiftUser']['shift_id'];
            $condition['ShiftUser.shift_date'] = $result['ShiftUser']['shift_date'];
            $condition['ShiftUser.status'] = $result['ShiftUser']['status'];
        }


        $friends = $this->find('all',array(
                'recursive'=>2,
                'conditions'=>$condition,
                'contain'=>array('User'=>array('id','fname','lname'))
            ));
        
        return $friends ;
        
    }    
}
