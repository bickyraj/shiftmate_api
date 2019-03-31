<?php
App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');
/**
 * OrganizationUser Model
 *
 * @property Organization $Organization
 * @property User $User
 * @property Branch $Branch
 * @property Organizationrole $Organizationrole
 */
class OrganizationUser extends AppModel {

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
        'branch_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'organizationrole_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        // 'designation' => array(
        //  'notEmpty' => array(
        //      'rule' => array('notEmpty'),
        //      //'message' => 'Your custom message here',
        //      //'allowEmpty' => false,
        //      //'required' => false,
        //      //'last' => false, // Stop validation after this rule
        //      //'on' => 'create', // Limit validation to 'create' or 'update' operations
        //  ),
        // ),
        'hire_date' => array(
            'date' => array(
                'rule' => array('date'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'wage' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'max_weekly_hour' => array(
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
            'notEmpty' => array(
                'rule' => array('notEmpty'),
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
        'Organization' => array(
            'className' => 'Organization',
            'foreignKey' => 'organization_id',
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
        'Branch' => array(
            'className' => 'Branch',
            'foreignKey' => 'branch_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Organizationrole' => array(
            'className' => 'Organizationrole',
            'foreignKey' => 'organizationrole_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Group' => array(
            'className' => 'Group',
            'foreignKey' => 'group_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
        
        /*public $hasOne = array(
        'Organizationrole' => array(
            'className' => 'Organizationrole',
            'foreignKey' => 'organizationrole_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
            );*/
        
        public function myOrganizations($user_id = null){
            $this->Behaviors->load('Containable');
            $myOrganizations = $this->find('all', array(
                'contain' => array(
                    'Organization.Organizationmessage',
                    'Organization.Organizationmessage.User',
                    'User',
                    'Branch',
                    'Organizationrole',
                    'Organization.City',
                    'Organization.Country',
                    'Branch.City',
                    'Branch.Country'
                ),
            'conditions'=>array(
                'OrganizationUser.user_id'=> $user_id,
                'OrganizationUser.status'=>3
                )
            ));
            return $myOrganizations;
        }

        public function myOrganizationLists($user_id = null){
            $this->Behaviors->load('Containable');
           //$this->recursive = 2;
            $myOrganizations = $this->find('all', array(
                'contain' => array(
                    'Organization',
                   /* 'User',
                    'User.ShiftUser',*/
                    'Branch',
                    'Branch.Organizationfunction',
                    'Branch.ShiftBranch',
                    'Branch.ShiftBranch.Shift'/*
                    'Organization'=>array('fields'=> array('id')),
                    //'Organization.Branch'=>array('fields'=> array('id')),
                    //'Organization.Branch.Organizationfunction',
                    'OrganizationUser.Branch'*/
                ),
                //'fields'=>'organization_id',
            'conditions'=>array(
                'OrganizationUser.user_id'=> $user_id,
                'OrganizationUser.status'=>3
                )
            ));
            return $myOrganizations;
        }
        
        public function myOrganizationDetail($user_id = NULL, $orgId = NULL, $branch_id = NULL){
            $this->Behaviors->load('Containable');
            $myOrganizationDetail = $this->find('first', array(
                'contain'=>array(
                    'Organization',
                    'User',
                    'Branch',
                    'Branch.City',
                    'Branch.Country',
                    'Organizationrole',
                    'Organization.City',
                    'Organization.Country',
                    'Branch.Board',
                    'Branch.ShiftBranch',
                    'Branch.ShiftBranch.Shift',
                    'Branch.Board.BoardUser' => array('conditions'=> array('status'=> 1)),
                    'Branch.Board.User' => array('fields'=>array('id', 'fname', 'lname'))
                    ),
                'conditions'=>array(
                    'OrganizationUser.user_id'=>$user_id,
                    'OrganizationUser.branch_id'=>$branch_id,
                    'OrganizationUser.organization_id'=>$orgId
                    )
            ));
            return $myOrganizationDetail;
        }
        
        public function myOrgProfile($user_id = NULL, $orgId = NULL, $branch_id = NULL){
            $myOrgProfile = $this->find('first', array(
                'conditions' => array(
                    'OrganizationUser.user_id' => $user_id,
                    'OrganizationUser.organization_id' => $orgId,
                    'OrganizationUser.branch_id' => $branch_id,
                    'OrganizationUser.status' => 1
                )
            ));
            
            return $myOrgProfile;
        }
        /*By rabi */
         public function pinNumber($org_id = null)
        {
       
        for ($i=0; $i <10000 ; $i++) { 
             $rand_number = rand(0,10000);
             $pin_number = str_pad($rand_number, 4, '0', STR_PAD_LEFT);
             $this->recursive = -1;
            $pinnumber=$this->find('count',array(
                    'conditions' => array(
                        'OrganizationUser.organization_id' => $org_id,
                        'OrganizationUser.pin_number' => $pin_number
                        ),
                    'fields' => array(
                        'pin_number'
                        )
                ));
            if($pinnumber == '0')
            {
                $i = 10000;
            }
        }
        return $pin_number;


    }

    public function emailToEmployee($userid = null,$orgId = null)
    {
        $this->Behaviors->load('Containable');
        $userinfo = $this->find('first',array(
                'conditions' =>array(
                        'OrganizationUser.user_id' => $userid,
                        'OrganizationUser.organization_id' => $orgId
                    ),
                'contain' => array(
                    'User',
                    'Organization'
                    )
            ));
        $Email = new CakeEmail();
        $Email->template('welcome')
                    ->emailFormat('html')
                    ->to($userinfo['User']['email'])
                    ->from(array('noreply@shiftmate.com.au' => 'Shiftmate'))
                    ->subject('Employee Activation')
                    ->viewVars(array('userinfo' => $userinfo));
       return $Email->send();
    }
    public function getOrgUsers($orgId = null)
    {
        $this->Behaviors->load('Containable');
        $orgUser = $this->find('all',array(
                'conditions' =>array(
                        'OrganizationUser.organization_id' => $orgId
                    ),
                'contain' => array(
                        'User'
                    )
            ));
        return $orgUser;
    }
    public function emailForUserInfoEdit($orgUserId = null)
    {
        $OrgUserInfo = $this->find('first',array(
                'conditions' => array(
                        'OrganizationUser.id' => $orgUserId
                    )
            ));
        $Email = new CakeEmail();
        $Email->template('email_for_user_update')
                    ->emailFormat('html')
                    ->to($OrgUserInfo['User']['email'])

                    ->from(array('noreply@shiftmate.com.au' => 'Shiftmate'))

                    ->subject('Organization Profile Update')
                    ->viewVars(array('OrgUserInfo' => $OrgUserInfo));
        return $Email->send();
    } 
    
    public function getReviews($orgId = null){
        $this->Behaviors->load("containable");
        if($orgId != null){
            $conditions = array("OrganizationUser.organization_id"=>$orgId,"OrganizationUser.reviewdate <="=>date("Y-m-d"),"OrganizationUser.reviewperiod !="=>"0");
        }else{
            $conditions = array("OrganizationUser.reviewdate <="=>date("Y-m-d"),"OrganizationUser.reviewperiod !="=>"0");
        }
            $result = $this->find("all",array(
                "conditions"=>$conditions,
                "contain"=>array(
                    "Organization"=>array("fields"=>array("id","title","email","logo","logo_dir")),
                    "User"=>array("fields"=>array("id","fname","lname","email","address","image","image_dir")),
                    "Organizationrole"=>array("fields"=>array("id","title")),
                    "Group"=>array("fields"=>array("id","title"))
                )
            ));
        return $result;
    }
    
    public function updateReviews($id = null,$orgId = null){
        
        if($orgId != null){
            $conditions = array("OrganizationUser.organization_id"=>$orgId,"OrganizationUser.id"=>$id);
        }else{
            $conditions = array("OrganizationUser.id"=>$id);
        }
        $data = $this->find('first',array('conditions'=>$conditions));
        
        if(isset($data['OrganizationUser']) && !empty($data['OrganizationUser'])){
            
            //$date = new DateTime($data['OrganizationUser']['reviewdate']);
            $date = new DateTime();
            $date->add(new DateInterval("P".$data['OrganizationUser']['reviewperiod']));
            $update['reviewdate']= $date->format("Y-m-d");
            
            $this->id=$id;
            if($this->save($update)){
                return "true";
            }else{
                return "false";
            }
        }else{
            return "false";
        }
        
        
    }
    
    public function getOrganizationUsers($orgId=null,$page=null,$status=null,$limit=null){
        return $this->find('all',array(
                    "conditions"=>array('OrganizationUser.organization_id'=>$orgId,'OrganizationUser.status'=>$status),
                    'limit' => $limit, //int
                    'page' => $page, //int
                    ));
    }
    
    public function countUser($orgId = null ,$status =null){
        return $this->find('count',array(
            "conditions"=>array('OrganizationUser.organization_id'=>$orgId,'OrganizationUser.status'=>$status),
        ));
    }
    
    public function getOrgUserWage($orgId=null,$userId=null,$branch_id=null){
        return $this->find("first",array(
                    'conditions'=>array("OrganizationUser.organization_id"=>$orgId,"OrganizationUser.user_id"=>$userId,"OrganizationUser.branch_id"=>$branch_id),
                    'fields'=>array('OrganizationUser.wage','OrganizationUser.tax')
                ));
    }

     public function searchOrganizationUsers($orgId=null,$name=null,$branchId=null,$departmentId=null,$status=null){
        $this->Behaviors->load('Containable');
        $names = explode(" ",$name);
        
        $contain = array('User'=>['fields'=>array('id','fname','lname','email','address','phone','image_dir','image','gender','status','imagepath')],'Branch'=>['fields'=>array('title')],'Branch.Board');


        if($name == '0' && $departmentId == '0' && $branchId != '0'){

            $conditions = array('OrganizationUser.organization_id'=>$orgId,'OrganizationUser.status'=>$status,'OrganizationUser.branch_id'=>$branchId);

        } else if($branchId == '0' && $name != '0'){
            foreach($names as $n){
                if(!empty($n)){
                    $OR = array();
                    $OR = ['User.fname LIKE' => '%'.$n.'%','User.lname LIKE' => '%'.$n.'%'];
                    $conditions[] = array('OrganizationUser.organization_id'=>$orgId,'OrganizationUser.status'=>$status,"OR"=>$OR);
                }    
            }
        }
         else if($branchId != '0' && $name != '0' && $departmentId == '0'){

            foreach($names as $n){
                if(!empty($n)){
                    $OR = array();
                    $OR = ['User.fname LIKE' => '%'.$n.'%','User.lname LIKE' => '%'.$n.'%'];
                    $conditions[] = array('OrganizationUser.organization_id'=>$orgId,'OrganizationUser.status'=>$status,'OrganizationUser.branch_id'=>$branchId,"OR"=>$OR);
                }    
            }
        } else if($branchId != '0' && $departmentId != '0' && $name == '0' ){
            
            $conditions = array('OrganizationUser.organization_id'=>$orgId,'OrganizationUser.status'=>$status,'OrganizationUser.branch_id'=>$branchId);
       
        } else if($branchId != '0' && $departmentId != '0' && $name != '0'){

            foreach($names as $n){
                if(!empty($n)){
                    $OR = array();
                    $OR = ['User.fname LIKE' => '%'.$n.'%','User.lname LIKE' => '%'.$n.'%'];
                    $conditions[] = array('OrganizationUser.organization_id'=>$orgId,'OrganizationUser.status'=>$status,'OrganizationUser.branch_id'=>$branchId,"OR"=>$OR);
                }    
            }

        }
        
        
        $result = $this->find('all',array(
                        "conditions"=>$conditions,
                        "contain"=>$contain,
                        "recursive"=>2
                    ));
//debug($result);
        $results = array();
        if($departmentId != '0'){
            $boardUser = ClassRegistry::init('BoardUser');
            
            foreach($result as $key=>$r){
                //debug($r['User']['id']);
                if($boardUser->hasAny(['BoardUser.user_id'=>$r['User']['id'],'BoardUser.status'=>1,'BoardUser.board_id'=>$departmentId])){
                    $results[$key] = $r;
                } 
                
                
            } 
            return $results;
        } else {
            return $result;
        }    
        
    }

    public function getOrgListOfUser($userId = null)
    {
        $this->Behaviors->load('Containable');
        $org = $this->find('all',array(
                'conditions' =>array(
                        'OrganizationUser.user_id' => $userId,
                        'OrganizationUser.status'=>3
                    ),
                'group'=>'OrganizationUser.organization_id',
                'contain' => array(
                        'Organization'
                    )
            ));
        return $org;
    }

    public function findFieldChanges($organizationUserId,$existsBoards,$newBoards,$requestData){
        $this->Behaviors->load('Containable');
        
        $boardId = array();

        if(!empty($existsBoards)){
            foreach($existsBoards as $board){
                if(!in_array($board , $newBoards)){
                    $boardId['removedFromBoard'][] = $board;   
                }
            } 
        }
        
        if(!empty($newBoards)){
            foreach($newBoards as $board){
                if(!in_array($board, $existsBoards)){
                    $boardId['addedToBoard'][] = $board;
                }
            }
        }
        
        $board = ClassRegistry::init('Board');
        $newRecord = array();
        
        if(!empty($boardId)){
            if(isset($boardId['removedFromBoard']) && !empty($boardId['removedFromBoard'])){
                foreach($boardId['removedFromBoard'] as $r){
                    $newRecord['removed'][] = $board->findBoardName($r);
                }
            }

            if(isset($boardId['addedToBoard']) && !empty($boardId['addedToBoard'])){
                foreach($boardId['addedToBoard'] as $a){
                    $newRecord['added'][] = $board->findBoardName($a);
                }    
            } 
        }
        
        $result = $this->find('first',array(
                'conditions'=>array('OrganizationUser.id'=>$organizationUserId),
                'contain'=>array('Organizationrole'=>array('fields'=>['title']),'Organization'=>array('fields'=>['title'])),
                'fields'=>array('id','organization_id','organizationrole_id','wage','max_weekly_hour','notes','branch_id')
            ));

        if($result['OrganizationUser']['wage'] != $requestData['OrganizationUser']['wage']){
            $newRecord['wage'] = $requestData['OrganizationUser']['wage'];
            $newRecord['wage_pre'] = $result['OrganizationUser']['wage'];
        }

        if($result['OrganizationUser']['max_weekly_hour'] != $requestData['OrganizationUser']['max_weekly_hour']){
            $newRecord['max_weekly_hour'] = $requestData['OrganizationUser']['max_weekly_hour'];
            $newRecord['max_weekly_hour_pre'] = $result['OrganizationUser']['max_weekly_hour'];
        }

        if($result['OrganizationUser']['organizationrole_id'] != $requestData['OrganizationUser']['organizationrole_id']){
            $newRecord['role_id'] = $requestData['OrganizationUser']['organizationrole_id'];
            $newRecord['role_pre'] = $result['Organizationrole']['title'];
        }
        $newRecord['userId'] = $requestData['User']['id'];
        $newRecord['organization'] = $result['Organization']['title'];

        return $newRecord;
    }

    public function emailForUserEditByOrg($organizationUserId,$existsBoards,$newBoards,$requestData){
        $users = ClassRegistry::init('User');
        $result = $this->findFieldChanges($organizationUserId,$existsBoards,$newBoards,$requestData);
        $usersDetail = $users->findUserNameAndEmail($result['userId']);
        
        if(isset($result['role_id'])){
            $role = ClassRegistry::init('Organizationrole');
            $roles = $role->findRoleTitle($result['role_id']);
            $result['role'] = $roles['Organizationrole']['title'];
        }

        if(isset($result['wage']) || isset($result['max_weekly_hour']) || isset($result['role']) || isset($result['removed']) || isset($result['added'])){
        
        $result['name'] = $usersDetail['User']['fname'].' '.$usersDetail['User']['lname']; 
        $Email = new CakeEmail();
        $Email->template('email_for_user_edit_by_org')
                    ->emailFormat('html')
                    ->to($usersDetail['User']['email'])
                    ->from(array('noreply@shiftmate.com.au' => 'Shiftmate'))
                    ->subject('Profile Update by Organization')
                    ->viewVars(array('result' => $result));
            
        $Email->send();
        
        }
       
    }

    public function reviewNotification($orgId){
        $this->Behaviors->load('Containable');
        $contain = array('User'=>array('fname','lname'));
        $results = $this->find('all',array(
            'recursive'=>2,
            'conditions'=>array('OrganizationUser.organization_id'=>$orgId,'OrganizationUser.status'=>3),
            'fields'=>array('hire_date','reviewperiod','reviewtype','user_id','reviewdate','reviewnotification','id'),
            'contain'=>$contain
            ));

        $output = array();
        $review = array();
        $count = 0;
        if(!empty($results)){
            foreach($results as $r){
                if(isset($r['OrganizationUser']) && !empty($r['OrganizationUser'])){
                    
                    $hireDate = new DateTime($r['OrganizationUser']['hire_date']);
                    $reviewtype = $r['OrganizationUser']['reviewtype'];
                    $reviewperiod = $r['OrganizationUser']['reviewperiod'];

                    if($reviewtype == "Years"){
                        $interval = 'P'.$reviewperiod.'Y';
                    } else if($reviewtype == "Months"){
                        $interval = 'P'.$reviewperiod.'M';
                    } else {
                        $interval = 'P'.$reviewperiod.'W';
                    }

                    if($r['OrganizationUser']['reviewdate'] == '0000-00-00'){
                        
                        $joinedDate = $hireDate->add(new DateInterval($interval));
                    } 
                    else {
                        $joinedDate = new DateTime($r['OrganizationUser']['reviewdate']);
                    }
                    


                    $today = new DateTime(date('Y-m-d'));
                    $difference = $joinedDate->diff($today)->days;
                    if($difference == 1){
                        //$count++;
                        $output[$r['User']['id']]['user_id'] = $r['User']['id'];
                        $output[$r['User']['id']]['fname'] = $r['User']['fname'];
                        $output[$r['User']['id']]['lname'] = $r['User']['lname'];
                        $reviewNotification = $r['OrganizationUser']['reviewnotification'];
                        
                        if($reviewNotification == 0){

                            $this->id = $r['OrganizationUser']['id'];
                            $this->save(array('reviewnotification'=>1));
                            
                        }
                        
                        $output[$r['User']['id']]['reviewnotification'] = $reviewNotification;
                        
                    } else if($difference == 0){

                        $this->nextReviewDate($r['OrganizationUser']['id'],$hireDate,$reviewtype,$reviewperiod);
                  
                    }

                }
            }
        }
        
        return $output;
    }

     public function nextReviewDate($id,$hireDate,$reviewtype,$reviewperiod){
        if($reviewtype == "Years"){
            $interval = 'P'.$reviewperiod.'Y';
        } else if($reviewtype == "Months"){
            $interval = 'P'.$reviewperiod.'M';
        } else {
            $interval = 'P'.$reviewperiod.'W';
        }

        $this->id = $id;
        $reviewDate = $hireDate->add(new DateInterval($interval));
        $date = $reviewDate->format('Y-m-d');
        $this->save(array('reviewdate'=>$date));
        return $date;
    }

    public function listReviewNotification($orgId){

        $today = date('Y-m-d');

        // debug($today);
        $data = $this->find('all',array(
            'conditions'=>[ 
            'OrganizationUser.organization_id'=>$orgId,
            'DATEDIFF(reviewdate, "'.$today.'")' => 1
            ]

            ));
        return $data;
    }

}
