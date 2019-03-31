<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');
    
    
    public function loginUserRelationToOther($user_id)
    {

        $user = $this->User->loginUserRelationToOther($user_id);
       // debug($user);die();

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

                    $this->set('output', $result);
            $this->set(array('_serialize'=> array('output'), '_jsonp'=>true));
        
       
    }


    public function getOrgListReceiveMessage($user_id){
        $userList = $this->User->getOrgListReceiveMessage($user_id);
        
        $this->set(array(
            'output' => $userList,
            '_serialize' => array('output'),
            '_jsonp'=>true
        ));
        
    }
    
    public function getBoardListReceiveMessage($user_id){
        $userList = $this->User->getBoardListReceiveMessage($user_id);
        
        $this->set(array(
            'output' => $userList,
            '_serialize' => array('output'),
            '_jsonp'=>true
        ));
        
    }
    
    public function getUserListSentMessage($user_id){
        $userListSentMessage = $this->User->getUserListSentMessage($user_id);
        
        $this->set(array(
            'userListSentMessage' => $userListSentMessage,
            '_serialize' => array('userListSentMessage'),
            '_jsonp'=>true
        ));
    }
    
    public function getUserListReceiveMessage($user_id){
        $userListReceiveMessage = $this->User->getUserListReceiveMessage($user_id);
        
        $this->set(array(
            'userListReceiveMessage' => $userListReceiveMessage,
            '_serialize' => array('userListReceiveMessage'),
            '_jsonp'=>true
        ));
    }
    
    public function userList(){
        $users = $this->User->userLists();
        
        $this->set(array(
                    'users' => $users,
                    '_serialize' => array('users'),
                    '_jsonp'=>true
                ));
    }
    
    public function random_string($id=null) {
        $length=9;
        $key = '';
        $keys = array_merge(range(0, 9), range('A', 'Z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        $access_token = $key.$id;
        $refresh_token = md5($access_token.$id.$key);
        $token['access_token'] = $access_token;
        $token['refresh_token'] = $refresh_token;
        return $token;
    }
    
    
    /*public function test($user_id){
        $userDetail['organization_id'] = $this->User->getOrgIdForOrganization($this->Auth->User('id'));
         debug($userDetail);
        
    }*/


    public function login() 
    {
           if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
           {
                    if($this->Auth->login()) 
                    {
                        //die();
                        //return $this->redirect($this->Auth->redirect

                        if (isset($this->request->data['User']['remember_me']) && $this->request->data['User']['remember_me'] == 1)
                        {
                            unset($this->request->data['User']['remember_me']);

                            $this->request->data['User']['password'] = $this->User->passwordHash($this->request->data['User']['password']);

                            $this->Cookie->write('remember_me_cookie', $this->request->data['User'], true, '2 weeks');

                        }

                                           $token = $this->random_string($this->Session->read('Auth.User.id'));
                                           $this->User->id = $this->Auth->User('id');
                                           $update['User']['access_token'] = $token['access_token'];
                                           $update['User']['refresh_token'] = $token['refresh_token'];
                                           $datetime = date('Y-m-d H:i:s');
                                           $expiry_datetime = date('y-m-d H:i:s', strtotime($datetime)+5*60);
                                           $update['User']['token_expiry_date'] = $expiry_datetime;
                                           
                                           $user_status = $this->Auth->User('status');
                                           $this->loadModel('Organization');
                                           if($user_status == 2){
                                               $userDetail['organization_id'] = $this->User->getOrgIdForOrganization($this->Auth->User('id'));
                                               
                                           }else{
                                               $userDetail['organization_id'] = 0;
                                           }
                                           
                                           if($this->User->save($update)){
                                               $userDetail['token'] = $token;
                                               $userDetail['user_id'] = $this->Auth->User('id');
                                               $userDetail['status'] = $user_status;
                                               
                                           }
                                
                                /*$this->User->read(null, $this->Auth->User('id'));
                                $this->User->set('access_token', $token);
                                if($this->User->save()){   
                               
                                }*/
                    }
                    else
                    {
                        $userDetail['status'] = 0;
                        
                    }
             
                
                // $userDetail = $this->Cookie->read('remember_me_cookie');
                $this->set(array(
                    'message' => $userDetail,
                    '_serialize' => array('message'),
                    '_jsonp'=>true
                ));
            }
    }

    public function gmaillogin()
    {
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
           {

                if(isset($this->request->data['User']['gmailid']) && !empty($this->request->data['User']['gmailid']))
                {
                    $this->User->recursive=0;

                    $email = $this->request->data['User']['email'];
                    $gmailid = $this->request->data['User']['gmailid'];
                    $fname = $this->request->data['User']['fname'];
                    $lname = $this->request->data['User']['lname'];
                    $local_user = $this->User->find('first', array('conditions'=>['User.email'=>$email]));

                    if($local_user)
                    {
                        if($this->Auth->login($local_user['User']))
                        {
                            $token = $this->random_string($this->Session->read('Auth.User.id'));
                            $this->User->id = $this->Auth->User('id');
                            $update['User']['access_token'] = $token['access_token'];
                            $update['User']['refresh_token'] = $token['refresh_token'];
                            $datetime = date('Y-m-d H:i:s');
                            $expiry_datetime = date('y-m-d H:i:s', strtotime($datetime)+5*60);
                            $update['User']['token_expiry_date'] = $expiry_datetime;
                             
                            $user_status = $this->Auth->User('status');
                            $this->loadModel('Organization');
                            if($user_status == 2){
                                   $userDetail['organization_id'] = $this->User->getOrgIdForOrganization($this->Auth->User('id'));
                                   
                            }else{
                                   $userDetail['organization_id'] = 0;
                            }
                               
                            if($this->User->save($update)){
                                   $userDetail['token'] = $token;
                                   $userDetail['user_id'] = $this->Auth->User('id');
                                   $userDetail['status'] = $user_status;
                                   
                            }
                        }
                    }
                    else
                    {
                        $data['User']=array(
                            'fname'=>$fname,
                            'lname'=>$lname,
                            'email'=>$email,
                            'gmailid'=>$gmailid,
                            'password'=>'test',
                            'role_id'=>3,
                            'status'=>1
                            );

                        // $userDetail = $data;

                        if($this->User->save($data,array('validate' => false)))
                            {
                                $currentId = $this->User->id;

                                $gmail_user = $this->User->find('first', array('conditions'=>['User.id'=>$currentId]));

                                if($this->Auth->login($gmail_user['User']))
                                    {
                                        $token = $this->random_string($this->Session->read('Auth.User.id'));
                                        $this->User->id = $this->Auth->User('id');
                                        $update['User']['access_token'] = $token['access_token'];
                                        $update['User']['refresh_token'] = $token['refresh_token'];
                                        $datetime = date('Y-m-d H:i:s');
                                        $expiry_datetime = date('y-m-d H:i:s', strtotime($datetime)+5*60);
                                        $update['User']['token_expiry_date'] = $expiry_datetime;
                                         
                                        $user_status = $this->Auth->User('status');
                                        $this->loadModel('Organization');
                                        if($user_status == 2){
                                               $userDetail['organization_id'] = $this->User->getOrgIdForOrganization($this->Auth->User('id'));
                                               
                                        }else{
                                               $userDetail['organization_id'] = 0;
                                        }
                                           
                                        if($this->User->save($update)){
                                               $userDetail['token'] = $token;
                                               $userDetail['user_id'] = $this->Auth->User('id');
                                               $userDetail['status'] = $user_status;
                                               
                                        }
                                    }
                            }

                    }
                }


                $this->set(array(
                    'message' => $userDetail,
                    '_serialize' => array('message'),
                    '_jsonp'=>true
                ));
            }
    }

    public function checkFbEmail($email = null, $fbId = null)
    {
        
            // $conditions = array('User.email'=>$email, 'OR'=>['User.fbid'=>$fbId]);

            if($this->User->findAllByEmailOrFbid($email, $fbId))
            {
                $this->User->recursive = -1;
                $user = $this->User->findAllByEmailOrFbid($email, $fbId);
                $status = $user['0']['User']['status'];
                $output = 1;
            }
            else
            {
                $status= 0;
                $output = 0;
            }
            $this->set(array("status"=>$status,"output"=>$output, "_serialize"=>['output', 'status'], "_jsonp"=>true));
        
    }

    public function checkGmailEmail($email = null, $gmailId = null)
    {
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
        {
            // $conditions = array('User.email'=>$email, 'OR'=>['User.fbid'=>$fbId]);

            if($this->User->findAllByEmailOrGmailid($email, $gmailId))
            {
                $this->User->recursive = -1;
                $user = $this->User->findAllByEmailOrGmailid($email, $gmailId);
                $status = $user['0']['User']['status'];
                $output = 1;
            }
            else
            {
                $status= 0;
                $output = 0;
            }
            $this->set(array('status'=>$status,'output'=>$output, '_serialize'=>['output', 'status'], '_jsonp'=>true));
        }
    }
    public function fblogin()
    {
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
        {

                    $this->User->recursive=0;

                    $email = $this->request->data['User']['email'];
                    $fbid = $this->request->data['User']['fbid'];
                    $fname = $this->request->data['User']['fname'];
                    $lname = $this->request->data['User']['lname'];

                 
                    if(isset($email) && !empty($email))
                    {
                        
                        $options = array('conditions'=>['User.email'=>$email]);
                        $user = $this->User->find('first', $options);

                        $this->User->id = $user['User']['id'];

                        $this->User->saveField('fbid',$fbid);
                    }

                    $local_user = $this->User->find('first', array(
                        'conditions'=>
                            [
                                'User.fbid'=>$fbid
                            ]
                            ));


                    if($local_user)
                    {
                        if($this->Auth->login($local_user['User']))
                        {
                            $token = $this->random_string($this->Session->read('Auth.User.id'));
                            $this->User->id = $this->Auth->User('id');
                            $update['User']['access_token'] = $token['access_token'];
                            $update['User']['refresh_token'] = $token['refresh_token'];
                            $datetime = date('Y-m-d H:i:s');
                            $expiry_datetime = date('y-m-d H:i:s', strtotime($datetime)+5*60);
                            $update['User']['token_expiry_date'] = $expiry_datetime;
                             
                            $user_status = $this->Auth->User('status');
                            $this->loadModel('Organization');
                            if($user_status == 2){
                                   $userDetail['organization_id'] = $this->User->getOrgIdForOrganization($this->Auth->User('id'));
                                   
                            }else{
                                   $userDetail['organization_id'] = 0;
                            }
                               
                            if($this->User->save($update)){
                                   $userDetail['token'] = $token;
                                   $userDetail['user_id'] = $this->Auth->User('id');
                                   $userDetail['status'] = $user_status;
                                   
                            }
                        }
                    }

                    $this->set(array(
                    'message' => $userDetail,
                    '_serialize' => array('message'),
                    '_jsonp'=>true
                ));
        }
                
    }
    public function fbregistration()
    {
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
           {

                $emailValidation = $this->request->data['emailValidation'];

                $conditions = array('User.email'=> $this->request->data['User']['email']);

                if ($this->User->hasAny($conditions)) {
                    if($emailValidation == 0)
                    {

                            $this->User->recursive=0;
                            $this->request->data['User']['role_id'] = 3;
                            $this->request->data['User']['status'] = 1;
                            $this->request->data['User']['image'] = 'fbimage.jpg';
                            $this->request->data['User']['imagepath']= 'http://graph.facebook.com/'.$this->request->data['User']['fbid'].'/picture?type=large';
                            // $userDetail = $data;

                            if($this->User->save($this->request->data,array('validate' => false)))
                                {

                                    $currentId = $this->User->id;
                                    $fb_user = $this->User->find('first', array('conditions'=>['User.id'=>$currentId]));
                                    if($this->Auth->login($fb_user['User']))
                                        {
                                            $token = $this->random_string($this->Session->read('Auth.User.id'));
                                            $this->User->id = $this->Auth->User('id');
                                            $update['User']['access_token'] = $token['access_token'];
                                            $update['User']['refresh_token'] = $token['refresh_token'];
                                            $datetime = date('Y-m-d H:i:s');
                                            $expiry_datetime = date('y-m-d H:i:s', strtotime($datetime)+5*60);
                                            $update['User']['token_expiry_date'] = $expiry_datetime;
                                            $update['User']['image_dir'] = $currentId;
                                            $user_status = $this->Auth->User('status');
                                            $this->loadModel('Organization');
                                            if($user_status == 2){
                                                   $userDetail['organization_id'] = $this->User->getOrgIdForOrganization($this->Auth->User('id'));
                                                   
                                            }else{
                                                   $userDetail['organization_id'] = 0;
                                            }
                                               
                                            if($this->User->save($update)){
                                                   $userDetail['token'] = $token;
                                                   $userDetail['user_id'] = $this->Auth->User('id');
                                                   $userDetail['status'] = $user_status;
                                                   
                                            }
                                        }

                                        $output = ['emailValidation'=>0,'userId'=>$currentId, 'message'=>'Saved successfully.'];
                                }
                    }
                }
                else
                {           
                        $randomgenerate = $this->User->randomGenerate();
                        $this->request->data['User']['status'] = 4;
                        $this->request->data['User']['role_id'] = 3;
                        $this->request->data['User']['random_activation'] = $randomgenerate;
                       // $this->request->data['User']['email'] = $email;
                        if ($this->User->save($this->request->data, array('validate'=>false))) {

                            $currentId = $this->User->id;
                            $userId = $this->User->id;
                            $this->User->emailToRegisterEmployee($userId);
                            $output = array(
                                "message" => 'Please log in to your email for your activation.',
                                "emailValidation"=>1
                            );
                        } else {
                            $output = array(
                                "message" => "Employee Registration Fail. Please Try Again.",
                                "emailValidation"=>1
                            );
                        }

                        $userDetail = false;
                }
                
                $this->loadModel('Useravailability');
                $data = array();
                $data['Useravailability']['user_id']=$currentId;
                $data['Useravailability']['organization_id']=0;
                $data['Useravailability']['status']= 0;
                for($i=1;$i<=7;$i++)
                {
                    $data['Useravailability']['day_id']=$i;
                    $this->Useravailability->create();

                    $this->Useravailability->save($data);
                }

                $this->set(array(
                    'output'=>$output,
                    'message' => $userDetail,
                    '_serialize' => array('message', 'output'),
                    '_jsonp'=>true
                ));
            }
    }

    public function gmailregistration()
    {
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
           {

                $emailValidation = $this->request->data['emailValidation'];

                $conditions = array('User.email'=> $this->request->data['User']['email']);

                if ($this->User->hasAny($conditions)) {
                    if($emailValidation == 0)
                    {

                            $this->User->recursive=0;
                            $this->request->data['User']['role_id'] = 3;
                            $this->request->data['User']['status'] = 1;
                            $this->request->data['User']['image'] = 'gmailimage.jpg';
                            // $userDetail = $data;

                            if($this->User->save($this->request->data,array('validate' => false)))
                                {

                                    $currentId = $this->User->id;

                                    $gmail_user = $this->User->find('first', array('conditions'=>['User.id'=>$currentId]));
                                    if($this->Auth->login($gmail_user['User']))
                                        {
                                            $token = $this->random_string($this->Session->read('Auth.User.id'));
                                            $this->User->id = $this->Auth->User('id');
                                            $update['User']['access_token'] = $token['access_token'];
                                            $update['User']['refresh_token'] = $token['refresh_token'];
                                            $datetime = date('Y-m-d H:i:s');
                                            $expiry_datetime = date('y-m-d H:i:s', strtotime($datetime)+5*60);
                                            $update['User']['token_expiry_date'] = $expiry_datetime;
                                            $update['User']['image_dir'] = $currentId;
                                            $user_status = $this->Auth->User('status');
                                            $this->loadModel('Organization');
                                            if($user_status == 2){
                                                   $userDetail['organization_id'] = $this->User->getOrgIdForOrganization($this->Auth->User('id'));
                                                   
                                            }else{
                                                   $userDetail['organization_id'] = 0;
                                            }
                                               
                                            if($this->User->save($update)){
                                                   $userDetail['token'] = $token;
                                                   $userDetail['user_id'] = $this->Auth->User('id');
                                                   $userDetail['status'] = $user_status;
                                                   
                                            }
                                        }

                                        $output = ['emailValidation'=>0,'userId'=>$currentId, 'message'=>'Saved successfully.'];
                                }
                    }
                }
                else
                {           
                        $randomgenerate = $this->User->randomGenerate();
                        $this->request->data['User']['status'] = 4;
                        $this->request->data['User']['role_id'] = 3;
                        $this->request->data['User']['random_activation'] = $randomgenerate;
                       // $this->request->data['User']['email'] = $email;
                        if ($this->User->save($this->request->data, array('validate'=>false))) {
                            $currentId =$this->User->id;
                            $userId = $this->User->id;
                            $this->User->emailToRegisterEmployee($userId);
                            $output = array(
                                "message" => 'Please log in to your email for your activation.',
                                "emailValidation"=>1
                            );
                        } else {
                            $output = array(
                                "message" => "Employee Registration Fail. Please Try Again.",
                                "emailValidation"=>1
                            );
                        }

                        $userDetail = false;
                }

                $this->loadModel('Useravailability');
                $data = array();
                $data['Useravailability']['user_id']=$currentId;
                $data['Useravailability']['organization_id']=0;
                $data['Useravailability']['status']= 0;
                for($i=1;$i<=7;$i++)
                {
                    $data['Useravailability']['day_id']=$i;
                    $this->Useravailability->create();

                    $this->Useravailability->save($data);
                }
                


                $this->set(array(
                    'output'=>$output,
                    'message' => $userDetail,
                    '_serialize' => array('message', 'output'),
                    '_jsonp'=>true
                ));
            }
    }

        public function logout() {

            $this->Cookie->delete('remember_me_cookie');
            return $this->redirect($this->Auth->logout());
        }
    
    public function userDetail($user_id = NULL, $status = 1){
        $userDetail = $this->User->userDetail($user_id, $status);
        //debug($userDetail);
        $this->set(array(
                    'message' => $userDetail,
                    '_serialize' => array('message'),
                    '_jsonp'=>true
                ));
    }
    
    public function orgDetail($user_id = NULL, $status = 1){
        $userDetail = $this->User->orgDetail($user_id, $status);
        //debug($userDetail);
        $this->set(array(
                    'message' => $userDetail,
                    '_serialize' => array('message'),
                    '_jsonp'=>true
                ));
    }
    
    public function myProfile($user_id = NULL){
        $userDetail = $this->User->userDetail($user_id);
        // debug($userDetail);
        $this->set(array(
                    'userDetail' => $userDetail,
                    '_serialize' => array('userDetail'),
                    '_jsonp'=>true
                ));
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->User->Role->find('list');
        $cities = $this->User->City->find('list');
        $countries = $this->User->Country->find('list');
        $this->set(compact('roles', 'cities', 'countries'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
        $roles = $this->User->Role->find('list');
        $cities = $this->User->City->find('list');
        $countries = $this->User->Country->find('list');
        $this->set(compact('roles', 'cities', 'countries'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash(__('The user has been deleted.'));
        } else {
            $this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
     
    public function orgRegistration() {
        // debug( $this->User->emailToRegisterOrg($userId));
        // die();
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
            //debug($this->request->data);
            $randomgenerate = $this->User->randomGenerate();
            $this->request->data['User']['random_activation'] = $randomgenerate;
            $this->request->data['User']['status'] = 5;
            $this->request->data['Organization']['status'] = 1;
            $this->request->data['Organization']['email'] = $this->request->data['User']['email'];
            $this->request->data['User']['role_id'] = 2;
            //$output = $this->request->data;
            
            $this->User->create();
            if ($this->User->saveAssociated($this->request->data, array('deep' => true))) {
                $userId = $this->User->id;
                $this->User->emailToRegisterOrg($userId);
                $output = array(
                    "params" => $this->request,
                    "method" => $this->method,
                    "action" => "orgRegistration",
                    "status" => 1,
                    "user" => $this->request->data,
                    "error" => array("validation" => "Registration Successfull")
                );
            } else {
                $output = array(
                    "params" => $this->request,
                    "method" => $this->method,
                    "action" => "orgRegistration",
                    "status" => 0,
                    "user" => $this->request->data,
                    "error" => array("validation" => "Registration fail")
                );
            }


            $this->set('output', $output);
            $this->set(
                    array(
                        "_serialize" => array('output'),
                        "_jsonp"=>true
                    )
            );
        }
    }

    public function editUser($id = null) {
        $this->User->Behaviors->load('Containable');
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {

          
            if ($this->User->saveAssociated($this->request->data)) {
                $output = array(
                    "params" => $this->request,
                    "method" => $this->method,
                    "action" => "editUser",
                    "status" => 1,
                    //"user"=>$this->request->data,
                    "error" => array("validation" => "Organization Updated")
                );
            } else {
                $output = array(
                    "params" => $this->request,
                    "method" => $this->method,
                    "action" => "editUser",
                    "status" => 0,
                    //"user"=>$this->request->data,
                    "error" => array("validation" => "Organization Update Fails. Please Try Again")
                );
            }

            $this->set('output', $output);
            $this->set(
                    array(
                        "_serialize" => array('output'),
                        "_jsonp"=>true
                    )
            );
        } else {
            $output = '';
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id), 'contain' => array('OrganizationUser','OrganizationUser.Organization'));
            $users = $this->User->find('first', $options);
            $this->set('users', $users);
            $this->set(
                    array(
                        "_serialize" => array('users'),
                        "_jsonp"=>true
                    )
            );
        }
    }
    /*edited by rabi*/
   public function employeeRegistration() {
      // debug( $this->User->emailToRegisterEmployee($userId));
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
            $randomgenerate = $this->User->randomGenerate();
            $this->request->data['User']['status'] = 4;
            $this->request->data['User']['role_id'] = 3;
            $this->request->data['User']['random_activation'] = $randomgenerate;
           // $this->request->data['User']['email'] = $email;

            if(isset($this->request->data['User']['image']['name']))
            {

                $imageName = $this->request->data['User']['image']['name'];
            }

            $conditions = array('User.email'=> $this->request->data['User']['email']);

            if (!$this->User->hasAny($conditions)) {
                $this->User->create();
                if ($this->User->save($this->request->data)) {
                    $currentId =$this->User->id;
                    $userId = $this->User->id;

                    if(isset($imageName) && !empty($imageName))
                    {
                        $imagepath = URL_API.'webroot/files/user/image/'.$userId.'/thumb2_'.$imageName;
                        $this->User->saveField('imagepath',$imagepath);
                    }
                    
                    $this->User->emailToRegisterEmployee($userId);
                    $output = array(
                        "params" => $this->request,
                        "method" => $this->method,
                        "action" => "employeeRegistration",
                        "status" => 1,
                        //"user"=>$this->request->data,
                        "error" => array("validation" => "Employee Registration Successfull")
                    );
                }
            }
            else {
                $output = array(
                    "params" => $this->request,
                    "method" => $this->method,
                    "action" => "employeeRegistration",
                    "status" => 0,
                    //"user"=>$this->request->data,
                    "error" => array("validation" => "Employee Registration Fail. Please Try Again.")
                );
            }

            $this->loadModel('Useravailability');
                $data = array();
                $data['Useravailability']['user_id']=$currentId;
                $data['Useravailability']['organization_id']=0;
                $data['Useravailability']['status']= 0;
                for($i=1;$i<=7;$i++)
                {
                    $data['Useravailability']['day_id']=$i;
                    $this->Useravailability->create();

                    $this->Useravailability->save($data);
                }


            $this->set('output', $output);
            $this->set(
                    array(
                        "_serialize" => array('output'),
                        "_jsonp"=>true
                    )
            );
        }
    }
    public function activateNewUser($userId = null,$roleId = null,$randomActivation = null)
   {
        $data = $this->User->find('first',array(
                'conditions' => array(
                    'User.id' => $userId,
                    'User.role_id' => $roleId,
                    'User.random_activation' => $randomActivation
                    )
            ));
        if(!empty($data))
        {

            $this->User->id = $userId;
                if($data['User']['status'] != '1'){
                    if($this->User->saveField('status', '1')){
                        $output = '1';
                    }
                     else{
                        $output = '0';
                    }
                }
                else{
                    $output = '3';
                }
       }
        else{
            $output = '0';
        }
        $this->set('output', $output);
            $this->set(
                    array(
                        "_serialize" => array('output'),
                         "_jsonp"=>true
                    )
            );
   } 
    public function activateNewOrg($userId = null,$roleId = null,$randomActivation = null)
   {
        $data = $this->User->find('first',array(
                'conditions' => array(
                    'User.id' => $userId,
                    'User.role_id' => $roleId,
                    'User.random_activation' => $randomActivation
                    )
            ));
        if(!empty($data))
        {

            $this->User->id = $userId;
                if($data['User']['status'] != '2'){
                    if($this->User->saveField('status', '2')){
                        $output = '1';
                    }
                     else{
                        $output = '0';
                    }
                }
                else{
                    $output = '3';
                }
       }
        else{
            $output = '0';
        }
        $this->set('output', $output);
            $this->set(
                    array(
                        "_serialize" => array('output'),
                         "_jsonp"=>true
                    )
            );
   } 
    public function activateNewUserAssignByOrg($userId = null,$roleId = null,$randomActivation = null,$orgUserId = null)
   {
        $data = $this->User->find('first',array(
                'conditions' => array(
                    'User.id' => $userId,
                    'User.role_id' => $roleId,
                    'User.random_activation' => $randomActivation
                    )
            ));
        if(!empty($data))
        {

            $this->User->id = $userId;

                if($data['User']['status'] != '1'){
                    if($this->User->saveField('status', '1')){
                        $output = '1';
                        
                    }
                     else{
                        $output = '0';
                    }
                }
                else{
                    $output = '3';
                }
         }   
            
        else{
            $output = '0';
        }
        $this->set('output', $output);
            $this->set(
                    array(
                        "_serialize" => array('output'),
                         "_jsonp"=>true
                    )
            );
   } 
   /*ends here by rabi*/
    public function editEmployeeDetail($id = null) {
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {

            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $userDetail = $this->User->find('first', $options);


            // if(isset($this->request->data['User']['image_dir']) && isset($this->request->data['User']['image']) && !empty($this->request->data['User']['image']['name']))
            // {

            //     $image_name = $userDetail['User']['image'];
            //     $image_dir = $userDetail['User']['image_dir'];
            //     $image_path = ROOT.DS.'newshiftmate/'.WEBROOT_DIR.'/files/user/image/'.$image_dir.'/thumb2_'.$image_name;
            //     unlink($image_path);      
            // }

            $imageName = $this->request->data['User']['image']['name'];
            $imagepath = URL_API.'webroot/files/user/image/'.$id.'/thumb2_'.$imageName;

            if ($this->User->save($this->request->data)) {

                $this->User->saveField("imagepath", $imagepath);
                $output = array(
                    "params" => $this->request,
                    "method" => $this->method,
                    "action" => "editEmployeeDetail",
                    "status" => 1,
                    //"user"=>$this->request->data,
                    "error" => array("validation" => "Employee Detail Updated.")
                );
                $status = 1;
            } else {
                $output = array(
                    "params" => $this->request,
                    "method" => $this->method,
                    "action" => "editEmployeeDetail",
                    "status" => 0,
                    //"user"=>$this->request->data,
                    "error" => array("validation" => "Employee Detail Update Fail. Please Try Again")
                );
            }

            $this->set(array('output'=>$this->request->data,'status'=>$status));
            $this->set(
                    array(
                        "_serialize" => array('output','status'),
                        "_jsonp"=>true
                    )
            );
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $employee = $this->User->find('first', $options);
            $this->set('employee', $employee);
            $this->set(
                    array(
                        "_serialize" => array('employee'),
                        "_jsonp"=>true
                    )
            );
        }
    }

    //list employes with employee detail and with paginate.
    public function employeeList() {
        $this->User->Behaviors->load('Containable');
        $this->User->recursive = 0;
        $this->paginate = array('conditions' => array('status' => 1, 'NOT' => array('User.role_id' => array(1, 2))), 'contain' => array('City', 'Country'));
        $employees = $this->Paginator->paginate();

        if (!empty($employees)) {
            $status = 1;
        } else {
            $status = 0;
        }

        $output = array(
            "params" => $this->request,
            "method" => $this->method,
            "action" => "employeeList",
            "status" => $status,
            "error" => array("validation" => "")
        );
        $this->set('employees', $employees);
        $this->set('output', $output);

        $this->set(
                array(
                    "_serialize" => array('employees', 'output'),
                    "_jsonp"=>true
                )
        );
    }

    public function employeeDetail($userId = null) {
        $this->User->Behaviors->load('Containable');
        $this->User->recursive = 0;
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $userId), 'contain' => array('City', 'Country'));
        $employee = $this->User->find('first', $options);

        if (!empty($employee)) {
            $status = 1;
        } else {
            $status = 0;
        }

        $output = array(
            "params" => $this->request,
            "method" => $this->method,
            "action" => "employeeDetail",
            "status" => $status,
            "error" => array("validation" => "")
        );
        $this->set('employee', $employee);
        $this->set('output', $output);

        $this->set(
                array(
                    "_serialize" => array('employee', 'output'),
                    "_jsonp"=>true
                )
        );
    }

    //only list employee for select
    public function listEmployee() {
        $this->User->recursive = -1;
        $employees = $this->User->find('all', array('fields' => array('id', 'fname', 'lname'), 'conditions' => array('status' => 1, 'NOT' => array('User.role_id' => array(1, 2)))));

        if (!empty($employees)) {
            $status = 1;
        } else {
            $status = 0;
        }

        $output = array(
            "params" => $this->request,
            "method" => $this->method,
            "action" => "employeeList",
            "status" => $status,
            "error" => array("validation" => "")
        );
        $this->set('employees', $employees);
        $this->set('output', $output);

        $this->set(
                array(
                    "_serialize" => array('employees', 'output'),
                    "_jsonp"=>true
                )
        );
    }

    public function requestEmployeeToOrganization($orgId = null) {
        // $OrganizationUser = ClassRegistry::init('OrganizationUser');
        // $pinNumber = $OrganizationUser->pinNumber($orgId);
        // $data = $this->User->findByEmail($user_id,$orgId);
        // debug($data);
        // die();
        //$this->User->recursive = -1;
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
             $OrganizationUser = ClassRegistry::init('OrganizationUser');
            $pinNumber = $OrganizationUser->pinNumber($orgId);
            $randomgenerate = $this->User->randomGenerate();
            $this->request->data['OrganizationUser'][0]['pin_number'] = $pinNumber;
            $this->request->data['User']['random_activation'] = $randomgenerate;
            $this->request->data['User']['status'] = 4;
            $this->request->data['OrganizationUser'][0]['status'] = 2;
           // $this->request->data['OrganizationUser']['email'] = $this->request->data['User']['email'];
            $this->request->data['OrganizationUser'][0]['organization_id'] = $orgId;
            $this->request->data['User']['role_id'] = 2;
            //$output = $this->request->data;
            
            $this->User->create();
            $rule = array('User.email'=>$this->request->data['User']['email']);
            if(!$this->User->hasAny($rule)){
                if ($this->User->saveAssociated($this->request->data)) {
                    $userId = $this->User->id;
                    $this->loadModel('OrganizationUser');
                    $orgUserId = $this->OrganizationUser->id;
                    $this->User->findByEmail($userId,$orgUserId);
                         /*
                          * Need to send email here with a link so that user can register with that email.
                          * link will be "users/employeeRegisterOnRequest.php"
                          * parameters are orgId = organization id($orgId) and userId as just inserted user id($userId).
                          */           

                    $output = array(
                        "params" => $this->request,
                        "method" => $this->method,
                        "action" => "employeeList",
                        "status" => 1,
                        "error" => array("validation" => "User Request Send successfully.")
                    );
                } else {
                    $output = array(
                        "params" => $this->request,
                        "method" => $this->method,
                        "action" => "employeeList",
                        "status" => 0,
                        "error" => array("validation" =>$this->User->invalidFields())// "User Request Send Fails. Please Try Again.")
                    );
                }
            } else {
                 $output = array(
                        "params" => $this->request,
                        "method" => $this->method,
                        "action" => "employeeList",
                        "status" => 2,
                        "error" => array("validation" => "request already sent.")
                    );
            }    

                $this->set('output', $output);

                $this->set(
                        array(
                            "_serialize" => array('output'),
                            "_jsonp"=>true
                        )
                );
        }
    }
    
      public function resetPasswordManually(){
            // $data = $this->User->resetPasswordByEmail($userId);
            // debug($data);
            // die();
            $this->User->Behaviors->load('Containable');
           
            if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {

                $email = $this->request->data['User']['email'];
                 $employeeList = $this->User->find('first',array('conditions'=>array('User.email'=>$email),'contain' => false));

                 if(isset($employeeList) && !empty($employeeList))
                 {
                     $userId = $employeeList['User']['id'];
                     $this->User->resetPasswordByEmail($userId);

                     $this->set(
                            array(
                                "output"=>1,
                                "_serialize" => array('output'),
                                "_jsonp"=>true
                            )
                    );
                 }
                 else
                 {

                     $this->set(
                                array(
                                    "output"=>0,
                                    "_serialize" => array('output'),
                                    "_jsonp"=>true
                                )
                        );
                 }
               
            }
    }
    

      public function getUserDetailById($userId){
        $this->User->recursive = -1;
        $userDetail = $this->User->findById($userId);
        
        if (!empty($userDetail)) {
            $status = 1;
        } else {
            $status = 0;
        }

        $output = array(
            "params" => $this->request,
            "method" => $this->method,
            "action" => "getUserDetailById",
            "status" => $status,
            "error" => array("validation" => "")
        );
        $this->set('userDetail', $userDetail);
        $this->set('output', $output);

        $this->set(
                array(
                    "_serialize" => array('userDetail', 'output'),
                    "_jsonp"=>true
                )
        );
        
        
    }
    
    public function employeeRegistrationOnOrgRequest($orgId = null, $userId = null){
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
            //debug($this->request->data);
            $this->request->data['User']['status'] = 1;
            $this->request->data['User']['role_id'] = 5;
            if ($this->User->save($this->request->data)) {
                /*
                 * Need to Send email to Organization or provide organization link so that org can manage employee detail like wages etc.
                 * link: organizationUsers/updateRequestedEmployeeDetail.php
                 * parametera: organization Id ($orgId) and user Id ($userId)
                 */
                $output = array(
                    "params" => $this->request,
                    "method" => $this->method,
                    "action" => "employeeRegistrationOnOrgRequest",
                    "status" => 1,
                    "error" => array("validation" => "Employee Registration Successfull")
                );
            } else {
                $output = array(
                    "params" => $this->request,
                    "method" => $this->method,
                    "action" => "employeeRegistrationOnOrgRequest",
                    "status" => 0,
                    "error" => array("validation" => "Employee Registration Fail. Please Try Again.")
                );
            }


            $this->set('output', $output);
            $this->set(
                    array(
                        "_serialize" => array('output'),
                        "_jsonp"=>true
                    )
            );
        }
        
    }
    public function activeOrgRegister($orgUserId = null,$user_id = null)
    {
        $data = $this->User->find('first',array(
            'conditions' => array(
                'User.id'=>$user_id
                )
            ));

        $this->loadModel('OrganizationUser');
        $this->OrganizationUser->updateAll(
            array('OrganizationUser.status'=>3),
            array('OrganizationUser.user_id'=>$user_id)
            );
        
        if($data['User']['status'] != '1'){
            $this->User->id = $user_id;
            if($this->User->saveField('status', '1')){
                $output = '1';
                // $this->User->OrganizationUser->id = $orgUserId;
                //  if($this->User->OrganizationUser->saveField('status', '1')){
                //     $output = '1';
                // }
                // else{
                //     $output = '0';
                // }
            }
             else{
                $output = '0';
            }
        }
        else{
            $output = '3';
        }
       
    $this->set('output', $output);
        $this->set(
                array(
                    "_serialize" => array('output'),
                     "_jsonp"=>true
                )
        );
    }
   
    public function employeeRegistrationByOrg($orgId = null) {
        // debug($this->User->emailToNewEmployee($user_id,$orgId,$password));
        // die();
         $randomgenerate = $this->User->randomGenerate();
        $pinNumber = $this->User->OrganizationUser->pinNumber($orgId);
        // debug($pinNumber);
        // die();
       
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
           // debug($this->request->data);die();
            $password = $this->request->data['User']['password'];
            $this->request->data['User']['random_activation'] = $randomgenerate;
            $this->request->data['User']['status'] = 4;
            $this->request->data['OrganizationUser'][0]['status'] = 0;
            $this->request->data['OrganizationUser'][0]['organization_id'] = $orgId;
            $this->request->data['OrganizationUser'][0]['pin_number'] = $pinNumber;
            $this->request->data['User']['role_id'] = 3;

            $hireDate = new DateTime($this->request->data['OrganizationUser'][0]['hire_date']);
            $reviewtype = $this->request->data['OrganizationUser'][0]['reviewtype'];
            $reviewperiod = $this->request->data['OrganizationUser'][0]['reviewperiod'];

            if($reviewtype == "Years"){
                $interval = 'P'.$reviewperiod.'Y';
            } else if($reviewtype == "Months"){
                $interval = 'P'.$reviewperiod.'M';
            } else {
                $interval = 'P'.$reviewperiod.'W';
            }
            //$interval = 'P3W';

            $reviewDate = $hireDate->add(new DateInterval($interval));
            $date = $reviewDate->format('Y-m-d');
            $this->request->data['OrganizationUser'][0]['reviewdate'] = $date;

            $this->User->create();

            $rule = array('User.email'=>$this->request->data['User']['email']);
            if(!$this->User->hasAny($rule)){
                if ($this->User->saveAll($this->request->data)) {
                    $user_id = $this->User->getLastInsertId();
                    $this->User->emailToNewEmployee($user_id,$orgId,$password);
                    $output = array(
                        "params" => $this->request,
                        "method" => $this->method,
                        "action" => "employeeRegistration",
                        "status" => 1,
                        //"user"=>$this->request->data,
                        "error" => array("validation" => "Employee has be added to organization succssfully.")
                    );
                } else {
                    $output = array(
                        "params" => $this->request,
                        "method" => $this->method,
                        "action" => "employeeRegistration",
                        "status" => 0,
                        //"user"=>$this->request->data,
                        "error" => array("validation" => "Fail to add employee to organization. Please Try Again.")
                    );
                }
            } else {
                $output = array(
                        "params" => $this->request,
                        "method" => $this->method,
                        "action" => "employeeRegistration",
                        "status" => 2,
                        //"user"=>$this->request->data,
                        "error" => array("validation" => "already exist")
                    );
            }    


            $this->set('output', $output);
            $this->set(
                    array(
                        "_serialize" => array('output'),
                        "_jsonp"=>true
                    )
            );
        }
    }



    public function Notices($userId = null,$page = 1)
    {
        $limit = 9;
        $this->User->Behaviors->load('Containable');
        $options = array(
            'conditions' => array('User.' .$this->User->primaryKey => $userId), 
            'contain' => array(
                            'OrganizationUser'=>array(
                                'conditions'=>['status'=>3],
                                'fields'=> array( 'DISTINCT OrganizationUser.organization_id')),
                            'OrganizationUser.Organization',
                            'OrganizationUser.Organization.Noticeboard',
                            'OrganizationUser.Organization.Newsboard',
                            'OrganizationUser.Organization.Noticeboard.Branch',
                        ),
            'page'=>$page,
            'limit'=>$limit
            );
            
            $org = $this->User->find('all', $options);
            $count = 0;
            foreach($org['0']['OrganizationUser'] as $org1){
                foreach($org1['Organization']['Noticeboard'] as $c){
                    $count++;
                }
            }

        $this->set('output', $org);
        $this->set('page',$page);
        $this->set('maxPage',ceil($count/$limit));
        $this->set(
                    array(
                        "_serialize" => array('output',"page","maxPage"),
                        "_jsonp"=>true
                    ));

    }

    public function checkUniqueEmail($e = null)
    {
        $email = $_POST['email'];

        $conditions = array(
            'User.email' => $email,
        );
        if ($this->User->hasAny($conditions)){
            
            $status = 1;

        }

        else
        {
            $status = 0;
        }

        $this->set('output', ['status' => $status]);

        $this->set(
                    array(
                        "_serialize" => array('output'),
                        "_jsonp"=>true
                    ));
    }
     public function checkUniqueEmail1($e = null)
    {   
         $this->User->recursive = -1;
       
        $email = $_POST['email'];

        $conditions = array(
            'User.email' => $email,
        );
        if ($this->User->hasAny($conditions)){

           $userStatus = $this->User->find('first',array('conditions'=> array('User.email' => $email),'fields'=>array('status')));
            
            $status = $userStatus['User']['status'];

        }

        else
        {
           // debug(0);
            $status = 0;
        }

        $this->set('output', ['status' => $status]);

        $this->set(
                    array(
                        "_serialize" => array('output'),
                        "_jsonp"=>true
                    ));
    }

    public function changePassword($userid)
    {
        $this->User->Behaviors->load('Containable');

        $data=$this->User->find('first',
            array(
                "conditions" => array('User.id' => $userid),
                'contain'=>false
                ));
        $oldpassword = $data['User']['password'];
        $old_password = $this->request->data['User']['old_password'];
        $hashed_pwd = $this->User->passwordHash($old_password);
        $this->User->id = $userid;
       //$old_password1= 'abc';
        //$old_password = $this->request->data['User']['old_password'];


        //$passwordHasher = new SimplePasswordHasher();
       // $hashed_pwd = $passwordHasher->hash($old_password1);
        //debug($hashed_pwd);
        //$this->User->id = $userid;
        if ($oldpassword == $hashed_pwd) {
            
            $newpassword['User']['password'] = $this->request->data['User']['password'];
           if ($this->User->save($newpassword)) {
                $output = 1;
            } else {
                $output = 0;
            }
        }else{

            $output = 2;
        }

        
        $this->set('output', $output);

        $this->set(
                    array(
                        "_serialize" => array('output'),
                        "_jsonp"=>true
                    ));

    }

    // public function changePictureOfUser($userId){

    //     if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {

    //     $this->User->id = $userId;
    //     if($this->User->save($this->request->data)){
    //         $output['response'] = 1;
    //     } else {
    //         $output['response'] = 0;
    //     }

 
    //     $this->set(array(
    //         'output'=>$output,
    //         '_serialize'=>'output'
    //         ));
    //     }
    // }
   
   public function wholeCalendar($user_id){
        $this->loadModel('ShiftUser');
        $this->loadModel('Organizationfunction');
        $this->loadModel('Requesttimeoff');
        
        $result1=$this->ShiftUser->overallInCalendar($user_id);
        $result2=$this->Requesttimeoff->overallInCalendar($user_id);
        $result3 = $this->User->loginUserRelationToOther($user_id);
        
        if(!empty($result3['OrganizationUser'])){
            $count=0;
            foreach($result3['OrganizationUser'] as $orgusr){
                $orgid = $orgusr['Organization']['id'];
                $result4 = $this->Organizationfunction->listFunctionForOrganization($orgid);
                if(isset($result4) && !empty($result4)){
                    
                     $countxyz=1;
                    foreach($result4 as $fxn){
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['title']="Function";
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['description'] = $fxn['Organizationfunction']['note'];
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['start']=$fxn['Organizationfunction']['function_date'];
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['end']=$fxn['Organizationfunction']['function_date'];
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['org']['id']=$fxn['Organization']['id'];
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['org']['title']=$fxn['Organization']['title'];
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['status']=$fxn['Organizationfunction']['status'];
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['id']=$fxn['Organizationfunction']['id'];
                        
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['branch_name'][$countxyz]=$fxn['Branch']['title'];
                        $countxyz++;
                    }
                }
                $count++;
            }
        }
        if(isset($fxn1)){
            $result = array_merge($result1,$result2,$fxn1);
        }else{
            $result = array_merge($result1,$result2);
        }
        
        $this->set(array(
            'result'=>$result,
            '_serialize'=>array('result'),
            '_jsonp'=>true
        ));
    }
    
    public function wholeCalendar1($user_id){
        $this->loadModel('ShiftUser');
        $this->loadModel('Leaverequest');
        $this->loadModel('Organizationfunction');
        
        $result1=$this->ShiftUser->overallInCalendar($user_id);
        $result2=$this->Leaverequest->overallInCalendar($user_id);
        $result3 = $this->User->loginUserRelationToOther($user_id);
        
        if(!empty($result3['OrganizationUser'])){
            $count=0;
            foreach($result3['OrganizationUser'] as $orgusr){
                $orgid = $orgusr['Organization']['id'];
                $result4 = $this->Organizationfunction->listFunctionForOrganization($orgid);
                if(isset($result4) && !empty($result4)){
                    
                     $countxyz=1;
                    foreach($result4 as $fxn){
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['title']="Function";
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['description'] = $fxn['Organizationfunction']['note'];
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['start']=$fxn['Organizationfunction']['function_date'];
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['end']=$fxn['Organizationfunction']['function_date'];
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['org']['id']=$fxn['Organization']['id'];
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['org']['title']=$fxn['Organization']['title'];
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['status']=$fxn['Organizationfunction']['status'];
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['id']=$fxn['Organizationfunction']['id'];
                        
                        $fxn1[$fxn['Organizationfunction']['function_date'].$fxn['Organizationfunction']['note']]['branch_name'][$countxyz]=$fxn['Branch']['title'];
                        $countxyz++;
                    }
                    
                    
//                    foreach($result4 as $org){
//                        $result5[$count]['title']="Function";
//                        $result5[$count]['description'] = $org['Organizationfunction']['note'];
//                        $result5[$count]['start']=$org['Organizationfunction']['function_date'];
//                        $result5[$count]['end']=$org['Organizationfunction']['function_date'];
//                        $result5[$count]['org']['id']=$org['Organization']['id'];
//                        $result5[$count]['org']['title']=$org['Organization']['title'];
//                        $result5[$count]['status']=$org['Organizationfunction']['status'];  
//                        $result5[$count]['id']=$org['Organizationfunction']['id'];
//                        $count++;
//                    }
                }
                $count++;
            }
        }
        if(isset($fxn1)){
            $result = array_merge($result1,$result2,$fxn1);
        }else{
            $result = array_merge($result1,$result2);
        }
        
        $this->set(array(
            'result'=>$result,
            '_serialize'=>array('result'),
            '_jsonp'=>true
        ));
    }
    /*by rabi*/
    public function userInfo($userId = null){
         $this->User->recursive = -1;
        $data = $this->User->find('first',array(
                'conditions' => array(
                        'User.id' => $userId
                    ),
                    'contain' => false,
                   'fields' => ['email']  
               
            ));
       $this->set('output', $data);

        $this->set(
                    array(
                        "_serialize" => array('output'),
                        "_jsonp"=>true
                    ));
    }
    public function employeeRegisterByEmailUpdate($orgUserId=null,$user_id = null)
    {
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
        $this->User->id = $user_id;
        $this->request->data['User']['status'] = 1;
        if($this->User->save($this->request->data)){
            //$this->User->emailToEmployeeAssignByOrg($orgUserId,$user_id);
            $output = 1;
        }
        else
        {
            $output = 0;
        }
         $this->set('output', $output);

        $this->set(
                    array(
                        "_serialize" => array('output'),
                        "_jsonp"=>true
                    ));
        }
    }



    public function resetPassword($userid)
    {

     if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {

            $new_password = $this->request->data['User']['password'];
           
            $this->User->id = $userid;
               if ($this->User->saveField('password',$new_password)) {
                    $output = 1;
                } else {
                    $output = 0;
                }
                    
            $this->set('output', $output);

            $this->set(
                        array(
                            "_serialize" => array('output'),
                            "_jsonp"=>true
                        ));
         }
      
        
    }
    public function loginUserRelationToOther11($user_id)
    {

        $user = $this->User->loginUserRelationToOther11($user_id);
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

            $this->set('output', $result);
            $this->set(array('_serialize'=> array('output'),"_jsonp"=>true));
        
       
    }

    public function saveFbId()
    {
        if($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
        {
            if($this->User->save($this->request->data))
            {
                $output = 1;
            }else
            {
                $output = 0;
            }

            $this->set(array(
                'output'=>$output,
                '_serialize'=>['output'],
                '_jsonp'=>true
                ));
        }
    }

    public function getu()
    {
        if($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
        {
            $this->set(array(
                'output'=>$this->request,
                '_serialize'=>['output'],
                '_jsonp'=>true
                ));
        }
    }

}
