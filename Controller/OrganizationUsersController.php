<?php

App::uses('AppController', 'Controller');

/**
 * OrganizationUsers Controller
 *
 * @property OrganizationUser $OrganizationUser
 * @property PaginatorComponent $Paginator
 */
class OrganizationUsersController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');
    
    /* rabi code start here */
    
    public function Newslist($user_id = NULL){
        $this->OrganizationUser->Behaviors->load('Containable');
        $detail = $this->OrganizationUser->find('all', array(
           'contain'=> array(
               'Organization',
               'Organization.Newsboard'
           ),
            'conditions'=> array(
                'OrganizationUser.user_id' => $user_id
                )
            )
                );
        //debug($detail);
        $this->set(array(
           'output'=>$detail,
           '_serialize'=>array('output')
       ));
    }
    
    
    /* rabi code end here*/
    
    public function priceCalculateOrgBranches($user_id, $start_date, $end_date){
        $this->loadModel('ShiftUser');
        $this->loadModel('Organizationfunction');
        $this->loadModel('MultiplyPaymentFactor');
        $myOrganizations = $this->OrganizationUser->myOrganizationLists($user_id);
        
        $overAllCost = 0;
        $overAllHourWorked = 0;
        foreach($myOrganizations as $myOrganization){
            $org_id = $myOrganization['OrganizationUser']['organization_id'];
            $branch_id = $myOrganization['Branch']['id'];
            $wage = $myOrganization['OrganizationUser']['wage'];
            // for holiday
            $holidays = $this->Organizationfunction->holidays($org_id, $branch_id, $start_date, $end_date);
             foreach($holidays as $holiday){
            $holiday_arr[] = $holiday['Organizationfunction']['function_date'];
        }
            
            // for payment Rate    
            $paymentFactorRates = $this->MultiplyPaymentFactor->paymentFactorRates($org_id, $branch_id);
            
            foreach($paymentFactorRates as $paymentFactorRate){
            $paymentFactorRateArray[$paymentFactorRate['Multiplypaymentfactortype']['title']] = $paymentFactorRate['MultiplyPaymentFactor']['multiply_factor'];     
        }
            
            // for shiftrange
            $shiftRanges = $this->ShiftUser->myOrgShiftRange($user_id, $org_id, $branch_id, $start_date, $end_date);  
            
            
        $output = array();
        $count = 0;
        $total_cost = 0;
        $sat_sun_count = 0;
        $hour_worked_sec = 0;
                
        foreach($shiftRanges as $datas){
            $time_diff = 0;
            $time_diff_hour = 0;
            $rate = 0;
            $cost = 0;
            
            $starttime = strtotime($datas['Shift']['starttime']);
                        $endtime = strtotime($datas['Shift']['endtime']);
            $time_diff = $endtime - $starttime;
            if($time_diff < 0){
                $time_diff = $time_diff + 24*3600;  
            }
            $time_diff_hour = $time_diff / 3600;
            $hour_worked_sec = $hour_worked_sec + $time_diff;
            
            if(in_array($datas['ShiftUser']['shift_date'], $holidays)){
                $output['yes'][$count][]= $datas['ShiftUser']['shift_date'];
                if(isset($paymentFactorRateArray['Holiday']) && !empty($paymentFactorRateArray['Holiday'])){
                    $rate = $paymentFactorRateArray['Holiday'];
                }else{
                    $rate = 1;  
                }
                $output['yes'][$count]['rate'] = $rate;
                $output['yes'][$count]['shift_duration'] = $time_diff_hour;
                $cost = $rate * $time_diff_hour * $wage;
                $output['yes'][$count]['cost'] = $cost;
                $total_cost = $total_cost + $cost;
            }else{
                $output['no'][$count][]= $datas['ShiftUser']['shift_date'];
                $day_name = date('l', strtotime($datas['ShiftUser']['shift_date']));
                $output['no'][$count]['day'] = $day_name;
                if(isset($paymentFactorRateArray[$day_name]) && !empty($paymentFactorRateArray[$day_name])){
                    $rate = $paymentFactorRateArray[$day_name];
                    $sat_sun_count++;
                }else{
                    $rate = 1;
                }
                
                $output['no'][$count]['rate'] = $rate;
                $output['no'][$count]['shift_duration'] = $time_diff_hour;
                $cost = $rate * $time_diff_hour * $wage;
                $output['no'][$count]['cost'] = $cost;
                $total_cost = $total_cost + $cost;
            }
            $count++;
                       
        }
                    $overAllCost = $overAllCost + $total_cost;
                    $hour_worked = $hour_worked_sec / 3600;
                    $overAllHourWorked = $overAllHourWorked + $hour_worked;
                       
            $output['total_cost'] = $overAllCost;
            //$output['holiday'] = count($holidays);
            //$output['sat_sun_count'] = $sat_sun_count;
            $output['hour_worked'] = $overAllHourWorked;
            
            //echo $overAllCost;    
            //debug($output);
        }
        //echo $overAllCost;
       /*
        foreach($myOrganizations as $key=>$org_id){
            $branches = $this->OrganizationUser->Branch->BranchesList($org_id);
            foreach($branches as $branch_id=>$branch_title){
                $shift_range[$org_id][$branch_id] = $this->ShiftUser->myOrgShiftRange($user_id, $org_id, $branch_id, $start_date, $end_date);
                // for holidays
                $holidays = $this->Organizationfunction->holidays($org_id, $branch_id, $start_date, $end_date);
                foreach($holidays as $holiday){
            $holiday_arr[] = $holiday['Organizationfunction']['function_date'];
        }
            }
        }
        */
       
       
        //$test = array($user_id, $start_date, $end_date);
       $this->set(array(
           'output'=>$output,
           '_serialize'=>array('output')
       ));
    }
    
    /* for organization branch profile of employee*/
    public function myOrgProfile($user_id = NULL, $orgId = NULL, $branch_id = NULL){
        $myOrgProfile = $this->OrganizationUser->myOrgProfile($user_id, $orgId, $branch_id);
        $this->set('myOrgProfile', $myOrgProfile);
        $this->set(array(
            '_serialize' => array('myOrgProfile')
        ));
    }
    
    /* for organization list of the user for message*/
    public function myOrganizations($user_id = NULL){
        $myOrganizations = $this->OrganizationUser->myOrganizations($user_id);
        //debug($myOrganizations);
        $this->set('myOrganizations', $myOrganizations);
       

        $this->set(
                array(
                    "_serialize" => array('myOrganizations')
                )
        );
    }
    public function myOrganizationLists($user_id = NULL){
        $myOrganizations = $this->OrganizationUser->myOrganizationLists($user_id);
        //debug($myOrganizations);
        $this->set('myOrganizations', $myOrganizations);
       

        $this->set(
                array(
                    "_serialize" => array('myOrganizations'),
                    "_jsonp"=>true
                )
        );
    }
    
    /* for organization detail*/
    public function myOrganizationDetail($user_id = NULL, $orgId = NULL, $branch_id = NULL){
        $myOrgnizationDetail = $this->OrganizationUser->myOrganizationDetail($user_id, $orgId, $branch_id);
         $this->set('myOrganizationDetail', $myOrgnizationDetail);
       
        $this->set(
                array(
                    "_serialize" => array('myOrganizationDetail')
                )
        );
    }
 
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->OrganizationUser->recursive = 0;
        $this->set('organizationUsers', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->OrganizationUser->exists($id)) {
            throw new NotFoundException(__('Invalid organization user'));
        }
        $options = array('conditions' => array('OrganizationUser.' . $this->OrganizationUser->primaryKey => $id));
        $this->set('organizationUser', $this->OrganizationUser->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->OrganizationUser->create();
            if ($this->OrganizationUser->save($this->request->data)) {
                $this->Session->setFlash(__('The organization user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The organization user could not be saved. Please, try again.'));
            }
        }
        $organizations = $this->OrganizationUser->Organization->find('list');
        $users = $this->OrganizationUser->User->find('list');
        $branches = $this->OrganizationUser->Branch->find('list');
        $organizationroles = $this->OrganizationUser->Organizationrole->find('list');
        $this->set(compact('organizations', 'users', 'branches', 'organizationroles'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->OrganizationUser->exists($id)) {
            throw new NotFoundException(__('Invalid organization user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->OrganizationUser->save($this->request->data)) {
                $this->Session->setFlash(__('The organization user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The organization user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('OrganizationUser.' . $this->OrganizationUser->primaryKey => $id));
            $this->request->data = $this->OrganizationUser->find('first', $options);
        }
        $organizations = $this->OrganizationUser->Organization->find('list');
        $users = $this->OrganizationUser->User->find('list');
        $branches = $this->OrganizationUser->Branch->find('list');
        $organizationroles = $this->OrganizationUser->Organizationrole->find('list');
        $this->set(compact('organizations', 'users', 'branches', 'organizationroles'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->OrganizationUser->id = $id;
        if (!$this->OrganizationUser->exists()) {
            throw new NotFoundException(__('Invalid organization user'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->OrganizationUser->delete()) {
            $this->Session->setFlash(__('The organization user has been deleted.'));
        } else {
            $this->Session->setFlash(__('The organization user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    

    //Get list of Users related to specific organization
    public function getOrganizationUsers($orgId = null, $page = 1) {
        $this->OrganizationUser->Behaviors->load('Containable');
        $limit = 20;
       // $organizationUsers = $this->OrganizationUser->find('all', array('conditions' => array('OrganizationUser.organization_id' => $orgId),'group'=>array('OrganizationUser.user_id'), 'contain' => array('User.id', 'User.fname', 'User.lname', 'User.email', 'User.address', 'User.phone')));
        $this->paginate = array('conditions' => array('OrganizationUser.organization_id' => $orgId,'OrganizationUser.status' => 3),'group'=>array('OrganizationUser.user_id'), 'contain' => array('User.id', 'User.fname','User.gender', 'User.lname', 'User.email', 'User.address', 'User.phone', 'User.image_dir', 'User.image', 'User.imagepath','User.status','Branch'), 'limit'=>$limit, 'page'=>$page);
      
        $organizationUsers = $this->Paginator->paginate();
        
        $page=$this->params['paging']['OrganizationUser']['pageCount'];
        $currentPage = $this->params['paging']['OrganizationUser']['page'];
    
        if (!empty($organizationUsers)) {
            $status = 1;
        } else {
            $status = 0;
        }
        $output = array(
            "params" => $this->request,
            "method" => $this->method,
            "action" => "getOrganizationUsers",
            "status" => $status,
            "page" => $page,
            "currentPage" => $currentPage,
            "error" => array("validation" => "")
        );

        $this->set('output', $output);
        $this->set('organizationUsers', $organizationUsers);

        $this->set(
                array(
                    "_serialize" => array('organizationUsers', 'output'),
                    "_jsonp"=>true
                )
        );
    }
    
    
    public function getAllOrganizationUser($orgId=null){
        $this->OrganizationUser->recursive  =2;
        $this->OrganizationUser->Behaviors->load('Containable');
        $result = $this->OrganizationUser->find("all",array(
            'conditions' => array('OrganizationUser.organization_id' => $orgId,'OrganizationUser.status' => 3),
            'contain'=>array('User.id','User.fname','User.lname','User.imagepath', 'User.gender',"Branch","Branch.Board")
        ));
        $this->set(array(
                    "orgUsr"=>$result,
                    "_serialize" => array('orgUsr'),
                    "_jsonp"=>true
                ));
    }
    //list of employees not in specific organization
    public function listEmployeesNotInOrg($orgId = null){
        $this->OrganizationUser->User->Behaviors->load('Containable');
        $orgUsers = $this->OrganizationUser->find('list', array('fields'=>array('user_id'),'group'=>array('OrganizationUser.user_id'), 'conditions'=>array('organization_id'=>$orgId)));
        $employees = $this->OrganizationUser->User->find('all', array('conditions' => array('User.status' => 1, 'NOT' => array('User.role_id' => array(1, 2), 'User.id'=>$orgUsers)), 'contain'=>array('Country', 'City')));
        
         if (!empty($employees)) {
            $status = 1;
        } else {
            $status = 0;
        }

        $output = array(
            "params" => $this->request,
            "method" => $this->method,
            "action" => "listEmployeesNotInOrg",
            "status" => $status,
            "error" => array("validation" => "")
        );
        $this->set('employees', $employees);
        $this->set('output', $output);

        $this->set(
                array(
                    "_serialize" => array('employees', 'output')
                )
        );
        
    }

    public function assignEmployeeToOrganization($orgId = null) {
        
        $pinNumber = $this->OrganizationUser->pinNumber($orgId);
        // debug($pinNumber);
        // die();
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {

            $conditions = array(
                                    'OrganizationUser.user_id' => $this->request->data['OrganizationUser']['user_id'],
                                    'OrganizationUser.branch_id' => $this->request->data['OrganizationUser']['branch_id'],
                                );

            if ($this->OrganizationUser->hasAny($conditions)){

                $output = array(
                    "params" => $this->request,
                    "method" => $this->method,
                    "action" => "assignEmployeeToOrganization",
                    "status" => 2,
                    "data" => $this->request->data,
                    "error" => array("validation" => "Employee assign to Organization fail. Please Try Again.")
                );
            }
             else {
                $this->OrganizationUser->create();
                $this->request->data['OrganizationUser']['status'] = 1;
                $this->request->data['OrganizationUser']['pin_number'] = $pinNumber;
                $this->request->data['OrganizationUser']['organization_id'] = $orgId;
                $user_id = $this->request->data['OrganizationUser']['user_id'];
                if ($this->OrganizationUser->save($this->request->data)) {
                    $this->loadModel('BranchUser');

                    $data = array();
                    $data['BranchUser']['branch_id'] = $this->request->data['OrganizationUser']['branch_id'];
                    $data['BranchUser']['user_id'] = $this->request->data['OrganizationUser']['user_id'];
                    $data['BranchUser']['status'] = 0;

                    $this->BranchUser->save($data);
                    
                    $this->OrganizationUser->emailToEmployee($user_id,$orgId);

                    $output = array(
                        "params" => $this->request,
                        "method" => $this->method,
                        "action" => "assignEmployeeToOrganization",
                        "status" => 1,
                        "success" => array("validation" => "Employee assign to Organization successfully"),
                        "success_email" => array("validation" => "Email has been send successfully")
                    );
                }
                else
                {
                    $output = array(
                        "params" => $this->request,
                        "method" => $this->method,
                        "action" => "assignEmployeeToOrganization",
                        "status" => 0,
                        "data" => $this->request->data,
                        "error" => array("validation" => "Employee assign to Organization fails. Please Try Again.")
                    );
                }
            }

            $this->set('output', $output);

            $this->set(
                    array(
                        "_serialize" => array('output')
                    )
            );
        }
    }

    //get list of user related to specific branch of organization but not assigned to specific board
    public function getOrganizationUsersNotInBoard($orgId = null, $boardId = null, $branchId = null) {
        $this->OrganizationUser->Behaviors->load('Containable');

        //get list of users related to specific board
        $boardUsers = $this->OrganizationUser->Organization->Board->BoardUser->find('list', array('fields' => 'BoardUser.user_id', 'conditions' => array('BoardUser.board_id' => $boardId,'BoardUser.status'=>1)));

        //get list of user related to specific org but not related to specific board.
        $orgUsers = $this->OrganizationUser->find('all', array('conditions' => array('OrganizationUser.status' => 3,'OrganizationUser.organization_id' => $orgId,'OrganizationUser.branch_id' => $branchId,  'NOT' => array('OrganizationUser.user_id' => $boardUsers)), 'group'=>array('OrganizationUser.user_id'), 'contain' => array('User.id', 'User.fname', 'User.lname', 'User.image', 'User.image_dir', 'User.gender')));
        // debug($boardUsers);
        // debug($orgUsers);
        // die();
        if (!empty($boardUsers)) {
            $status = 1;
        } else {
            $status = 0;
        }
        $output = array(
            "params" => $this->request,
            "method" => $this->method,
            "action" => "getOrganizationUsersNotInBoard",
            "status" => $status,
            "error" => array("validation" => "")
        );

        $this->set('output', $output);
        $this->set('orgUsers', $orgUsers);

        $this->set(
                array(
                    "_serialize" => array('orgUsers', 'output')
                )
        );
    }

    public function updateRequestedEmployeeDetail($orgId = null, $userId = null) {
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
            $orgUser = $this->OrganizationUser->find('list', array('conditions' => array('OrganizationUser.organization_id' => $orgId, 'OrganizationUser.user_id' => $userId)));
            if (!empty($orgUser)) {
                $output = array(
                    "params" => $this->request,
                    "method" => $this->method,
                    "action" => "updateRequestedEmployeeDetail",
                    "status" => 0,
                    "error" => array("validation" => "Employee already assigned to organization.")
                );
                $this->set('output', $output);

                $this->set(
                        array(
                            "_serialize" => array('output')
                        )
                );
            } else {
                $this->OrganizationUser->create();
                $this->request->data['OrganizationUser']['organization_id'] = $orgId;
                $this->request->data['OrganizationUser']['user_id'] = $userId;
                //debug($userId);
                if ($this->OrganizationUser->save($this->request->data)) {
                    $output = array(
                        "params" => $this->request,
                        "method" => $this->method,
                        "action" => "updateRequestedEmployeeDetail",
                        "status" => 1,
                        "error" => array("validation" => "Employee assign to Organization successfully")
                    );
                } else {
                    $output = array(
                        "params" => $this->request,
                        "method" => $this->method,
                        "action" => "updateRequestedEmployeeDetail",
                        "status" => 0,
                        "error" => array("validation" => "Employee assign to Organization fail. Please Try Again.")
                    );
                }

                $this->set('output', $output);

                $this->set(
                        array(
                            "_serialize" => array('output')
                        )
                );
            }
        }
    }
    
    public function organizationEmployeeDetail($orgId = null, $userId = null){
        $this->OrganizationUser->recursive = 2;
        $this->OrganizationUser->Behaviors->load('Containable');
        $employee = $this->OrganizationUser->find('first', array('conditions'=>array('OrganizationUser.user_id'=>$userId, 'OrganizationUser.organization_id'=>$orgId), 'contain'=>array('User','Organization.title', 'Branch.id','Branch.title', 'User.City.title', 'User.Country.title', 'User.Board', 'User.Rating')));
        
        if (!empty($employee)) {
            $status = 1;
        } else {
            $status = 0;
        }
        $output = array(
            "params" => $this->request,
            "method" => $this->method,
            "action" => "organizationEmployeeDetail",
            "status" => $status,
            "error" => array("validation" => "")
        );

        $this->set('output', $output);
        $this->set('employee', $employee);

        $this->set(
                array(
                    "_serialize" => array('employee', 'output')
                )
        );
        
    }

    public function getAllOrganizationUsers()
    {
        $this->OrganizationUser->Behaviors->load('Containable');
        $limit = 20;

        $this->paginate = array('all','group'=>array('OrganizationUser.user_id'), 'contain' => array('User.id', 'User.fname', 'User.lname', 'User.email', 'User.address', 'User.phone'), 'limit'=>$limit);
      
        $organizationUsers = $this->Paginator->paginate();
        
        $page=$this->params['paging']['OrganizationUser']['pageCount'];
        $currentPage = $this->params['paging']['OrganizationUser']['page'];
        
        
        
        
        if (!empty($organizationUsers)) {
            $status = 1;
        } else {
            $status = 0;
        }
        $output = array(
            "params" => $this->request,
            "method" => $this->method,
            "action" => "getOrganizationUsers",
            "status" => $status,
            "pageCount" => $page,
            "currentPage" => $currentPage,
            "error" => array("validation" => "")
        );

        $this->set('output', $output);
        $this->set('organizationUsers', $organizationUsers);

        $this->set(
                array(
                    "_serialize" => array('organizationUsers', 'output')
                )
        );

    }
    
   public function activateAssignUser($orgUserid = null,$org_id = null,$user_id = null)
   {
        $data = $this->OrganizationUser->find('first',array(
                'conditions' => array(
                    'OrganizationUser.id' => $orgUserid,
                    'OrganizationUser.organization_id' => $org_id,
                    'OrganizationUser.user_id' => $user_id
                    )
            ));
              
        if(!empty($data))
        {

            $this->OrganizationUser->id = $orgUserid;
            if($data['OrganizationUser']['status'] != '3')
            {
                if($this->OrganizationUser->saveField('status', '3'))
                {
                        $output = '1';
                }
                else
                {
                        $output = '0';
                }
            }
            else
            {
                $output = '3';
            }

            $this->loadModel('BranchUser');
            $options = array('conditions'=>['BranchUser.branch_id'=>$data['OrganizationUser']['branch_id'], 'BranchUser.user_id'=>$data['OrganizationUser']['user_id']]);

            $branchUser = $this->BranchUser->find('first', $options);
            $this->BranchUser->id = $branchUser['BranchUser']['id'];
            $this->BranchUser->saveField('status',1);

           
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
  /*by rabi*/
  public function activateNewUser($orgUserId = null ,$org_id = null)
  {
        $this->OrganizationUser->Behaviors->load('Containable');
        $userStatus = $this->OrganizationUser->find('first',array(
                'conditions' => array(
                        'OrganizationUser.id' => $orgUserId,
                        'OrganizationUser.organization_id' => $org_id
                    ),
                'contain' => array(
                        'User.status'
                    )
            ));
        if ($userStatus['User']['status'] == '1') {
            $this->OrganizationUser->id = $orgUserId;
            if($this->OrganizationUser->saveField('status', '3')){
                $output = '1';
                
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
    public function removeOrgUser($orgUserId = null)
    {
        $this->OrganizationUser->id = $orgUserId;
        if($this->OrganizationUser->saveField('status', '4')){
            $output = '1';
            
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
    public function editUserData($userId = null, $orgId = null){
        // $this->loadModel('Organizationrole');
        // $orgRoleData = $this->Organizationrole->orgRoleData($orgId);
        // $this->loadModel('Branch');
        // $orgBranchData = $this->Branch->orgBranchList($orgId);
        // $this->loadModel('Group');
        // $orgGroupData = $this->Group->listGroup($orgId);
        $orgUserData = $this->OrganizationUser->find('first',array(
            'conditions' => array(
                    'OrganizationUser.user_id' => $userId,
                    'OrganizationUser.organization_id' => $orgId
                )
        ));
        //debug($orgUserData);
        // $this->set('orgRoleData', $orgRoleData);
        // $this->set('orgBranchData', $orgBranchData);
        // $this->set('orgGroupData', $orgGroupData);
        $this->set('orgUserData', $orgUserData);
        $this->set(
                array(
                    "_serialize" => array('orgUserData'),
                     "_jsonp"=>true
                )
        );
    } 
    public function editOrgUser($orgUserId = null,$orgId = null){
         if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
          {
                $this->OrganizationUser->id = $orgUserId; 
                        if ($this->OrganizationUser->save($this->request->data)) {
                            $this->OrganizationUser->emailForUserInfoEdit($orgUserId);
                            $output = '1';
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
    } 
   
    public function getReviews($orgId = null){
            $result = $this->OrganizationUser->getReviews($orgId);
            $this->set(array(
                "result"=>$result,
                "_serialize"=>array("result"),
                "_jsonp"=>true
            ));
    }
    
    public function updateReviews($id = null,$orgId = null){
        $result = $this->OrganizationUser->updateReviews($id,$orgId);
            $this->set(array(
                "result"=>$result,
                "_serialize"=>array("result"),
                "_jsonp"=>true
            ));
    }
    
    public function getOrganizationUsers1($orgId=null,$page=null,$status=null){
        $limit = 10;
        $count = $this->OrganizationUser->countUser($orgId,$status);
        $result = $this->OrganizationUser->getOrganizationUsers($orgId,$page,$status,$limit);
        $maxPage = ceil($count/$limit);
        $this->set(array(
            "result"=>$result,
            "page"=>$page,
            "maxPage"=>$maxPage,
            "_serialize"=>array("result","page","maxPage"),
            "_jsonp"=>true
        ));
    }
     
    public function getUserDetail($orgUserId = null){
        $this->OrganizationUser->Behaviors->load('Containable');
        $userDetail= $this->OrganizationUser->find('first',array(
            'conditions' => array(
                'OrganizationUser.id' => $orgUserId 
            ),
            'contain' => array(
                'Organization',
                'User'
            )
        ));
         $this->set('userDetail', $userDetail);
        $this->set(
                array(
                    "_serialize" => array('userDetail')
                )
        );
    }
    
    public function getOrganizationRequests($userId = null)
    {
        $this->OrganizationUser->Behaviors->load('Containable');
            $options = array(
                'conditions'=>['OrganizationUser.user_id'=>$userId, 'OrganizationUser.status'=>1],
                'contain'=>['Organization'=>['title', 'logo', 'logo_dir']],
                'fields'=>['status','id']
                );

            $list = $this->OrganizationUser->find('all', $options);

            if(isset($list) && !empty($list))
            {
                $status =1;
            }else
            {
                $status =0;
            }

            $this->set(array(
                    'status'=>$status,
                    'list'=>$list,
                    '_serialize'=>array('list', 'status'),
                    '_jsonp'=>true
                ));
    }

    public function activateUser($orgUserid = null)
    {
        $data = $this->OrganizationUser->find('first',array(
                'conditions' => array(
                    'OrganizationUser.id' => $orgUserid
                    )
                ));
              
        if(!empty($data))
        {

            $this->OrganizationUser->id = $orgUserid;


                if($data['OrganizationUser']['status'] != '3'){
                    if($this->OrganizationUser->saveField('status', '3')){
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
        else
        {
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

    public function getBranchUsersAjax($branchId = null,$page = 1){
        $limit = 15;
        $this->OrganizationUser->Behaviors->load('Containable');
        $this->paginate = array('conditions'=>array('OrganizationUser.branch_id'=>$branchId,'OrganizationUser.status'=>3),'contain'=>array('User'), 'limit'=>$limit, 'page'=>$page);
        $result = $this->Paginator->paginate();
        $page=$this->params['paging']['OrganizationUser']['pageCount'];
        $currentPage = $this->params['paging']['OrganizationUser']['page'];

        //debug($this->params['paging']['OrganizationUser']);

		$this->set(array(
            'branchUser'=>$result,
            'pageOption'=>$this->params['paging']['OrganizationUser'],
            '_serialize'=>array('branchUser','pageOption'),
            '_jsonp'=>true
        ));
	}

    public function editEmployeeByOrg()
    {
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
          {

            $usersBoardIds = $this->request->data['boardIds'];

            $usersBoardIds = explode(',', $usersBoardIds);
            $boardUserId = $this->request->data['User']['id'];
            
            $organizationUserId = $this->request->data['OrganizationUser']['id'];
            $boardIdArr = array(); //list of board id from requests.
            if(isset($this->request->data['BoardUser']) && !empty($this->request->data['BoardUser']))
            {
                $this->loadModel('BoardUser');
                $boardUsers = $this->request->data['BoardUser'];

                foreach ($boardUsers as $boardUser)
                {
                    $boardIdArr[] =  $boardUser['board_id'];
                }
                
                foreach ($usersBoardIds as $usersBoardId) {
                        if(in_array($usersBoardId,$boardIdArr))
                        {

                        }else
                        {
                            $conditions = array(
                                            'BoardUser.board_id' => $usersBoardId,
                                            'AND'=>['BoardUser.user_id' => $boardUserId]
                                            
                                        );
                            $this->BoardUser->updateAll(['status'=>0], $conditions);
                        }
                    }
                
                

                foreach ($boardUsers as $boardUser) {

                    $conditions = array(
                                        'BoardUser.board_id' => $boardUser['board_id'],
                                        'AND'=>['BoardUser.user_id' => $boardUserId]
                                        
                                    );
                    if($this->BoardUser->hasAny($conditions))
                    {
                        $conditions = array(
                                        'BoardUser.board_id' => $boardUser['board_id'],
                                        'AND'=>['BoardUser.user_id' => $boardUserId, 'BoardUser.status'=>0]
                                        
                                    );
                        if($this->BoardUser->hasAny($conditions))
                        {
                            $conditions = array(
                                            'BoardUser.board_id' => $boardUser['board_id'],
                                            'AND'=>['BoardUser.user_id' => $boardUserId]
                                            
                                        );
                            $this->BoardUser->updateAll(['status'=>1], $conditions);
                        }
                    }else
                    {
                        $this->BoardUser->create();
                        $data['BoardUser']['user_id'] = $boardUserId;
                        $data['BoardUser']['board_id'] = $boardUser['board_id'];
                        $data['BoardUser']['status'] = 1;

                        $this->BoardUser->save($data);
                    }
                }

            }else
            {
                if(isset($usersBoardIds) && !empty($usersBoardIds))
                {
                    $this->loadModel('BoardUser');
                    foreach ($usersBoardIds as $boardId)
                    {
                        $conditions = array(
                                            'BoardUser.board_id' => $boardId,
                                            'AND'=>['BoardUser.user_id' => $boardUserId]
                                            
                                        );
                        
                        $this->BoardUser->updateAll(['status'=>0], $conditions);
                    }
                }
                
            }
            
            $this->OrganizationUser->emailForUserEditByOrg($organizationUserId,$usersBoardIds,$boardIdArr,$this->request->data);

            if($this->OrganizationUser->saveAll($this->request->data, array('deep'=>true)))
            {
                $output = 1;
            }else
            {
                $output = 0;
            }

            $this->set(array(
                'output'=>$output,
                '_serialize'=>'output',
                '_jsonp'=>true
                ));
          }
    }

    public function listEmployeesNotInBranch($orgId = null, $branch_id = null){
        $this->OrganizationUser->User->Behaviors->load('Containable');
        $orgUsers = $this->OrganizationUser->find('list', array('fields'=>array('user_id'),'group'=>array('OrganizationUser.user_id'), 'conditions'=>array('organization_id'=>$orgId, 'branch_id'=>$branch_id)));
        
        $orgUsersNew = $this->OrganizationUser->find('list', array('fields'=>array('user_id'),'group'=>array('OrganizationUser.user_id'), 'conditions'=>array('organization_id'=>$orgId, 'user_id !='=> $orgUsers)));
        // debug($orgUsersNew);die();

        $employees = $this->OrganizationUser->User->find('all', array('conditions' => array('User.status' => [1,3], 'NOT' => array('User.role_id' => array()), 'User.id'=>$orgUsersNew), 'contain'=>array('Country', 'City')));

        $employ_name = array();
        
         if (!empty($employees)) {
            $status = 1;

            $i = 0;
            $employ_name = array();
            foreach ($employees as $employee ) {
                $orgimage = $employee['User']['imagepath'];

                $employ_name[$i]['User']['id'] = $employee['User']['id'];
                $employ_name[$i]['User']['name'] = $employee['User']['fname']." ".$employee['User']['lname'];
                $employ_name[$i]['User']['email'] = $employee['User']['email'];

                if(!empty($orgimage)){
                    $employ_name[$i]['User']['image'] = $orgimage;
                }
                else{
                    $employ_name[$i]['User']['image'] = URL_API.'webroot/files/user_image/noimage.png';
                }
                $i++;
            }

        } else {
            $status = 0;
        }

        $output = array(
            "params" => $this->request,
            "method" => $this->method,
            "action" => "listEmployeesNotInOrg",
            "status" => $status,
            "error" => array("validation" => "")
        );
        $this->set('employees', $employ_name);
        $this->set('output', $output);

        $this->set(
                array(
                    "_serialize" => array('employees', 'output'),
                    "_jsonp"=>true
                )
        );
        
    }

    public function getUserBranchesInOrgs($orgId = null, $userId = null)
    {
        $this->OrganizationUser->recursive = 2;
        $this->OrganizationUser->Behaviors->load('Containable');
        $employeeBranches = $this->OrganizationUser->find('all', array('conditions'=>array('OrganizationUser.user_id'=>$userId, 'OrganizationUser.organization_id'=>$orgId), 'contain'=>array('Branch.id','Branch.title')));
        
        if (!empty($employeeBranches)) {
            $status = 1;
        } else {
            $status = 0;
        }
        $output = array(
            "params" => $this->request,
            "method" => $this->method,
            "action" => "getUserBranchesInOrgs",
            "status" => $status,
            "error" => array("validation" => "")
        );

        $this->set('output', $output);
        $this->set('employeeBranches', $employeeBranches);

        $this->set(
                array(
                    "_serialize" => array('employeeBranches', 'output')
                )
        );
    }

    public function searchOrganizationUsers($orgId,$name,$branchId,$departmentId,$status){
        $result = $this->OrganizationUser->searchOrganizationUsers($orgId,$name,$branchId,$departmentId,$status);
        // debug($result);

        $this->set(array(
                    'output'=>$result,
                    '_serialize'=>'output'
                ));
       
    }

    public function filterByBranch($orgId,$name,$branchId,$departmentId,$status){
        $result = $this->OrganizationUser->searchOrganizationUsers($orgId,$name,$branchId,$departmentId,$status);

        $this->set(array(
            'output'=>$result,
            '_serialize'=>'output'
            ));
    }


    public function getOrgListOfUser($userId = null)
    {
        $list = $this->OrganizationUser->getOrgListOfUser($userId);

        $status = 0;
        if(isset($list) && !empty($list))
        {
            $status = 1;
        }
        $this->set(array(
            "status"=>$status,
            "list"=>$list,
            "_serialize"=>["status", "list"],
            "_jsonp"=>true
            ));
    }

    public function filterEmployeeList($orgId,$name,$branchId,$departmentId,$status){
        $this->loadModel('ShiftUser');
        $result = $this->OrganizationUser->searchOrganizationUsers($orgId,$name,$branchId,$departmentId,$status);

        $loggedInUsers = $this->ShiftUser->filterEmployeeList($orgId,$name);

        $this->set(array(
            'output'=>$result,
            'loggedInUsers'=>$loggedInUsers,
            '_serialize'=>array('output','loggedInUsers')

            ));
    }

    public function searchEmployeesNotInBranch($orgId = null, $branch_id = null, $searchString = null){
        $this->OrganizationUser->User->Behaviors->load('Containable');
        $orgUsers = $this->OrganizationUser->find('list', array('fields'=>array('user_id'),'group'=>array('OrganizationUser.user_id'), 'conditions'=>array('organization_id'=>$orgId, 'branch_id'=>$branch_id)));

        // debug($orgUsers);die();
        
        $this->loadModel('User');
        $orgUsersNew = $this->User->find('list', array('fields'=>'id','group'=>array('User.id'), 'conditions'=>array('User.id !='=>$orgUsers, 'User.status'=>1)));

        // debug($orgUsersNew);

        $sArr = explode(" ", $searchString);
                    
        foreach ($sArr as $name) {
                $or = array();
                $or = array('User.fname LIKE' => "%".$name."%",'User.lname LIKE' => "%".$name."%",'User.email LIKE' => "%".$name."%");
                $conditions[] = array('NOT' => array('User.role_id' => array()), 'User.id'=>$orgUsersNew,'OR'=>$or);
                }

        $employees = $this->User->find('all', array('conditions' =>$conditions, 'contain'=>array('Country', 'City')));

        // debug($employees);die();

        $employ_name = array();
        
         if (!empty($employees)) {
            $status = 1;

            $i = 0;
            $employ_name = array();
            foreach ($employees as $employee ) {
                $orgimage = $employee['User']['imagepath'];

                $employ_name[$i]['User']['id'] = $employee['User']['id'];
                $employ_name[$i]['User']['name'] = $employee['User']['fname']." ".$employee['User']['lname'];
                $employ_name[$i]['User']['email'] = $employee['User']['email'];

                if(!empty($orgimage)){
                    $employ_name[$i]['User']['image'] = $orgimage;
                }
                else{
                    $employ_name[$i]['User']['image'] = URL_API.'webroot/files/user_image/noimage.png';
                }
                $i++;
            }

        } else {
            $status = 0;
        }

        $output = array(
            "params" => $this->request,
            "method" => $this->method,
            "action" => "listEmployeesNotInOrg",
            "status" => $status,
            "error" => array("validation" => "")
        );
        $this->set('employees', $employ_name);
        $this->set('output', $output);

        $this->set(
                array(
                    "searchString"=>$sArr,
                    "_serialize" => array('employees', 'output','searchString'),
                    "_jsonp"=>true
                )
        );
        
    }

    public function reviewNotification($orgId = null){

        $output = $this->OrganizationUser->reviewNotification($orgId);
        $this->set(array(
                'output'=>$output,
                '_serialize'=>'output',
                '_jsonp'=>true
            ));
    }

    public function listReviewNotification($orgId = null)
    {
        $this->OrganizationUser->updateAll(
                array('reviewnotification'=>1),
                array('OrganizationUser.organization_id'=>$orgId)
                );

        $output = $this->OrganizationUser->listReviewNotification($orgId);
        $this->set(array(
                'output'=>$output,
                '_serialize'=>'output',
                '_jsonp'=>true
            ));
    }
  
}
