<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');
/**
 * User Model
 *
 * @property Roles $Roles
 * @property City $City
 * @property Country $Country
 * @property Boardmessage $Boardmessage
 * @property Board $Board
 * @property Branch $Branch
 * @property OrganizationUseravailability $OrganizationUseravailability
 * @property Organizationmessage $Organizationmessage
 * @property Organization $Organization
 * @property UserGroup $UserGroup
 * @property Useravailability $Useravailability
 * @property Userleave $Userleave
 */
class User extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'fbid' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),

		'gmailid' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'roles_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		// 'fname' => array(
		// 	'notEmpty' => array(
		// 		'rule' => array('notEmpty'),
		// 		//'message' => 'Your custom message here',
		// 		//'allowEmpty' => false,
		// 		//'required' => false,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// ),
		// 'lname' => array(
		// 	'notEmpty' => array(
		// 		'rule' => array('notEmpty'),
		// 		//'message' => 'Your custom message here',
		// 		//'allowEmpty' => false,
		// 		//'required' => false,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// ),
		// 'username' => array(
		// 	'notEmpty' => array(
		// 		'rule' => array('notEmpty'),
		// 		//'message' => 'Your custom message here',
		// 		//'allowEmpty' => false,
		// 		//'required' => false,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// ),
		// 'password' => array(
		// 	'notEmpty' => array(
		// 		'rule' => array('notEmpty'),
		// 		//'message' => 'Your custom message here',
		// 		//'allowEmpty' => false,
		// 		//'required' => false,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// ),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'dob' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		// 'address' => array(
		// 	'notEmpty' => array(
		// 		'rule' => array('notEmpty'),
		// 		//'message' => 'Your custom message here',
		// 		//'allowEmpty' => false,
		// 		//'required' => false,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// ),
		// 'phone' => array(
		// 	'notEmpty' => array(
		// 		'rule' => array('notEmpty'),
		// 		//'message' => 'Your custom message here',
		// 		//'allowEmpty' => false,
		// 		//'required' => false,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// ),
		// 'city_id' => array(
		// 	'numeric' => array(
		// 		'rule' => array('numeric'),
		// 		//'message' => 'Your custom message here',
		// 		//'allowEmpty' => false,
		// 		//'required' => false,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// ),
		// 'state' => array(
		// 	'notEmpty' => array(
		// 		'rule' => array('notEmpty'),
		// 		//'message' => 'Your custom message here',
		// 		//'allowEmpty' => false,
		// 		//'required' => false,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// ),
		// 'zipcode' => array(
		// 	'notEmpty' => array(
		// 		'rule' => array('notEmpty'),
		// 		//'message' => 'Your custom message here',
		// 		//'allowEmpty' => false,
		// 		//'required' => false,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// ),
		'country_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lastlogin' => array(
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

//		'image' => array(
//                    'thumbnailSizes' => array(
//                    'xvga' => '1024x768',
//                    'vga' => '640x480',
//                    'thumb' => '240x150'),
//                    'rule' => 'isFileUpload',
//                    'message' => 'File was missing from submission'
//                    )
	);

		public $actsAs = array(
        'Upload.Upload' => array(
            'image' => array(
                'fields' => array(
				                    'dir' => 'image_dir',
				                    'type' => 'image_type',
				                    'size' => 'image_size',
				                ),
                'thumbnailSizes' => array(
                    'thumb2' => '264x164'
                ),
                'x' =>  'x',
                'y'	=>	'y',
                'srcW' =>	'srcW',
                'srcH' =>	'srcH'
            )
        )
    );
//}
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'city_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Boardmessage' => array(
			'className' => 'Boardmessage',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
        'ShiftUser' => array(
			'className' => 'ShiftUser',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Board' => array(
			'className' => 'Board',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'BoardUser' => array(
			'className' => 'BoardUser',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Branch' => array(
			'className' => 'Branch',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
        'BranchUser' => array(
			'className' => 'BranchUser',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'OrganizationUseravailability' => array(
			'className' => 'OrganizationUseravailability',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Organizationmessage' => array(
			'className' => 'Organizationmessage',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		// 'Organization' => array(
		// 	'className' => 'Organization',
		// 	'foreignKey' => 'user_id',
		// 	'dependent' => false,
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => '',
		// 	'limit' => '',
		// 	'offset' => '',
		// 	'exclusive' => '',
		// 	'finderQuery' => '',
		// 	'counterQuery' => ''
		// ),
		'UserGroup' => array(
			'className' => 'UserGroup',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Useravailability' => array(
			'className' => 'Useravailability',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
                'OrganizationUser' => array(
			'className' => 'OrganizationUser',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Userleave' => array(
			'className' => 'Userleave',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Permanentshift' => array(
			'className' => 'Permanentshift',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Leaveholiday' => array(
			'className' => 'Leaveholiday',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),

		'Shiftswap' => array(
			'className' => 'Shiftswap',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),

		'Rating' => array(
			'className' => 'Rating',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Requesttimeoff' => array(
			'className' => 'Requesttimeoff',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Userfeedback' => array(
			'className' => 'Userfeedback',
			'foreignKey' => 'user_id',
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
	);
        
        public $hasOne = array(
		'Organization' => array(
			'className' => 'Organization',
			'foreignKey' => 'user_id',
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
       	);

/*public function beforeSave($options = array()) {
         //  debug($this->request->data);die();
       // if (!$this->id) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
        //}
        return true;
        
        
    }*/
    public function beforeSave($options = array()) {
            if (isset($this->data[$this->alias]['password'])) {
                $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
            }
            return true;
        }
        
        public function userDetail($user_id = NULL, $status=1){
            $this->Behaviors->load('Containable');
          //  $this->recursive = 2;
           
                $contain = array(
                    'Role',
                    'City',
                    'Country',
                    'Organization',
                    'OrganizationUser',
                    'OrganizationUser.Organization',
                    'OrganizationUser.Branch'
                );
                
           
            
            $userDetail = $this->find('first', array(

                'contain' => $contain,
                'conditions'=>array(
                    'User.id'=>$user_id,
                    'User.status'=>$status
                )
            ));
            return $userDetail;
        }
        
        public function orgDetail($user_id = NULL, $status=1){
            $this->Behaviors->load('Containable');
          //  $this->recursive = 2;
            $userDetail = $this->find('first', array(

                'contain' => array(
                    'Role',
                    'City',
                    'Country',

                    'Organization'                   
                ),
                'conditions'=>array(
                    'User.id'=>$user_id,
                    'User.status'=>$status
                )
            ));
            return $userDetail;
        }
        
        /* get orgnaization id from user login if user is itself login as organization 
            for this user status must be 2 which determines the organization login
         *          */
        public function getOrgId($user_id = NULL){
            $orgUserDetail = $this->OrganizationUser->find('first', array(
                'fields' => array('OrganizationUser.organization_id'),
                'conditions'=>array(
                    'OrganizationUser.user_id' => $user_id
                )
            ));
            $orgId = $orgUserDetail['OrganizationUser']['organization_id'];
            
            return $orgId;
        }
         public function getOrgIdForOrganization($user_id = NULL){
             $organization = ClassRegistry::init('Organization');
                $orgId = $organization->getOrgId($user_id);
                return $orgId;
         }
        public function getUsersRolesInOrganizationBranches($user_id = NULL){
            $orgLists = $this->OrganizationUser->find('all', array(
                'conditions' => array(
                    'OrganizationUser.user_id' => $user_id
                )
            ));
        }
        
      
        
        public function userLists(){
            $this->Behaviors->load('Containable');
            $users = $this->find('all', array(
                'contain' => false,
                'fields' => array('User.id','User.fname', 'User.lname'),
                'conditions' => array(
                    'User.status' => array('1','2')
                )
            ));
            return $users;
        }
        
        public function getUserListSentMessage($user_id){
            $users = $this->userLists();
            $Message = ClassRegistry::init('Message');
            $sentMessage = $Message->mySentMessage($user_id);
            $output['userList'] = $users;
            $output['sentMessage'] = $sentMessage;
            
            return $output;
        }
        
        public function getUserListReceiveMessage($user_id){
            $users = $this->userLists();
            $Message = ClassRegistry::init('Message');
            $receiveMessage = $Message->myReceiveMessage($user_id);
            $output['userList'] = $users;
            $output['receiveMessage'] = $receiveMessage;
            
            return $output;
        }
        
        public function getBoardListReceiveMessage($user_id){
            $this->Behaviors->load('Containable');
            $userList = $this->find('first', array(
                'contain' => array(
                    
                    'OrganizationUser' => array('fields'=> array('OrganizationUser.organization_id', 'OrganizationUser.branch_id')),
                    'OrganizationUser.Organization' => array('fields' => array('title')),
                    'OrganizationUser.Branch' => array('fields' => array('Branch.title')),
                    'OrganizationUser.Branch.Board',
                    'OrganizationUser.Branch.Board.Boardmessage',
                    'OrganizationUser.Branch.Board.Boardmessage.User' => array('fields'=> array('User.id', 'User.fname', 'User.lname'))
                    ),
                'fields' => array('id'),
                'conditions' => array(
                    'User.id' => $user_id
                )
            ));
            foreach($userList['OrganizationUser'] as $orgList){
                foreach($orgList['Branch']['Board'] as $boardList){
                    $output[$orgList['Organization']['title']][$orgList['Branch']['title']][] = $boardList;
                }
            }
            
            return $output;
        }
        
       public function getOrgListReceiveMessage($user_id){
            $this->Behaviors->load('Containable');
            $userList = $this->find('first', array(
                'contain' => array(
                    'OrganizationUser' => array('fields'=> array( 'DISTINCT OrganizationUser.organization_id')),
                    'OrganizationUser.Organization' => array('fields' => array('id','title')),
                    'OrganizationUser.Organization.Organizationmessage',
                    'OrganizationUser.Organization.Organizationmessage.User'
                    ),
               // 'fields' => array('id'),
                'conditions' => array(
                    'User.id' => $user_id
                )
            ));
           /* foreach($userList['OrganizationUser'] as $orgList){
                //foreach($orgList['Organization']['Organizationmessage'] as $boardList){
                    $output[$orgList['Organization']['title']][$orgList['Branch']['title']][] = $boardList;
                }
            }*/

            
            return $userList;
        }
        /*by rabi*/
       public function passwordHash($old_password) {
            return   AuthComponent::password($old_password);
           
        }
         public function emailToNewEmployee($userid,$orgId,$password)
	    {
	      
	       $this->Behaviors->load('Containable');
	       $userinfo = $this->find('first',array(
	                'conditions' =>array(
	                        'User.id' => $userid
	                    ),
	                'contain' => array(
	                	'OrganizationUser.Organization',
	                    'OrganizationUser'=>array('conditions'=>array('OrganizationUser.organization_id' => $orgId)),

	                    )
	            ));
	      // debug($userinfo);
	        $Email = new CakeEmail();
	        $Email->config('default')->template('new_user')
	                    ->emailFormat('html')
	                    ->subject('Activate Employee')
	                    ->to($userinfo['User']['email'])
	                    ->from(array('noreply@shiftmate.com.au' => 'Shiftmate'))
	                    //->viewVars(array('userinfo' => $userinfo));
	                    ->viewVars(compact('userinfo','orgId','password'));
	       return $Email->send();
	    } 

	     public function randomGenerate(){
        //Under the string $Caracteres you write all the characters you want to be used to randomly generate the code.
        $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
        $QuantidadeCaracteres = strlen($Caracteres);
        $QuantidadeCaracteres--;

        $Hash=NULL;
            for($x=1;$x<=10;$x++){
                $Posicao = rand(0,$QuantidadeCaracteres);
                $Hash .= substr($Caracteres,$Posicao,1);
            }

        return $Hash;
    }
    public function emailToRegisterEmployee($userid)
        {
          
            $this->recursive=-1;
            $userinfo = $this->find('first',array(
                'conditions' => array(
                    'User.id' => $userid
                    )
            ));
            // debug($userinfo);
            $Email = new CakeEmail();
            $Email->template('email_newemploy')
                        ->emailFormat('html')
                        ->to($userinfo['User']['email'])
                        ->from(array('noreply@shiftmate.com.au' => 'Shiftmate'))
                        ->subject('Employee Activation')
                        ->viewVars(array('userinfo' => $userinfo));
            return $Email->send();
        } 
         public function emailToEmployeeAssignByOrg($orgUserId,$userid)
        {
          
            $this->recursive=-1;
           $userinfo = $this->find('first',array(
                'conditions' => array(
                    'User.id' => $userid
                    )
            ));
          // debug($userinfo);
            $Email = new CakeEmail();
            $Email->template('email_newemploy_assignby_org')
                        ->emailFormat('html')
                        ->to($userinfo['User']['email'])

                        ->from(array('noreply@shiftmate.com.au' => 'Shiftmate'))

                        ->subject('Employee Activation')
                        ->viewVars(compact('userinfo','orgUserId'));
            return $Email->send();
        } 
         
        public function emailToRegisterOrg($userid)
        {
            $this->Behaviors->load('Containable');
            $this->recursive=-1;
           $userinfo = $this->find('first',array(
                'conditions' => array(
                    'User.id' => $userid
                    ),
                'contain' => array(
                    'Organization'
                    )
            ));
            $Email = new CakeEmail();
            $Email->template('email__to_register_org')
                        ->emailFormat('html')
                        ->to($userinfo['User']['email'])

                        ->from(array('noreply@shiftmate.com.au' => 'Shiftmate'))

                        ->subject('Organization Activation')
                        ->viewVars(array('userinfo' => $userinfo));
            return $Email->send();
        } 
        
        public function loginUserRelationToOther($user_id){
            $this->Behaviors->load('Containable');
            $user = $this->find('first', array(
                'contain' => array(
                        'OrganizationUser'=>['conditions'=>['OrganizationUser.status'=>3]],
                        //'Board.Branch',
                       'OrganizationUser.Organization',
                        'BoardUser',
                        'OrganizationUser.Branch' => array('fields'=>array('id', 'title')),
                        'Board'=> array('fields'=>array('id','title')),
                        'BoardUser.Board'=> array('fields'=>array('id','title')),
                        'Branch'=> array('fields'=>array('id', 'title'))
                       
                    ),
                'conditions' => array(
                        'User.id' => $user_id,
                    ),
            ));
            return $user;
        }

        public function findByEmail($userId,$orgUserId)

        {
    		$this->Behaviors->load('Containable');
             //$this->recursive=1;
           	$userinfo = $this->find('first',array(
           		'conditions' => array(
           				'User.id'=>$userId
           			),
           		'contain'=>array(
           			'OrganizationUser.Organization',
           			'OrganizationUser'=>array('conditions'=>array('OrganizationUser.id' => $orgUserId)),
           			)
           	));
           //debug($userinfo);
            $Email = new CakeEmail();
            $Email->template('employee_add_by_email')
                        ->emailFormat('html')
                        ->to($userinfo['User']['email'])

                        ->from(array('noreply@shiftmate.com.au' => 'Shiftmate'))

                        ->subject('Employee Activation')
                        ->viewVars(array('userinfo' => $userinfo));
            return $Email->send();
        }
        /*ends here*/
		//******************************************************************
        public function resetPasswordByEmail($userId)
        {
            $this->Behaviors->load('Containable');
           	$userinfo = $this->find('first',array(
                'conditions' => array(
                        'User.id'=>$userId
                    ),
                'contain' => false
            ));
           //debug($userinfo);
            $Email = new CakeEmail();
            $Email->template('passwordreset')
                        ->emailFormat('html')
                        ->to($userinfo['User']['email'])
                        ->from(array('noreply@shiftmate.com.au' => 'Shiftmate'))
                        ->subject('Forget Password')
                        ->viewVars(array('userinfo' => $userinfo));

                        
            return $Email->send();

        }  
        public function checkImage($folderImage,$image,$gender,$genImage)
	    {
	        if($image && $folderImage){
	            return $genImage;
	          }
	          
	          else
	          {
	            if ($gender == '0') {

	              return 'webroot/files/user_image/defaultuser.png';
	            }
	            else if($gender == '1')
	            {
	              return 'webroot/files/user_image/femaleadmin.png';

	            }
	            else
	            {
	              return 'webroot/files/user_image/noimage.png';
	            }
	          }
	    }
	    public function loginUserRelationToOther_model($user_id)
	    {

	        $user = $this->loginUserRelationToOther11($user_id);
	       // debug($user);
	        if(isset($user['Board']) && !empty($user['Board'])){
	            foreach ($user['Board'] as $board) {
	                  $userAsBoardManager[$board['id']] = $board['title'];
	            }
	        }else{
	            $userAsBoardManager = '';
	        }

	        if(isset($user['BoardUser']) && !empty($user['BoardUser'])){

	            foreach ($user['BoardUser'] as $boarduser) {
	                $userInBoards[$boarduser['Board']['id']] = $boarduser['Board']['title'];
	            }
	        }
	        else{
	           $userInBoards = ''; 
	        }

	        if (isset($user['Branch']) && !empty($user['Branch'])) {
	             foreach ($user['Branch'] as $branch) {
	                $userAsBranchManager[$branch['id']] = $branch['title'];
	            }
	        }
	        else{
	            $userAsBranchManager = '';
	        }

	        if (isset($user['OrganizationUser']) && !empty($user['OrganizationUser'])) {
	            foreach ($user['OrganizationUser'] as $organization) {
	                $userOrganization[$organization['Organization']['id']][$organization['Organization']['title']][$organization['branch_id']] = $organization['Branch']['title'];
	            }
	        }
	        else{
	            $userOrganization ='';
	        }


	        $result['boardManager'] = $userAsBoardManager;
	        $result['board'] = $userInBoards;
	        $result['branchManager'] = $userAsBranchManager;
	         $result['userOrganization'] = $userOrganization;
	        
	       // debug($result);
	        // $this->set(array(
	        //     'output' => $result,
	        //     '_serialize' => array('output')
	        // ));
	         //debug($result);
	         //$result = 1;

	        return $result;
	       
	    }
	    public function loginUserRelationToOther11($user_id){
            $this->Behaviors->load('Containable');
            $user = $this->find('first', array(
                'contain' => array(
                        'OrganizationUser'=>array('conditions' => array('OrganizationUser.branch_id !=' => 0)),
                        //'Board.Branch',
                       'OrganizationUser.Organization',
                        'BoardUser',
                        'OrganizationUser.Branch' => array('fields'=>array('id', 'title')),
                        'Board'=> array('fields'=>array('id','title')),
                        'BoardUser.Board'=> array('fields'=>array('id','title')),
                        'Branch'=> array('fields'=>array('id', 'title'))
                       
                    ),
                'conditions' => array(
                        'User.id' => $user_id 
                    ),
            ));
            return $user;
        }

        public function findUserNameAndEmail($userId){
        	return $this->find('first',array(
        		'conditions'=>array('User.id'=>$userId),
        		'recursive'=>-1,
        		'fields'=>array('fname','lname','email')
        		));
        }
}
