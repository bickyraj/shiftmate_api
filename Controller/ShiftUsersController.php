<?php
App::uses('AppController', 'Controller');
/**
 * ShiftUsers Controller
 *
 * @property ShiftUser $ShiftUser
 * @property PaginatorComponent $Paginator
 */
    Configure::write('CakePdf', array(
        'engine' => 'CakePdf.WkHtmlToPdf',
        'options' => array(
            'print-media-type' => false,
            'outline' => true,
            'dpi' => 96
        ),
        'margin' => array(
            'bottom' => 15,
            'left' => 20,
            'right' => 20,
            'top' => 20
        ),
        'binary' => '/usr/local/bin/wkhtmltopdf',
        'orientation' => 'landscape',
        'download' => true
    ));

class ShiftUsersController extends AppController {

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
        
        public function myOrgShiftRange($user_id = NULL, $org_id = NULL, $branch_id = NULL, $start_date = NULL, $end_date = NULL){
            $myOrgShiftRange = $this->ShiftUser->myOrgShiftRange($user_id, $org_id, $branch_id, $start_date, $end_date);
            
            $this->set(array(
                'myOrgShiftRange' => $myOrgShiftRange,
                '_serialize' => array('myOrgShiftRange')
            ));
        }
        
        public function myTempShifts($user_id = NULL){
            $temp_shift = $this->ShiftUser->myTempShifts($user_id);
            //debug($shift);
            $this->set(array(
                'temp_shift'=> $temp_shift,
                '_serialize' => array('temp_shift')
            ));
        }
        
        
        /* for open shift*/
        public function openShift(){
            $openShift = $this->ShiftUser->openShift();
            $this->set(array(
                    'message' => $openShift,
                    '_serialize' => array('message')
                ));
        }
        
        
        /* for normal employee section starts here*/
        
        public function mySchedule($user_id){
            $myScheduleList = $this->ShiftUser->find('all', array(
                'conditions'=>array(
                    'ShiftUser.user_id'=>array($user_id)
                    )
            ));
            
            $this->set(array(
                    'message' => $myScheduleList,
                    '_serialize' => array('message')
                ));
            
        }
        
        public function myScheduleForCalender($user_id){
            $mySch = $this->ShiftUser->myScheduleForCalender($user_id);
            $this->set(array(
                    'mySchedule' => $mySch,
                    '_serialize' => array('mySchedule'),
                    '_jsonp'=>true
                ));
        }
        /* for normal employee section ends here*/
        
        
        // for checking dublicate entry of the shift
        function _checkShiftUserExist($board_id, $user_id, $shift_id, $shift_date){
            $checkCount = $this->ShiftUser->find('count', array(
                'conditions'=>array(
                    'ShiftUser.user_id' => $user_id,
                    'ShiftUser.shift_id' => $shift_id,
                    'ShiftUser.board_id' => $board_id,
                    'ShiftUser.shift_date' => $shift_date
                )));
            return $checkCount;
        }
        
        // for removing shift from schedule by board Manager
       public function deleteShift($shift_user_date, $board_id) {
           $shift_user_date_arr = explode('_', $shift_user_date); // shift_id / user_id / date
           $shift_id = $shift_user_date_arr[0];
           $user_id = $shift_user_date_arr[1];
           $shift_date = $shift_user_date_arr[2];
           $this->ShiftUser->Behaviors->load('Containable');
           $userShiftDetail = $this->ShiftUser->find('first', array(
               'contain'=>false,
               'fields'=> array(
                   'ShiftUser.id'
               ),
               'conditions'=>array(
                   'ShiftUser.user_id'=>$user_id,
                   'ShiftUser.shift_id'=>$shift_id,
                   'ShiftUser.board_id'=>$board_id,
                   'ShiftUser.shift_date'=>$shift_date
               )
           ));
        $this->ShiftUser->id = $userShiftDetail['ShiftUser']['id'];
        if ($this->ShiftUser->delete()) {
            $message['status'] = 'Ok';
        } else {
            $message['status'] = 'Fail';
        }
        $this->set(array(
                    'message' => $message,
                    '_serialize' => array('message')
                ));
    }
        
        // for confirmation of shift by board manager
        public function confirmShift($shiftUser_id, $status, $user_id = NULL){ // $status = 1 for accept and 0 for reject
           $this->ShiftUser->id = $shiftUser_id;
            if($status == 1){
                $updateStatus = 3;
                //$updateShift['ShiftUser']['user_id'] = $user_id;
            }elseif($status == 2){
                $updateStatus = 2;
                $updateShift['ShiftUser']['user_id'] = $user_id;
            }elseif ($status == 4) {
                $updateStatus = 4;
            }
            else{
                $updateStatus = 0;
                // $updateShift['ShiftUser']['user_id'] = 0;
            }
                $updateShift['ShiftUser']['status'] = $updateStatus;
                if($this->ShiftUser->save($updateShift)){
                    $this->ShiftUser->Behaviors->load('Containable');
                    $message['shiftUserDetail'] = $this->ShiftUser->find('first', array(
                        'contain' => false,
                        'conditions'=>array(
                            'ShiftUser.id' => $shiftUser_id
                        )
                    ));
                    $message['status'] = 'Ok';
                }else{
                    $message['status'] = 'Fail';
                }
            /*}else{
                if ($this->ShiftUser->delete()) {
                    $message['status'] = 'Ok';
                }else{
                    $message['status'] = 'Fail';
                }
            }*/
            $this->set(array(
                    'message' => $message,
                    '_serialize' => array('message'),
                    '_jsonp'=>true
                ));
        }
        
        // for checking user availability from user availability table
        function _checkUserAvailability($user_id, $shift_id, $day_id){
            $organization_id = 1; // from session or get value
            $this->loadModel('Useravailability');
            $this->loadModel('Shift');
            $this->Shift->Behaviors->load('Containable');
            // for shifts starttime and endtime
            $shift = $this->Shift->find('first', array(
                'contain'=>false,
                'conditions'=>array(
                    'Shift.id' => $shift_id
                )
            ));
           // debug($shift);
            $shift_starttime = $shift['Shift']['starttime'];
            $shift_endtime = $shift['Shift']['endtime'];
            
            $this->Useravailability->Behaviors->load('Containable');
            //for users availability starttime and endtime for particular day
            $user_availability = $this->Useravailability->find('all', array(
                'contain'=>false,
                'conditions'=> array(
                    'Useravailability.user_id'=>$user_id,
                    'Useravailability.day_id' =>$day_id,
                    'Useravailability.status'=> array('0', '1')
                    )
            ));
            $message['availTime'] = '';
            foreach($user_availability as $userAvailability){
                //if($userAvailability['Useravailability']['status'] == 0){
                if(($userAvailability['Useravailability']['starttime'] <= $shift_starttime && $userAvailability['Useravailability']['endtime'] >= $shift_endtime) || $userAvailability['Useravailability']['status']== 0){
                    //echo $userAvailability['Useravailability']['id'];
                    $this->Useravailability->id = $userAvailability['Useravailability']['id'];
                    $updateData['Useravailability']['organization_id'] = $organization_id;
                    $this->Useravailability->save($updateData);
                    $message['status_ok'] = 'Ok';
                }else{
                    if($userAvailability['Useravailability']['status'] == 1){
                        $message['status_fail'] = 'Fail';
                        $message['availTime'][] = $userAvailability;
                    }
                }
                
            }
            return $message;
           //debug($message);die();
            
        }
        
        // for indivisual shift add from cell on click
         public function addShiftFromCell($source, $board_id){
              if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
                    $board_id = $this->request->data['board_id'];
                            $shift_id = $this->request->data['shift_id_indivisual'];
                            $userCellDetail = $this->request->data['userCellDetail'];
                            $userCellDetailArr = explode('_', $userCellDetail);
                            $user_id = $userCellDetailArr[0];
                            $day_id = $userCellDetailArr[1];
                            $shift_date = $userCellDetailArr[2];
                            
                            
                  }
            
            $sourceArr = explode('_', $source); // shift_id / user_id / date or just shift_id
            
            $destinationArr = explode('_', $destination); // user_id / day_id / date
            
           
            
            // inserting new user to shiftuser table i.e dropped shift   
            $user_id = $newShift['ShiftUser']['user_id'] = $destinationArr[0];
            $shift_date = $newShift['ShiftUser']['shift_date'] = $destinationArr[2];;
            $shift_id = $newShift['ShiftUser']['shift_id'] =$sourceArr[0];
            $newShift['ShiftUser']['board_id'] = $board_id;
            $newShift['ShiftUser']['status'] = $status;
            $day_id = $destinationArr[1];
            
            $checkUserAvailability = $this->_checkUserAvailability($user_id, $shift_id, $day_id ); // user_id / shift_id / day_id
           //$message['available'] = $checkUserAvailability;
          // $message['test'] = $checkUserAvailability['status_fail'];
          if(isset($checkUserAvailability['status_ok']) && $checkUserAvailability['status_ok'] == 'Ok'){
           $checkExist = $this->_checkShiftUserExist($board_id, $user_id, $shift_id, $shift_date);
           if($checkExist == 0){
            
            $this->ShiftUser->create();
            if ($this->ShiftUser->save($newShift)) {
                $this->Session->setFlash(__('The shift user has been saved.'));
                                $message['insert'] = array('status'=>'ok');
                //return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The shift user could not be saved. Please, try again.'));
                                 $message['insert'] = array('status'=>'fail');
            }
            
            if(count($sourceArr) > 1){
                            
                // updating user that shift transfer to new i.e dragged shift
                $shiftUserDetail = $this->ShiftUser->find('first', array(
                    //'contain' => false,
                    'fields' => array('ShiftUser.id'),
                    'conditions'=>array(
                        'ShiftUser.user_id' => $sourceArr[1],
                        'ShiftUser.shift_id' => $sourceArr[0],
                        'ShiftUser.shift_date' => $sourceArr[2]
                    )
                ));
            
                $this->ShiftUser->id = $shiftUserDetail['ShiftUser']['id'];
                $this->ShiftUser->delete();
            }
             $message['status'] = 'Ok';
           }else{
               $message['status'] = 'Exist';
            }
            
        }else{
            $message['status'] = 'notAvailable';
            $message['available'] = $checkUserAvailability;
        }
       // debug($message);die();
            $this->set(array(
                    'message' => $message,
                    '_serialize' => array('message')
                ));
         }
        
        
        
        // for ShiftUser_id 
        public function changeShift($source, $destination, $board_id, $status){
          //  $message['available'] = "test";
            
            $sourceArr = explode('_', $source); // shift_id / user_id / date or just shift_id
            
            $destinationArr = explode('_', $destination); // user_id / day_id / date
            
           
            
            // inserting new user to shiftuser table i.e dropped shift   
            $user_id = $newShift['ShiftUser']['user_id'] = $destinationArr[0];
            $shift_date = $newShift['ShiftUser']['shift_date'] = $destinationArr[2];;
            $shift_id = $newShift['ShiftUser']['shift_id'] =$sourceArr[0];
            $newShift['ShiftUser']['board_id'] = $board_id;
            $newShift['ShiftUser']['status'] = $status;
            $day_id = $destinationArr[1];
            
            $checkUserAvailability = $this->_checkUserAvailability($user_id, $shift_id, $day_id ); // user_id / shift_id / day_id
           //$message['available'] = $checkUserAvailability;
          // $message['test'] = $checkUserAvailability['status_fail'];
          if(isset($checkUserAvailability['status_ok']) && $checkUserAvailability['status_ok'] == 'Ok'){
           $checkExist = $this->_checkShiftUserExist($board_id, $user_id, $shift_id, $shift_date);
           if($checkExist == 0){
            
            $this->ShiftUser->create();
            if ($this->ShiftUser->save($newShift)) {
                $this->Session->setFlash(__('The shift user has been saved.'));
                                $message['insert'] = array('status'=>'ok');
                //return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The shift user could not be saved. Please, try again.'));
                                 $message['insert'] = array('status'=>'fail');
            }
            
            if(count($sourceArr) > 1){
                            
                // updating user that shift transfer to new i.e dragged shift
                $shiftUserDetail = $this->ShiftUser->find('first', array(
                    //'contain' => false,
                    'fields' => array('ShiftUser.id'),
                    'conditions'=>array(
                        'ShiftUser.user_id' => $sourceArr[1],
                        'ShiftUser.shift_id' => $sourceArr[0],
                        'ShiftUser.shift_date' => $sourceArr[2]
                    )
                ));
            
                $this->ShiftUser->id = $shiftUserDetail['ShiftUser']['id'];
                $this->ShiftUser->delete();
            }
             $message['status'] = 'Ok';
           }else{
               $message['status'] = 'Exist';
            }
            
        }else{
            $message['status'] = 'notAvailable';
            $message['available'] = $checkUserAvailability;
        }
       // debug($message);die();
            $this->set(array(
                    'message' => $message,
                    '_serialize' => array('message')
                ));
        }
        
        
    
        public function userShift($board_id){
           $this->ShiftUser->Behaviors->load('Containable');
           $userShift = $this->ShiftUser->find('all', array(
                                                   'contain'=>array('Shift', 'User'),
                                                  'conditions'=>array(
                                                      'ShiftUser.board_id'=>$board_id,
                                                      'ShiftUser.shift_date >=' => date('Y-m-d')/*,
                                                      'ShiftUser.status'=>1*/
                                                      )
                         )
                    );
           // debug($userShift);
            //$userShift = array($user_id, $board_id, $date);
            $this->set(array(
                    'message' => $userShift,
                    '_serialize' => array('message')
                ));
            
        }
        
        public function organizationShiftList($organization_id){
            $this->ShiftUser->Shift->Behaviors->load('Containable');
            $shifts = $this->ShiftUser->Shift->find('all', array('contain'=>false, 'conditions'=>array('Shift.organization_id'=>$organization_id)));
            //debug($shifts);die();
            $output= array("shiftList" => $shifts);
                
            $this->set(array(
                    'message' => $output,
                    '_serialize' => array('message')
                
                )); 
        }
    
    

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->ShiftUser->recursive = 0;
        $this->set('shiftUsers', $this->Paginator->paginate());
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        if (!$this->ShiftUser->exists($id)) {
            throw new NotFoundException(__('Invalid shift user'));
        }
        $options = array('conditions' => array('ShiftUser.' . $this->ShiftUser->primaryKey => $id));
        $this->set('shiftUser', $this->ShiftUser->find('first', $options));
    }

/**
 * add method
 *
 * @return void
 */
        public function add() {
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
        //$this->request->data['ShiftUser'] 
       $dayArr_day = array('Sunday'=>'1', 'Monday'=>'2', 'Tuesday'=>'3', 'Wednesday'=>'4', 'Thursday'=>'5', 'Friday'=>'6', 'Saturday'=>7);
                    $user_id = $this->request->data['ShiftUser']['user_id'];
                    $organization_id = $this->request->data['ShiftUser']['organization_id'];
                    $board_id = $this->request->data['ShiftUser']['board_id'];
                    $shift_id = $this->request->data['ShiftUser']['shift_id'];
                    //$date = $this->request->data['ShiftUser']['shift_date'];
                    $date = date('Y-m-d');
                    $date_day = date('l');
                    $today_id = $dayArr_day[$date_day];
                    
                    $end_date = $this->request->data['ShiftUser']['end_date'];
                    $recurring = $this->request->data['ShiftUser']['recurring'];
                    $check_days = $this->request->data['ShiftUser']['checked_days'];
                    
                   /* $todayDay = date('l', strtotime($date));
                    $day_id = $dayArr[$todayDay];*/
                    
                    $this->loadModel('OrganizationUser');
                    $this->OrganizationUser->Behaviors->load('Containable');
                    
                    // if $permanent_check > 0 or = 1 then the employee is permanent
                 /*   $permanent_check = $this->OrganizationUser->find('count', array(
                            'contain'=>false,
                            'conditions'=>array(
                                    'OrganizationUser.user_id'=>$user_id,
                                    'OrganizationUser.organization_id' => $organization_id,
                                    'OrganizationUser.status'=>1)
                                )
                            );*/
                    //$message['countCheck'] = $permanent_check;
                    $dayArr = array('Sunday'=>'1', 'Monday'=>'2', 'Tuesday'=>'3', 'Wednesday'=>'4', 'Thursday'=>'5', 'Friday'=>'6', 'Saturday'=>7);
                    if($recurring == 1){
                        $this->loadModel('Permanentshift');
                        foreach($check_days as $check_day){
                            $permanentShift['Permanentshift']['user_id'] = $user_id;
                            $permanentShift['Permanentshift']['board_id'] = $board_id;
                            $permanentShift['Permanentshift']['day_id'] = $check_day;
                            $permanentShift['Permanentshift']['shift_id'] = $shift_id;
                            $permanentShift['Permanentshift']['start_date'] = $date;
                            $permanentShift['Permanentshift']['end_date'] = $end_date;
                            $permanentShift['Permanentshift']['status'] = 1;
                            $this->Permanentshift->create();
                            $this->Permanentshift->save($permanentShift);
                        }
                        $message = array('tested'=>'ok');
                    }else{
                         $dayArr = array('1'=>'Sunday', '2'=>'Monday', '3'=>'Tuesday', '4'=>'Wednesday', '5'=>'Thursday', '6'=>'Friday', '7'=>'Saturday');
                         $dayArr_day = array('Sunday'=>'1', 'Monday'=>'2', 'Tuesday'=>'3', 'Wednesday'=>'4', 'Thursday'=>'5', 'Friday'=>'6', 'Saturday'=>7);
                        foreach($check_days as $check_day){
                            if($check_day < $today_id){
                                $checked_day_today_diff = $today_id - $check_day;
                                $factor = 7 - $checked_day_today_diff;
                                $time_added = 3600*24*$factor;
                                $req_date = date('Y-m-d', strtotime($date) + $time_added);
                            }elseif($check_day > $today_id){
                                $checked_day_today_diff = $check_day - $today_id;
                                $time_added = 3600*24*$checked_day_today_diff; 
                                $req_date = date('Y-m-d', strtotime($date) + $time_added);
                            }else{
                                $req_date = date('Y-m-d');
                            }
                            $this->request->data['ShiftUser']['shift_date'] = $req_date;
                            $this->ShiftUser->create();
                            $this->ShiftUser->save($this->request->data);
                            $message = array('tested'=>'ok');
                        }   
            
                    }
                        
                        $this->set(array(
                    'message' => $message,
                    '_serialize' => array('message')
                
                ));
        }
        
    }
    
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        if (!$this->ShiftUser->exists($id)) {
            throw new NotFoundException(__('Invalid shift user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->ShiftUser->save($this->request->data)) {
                $this->Session->setFlash(__('The shift user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The shift user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('ShiftUser.' . $this->ShiftUser->primaryKey => $id));
            $this->request->data = $this->ShiftUser->find('first', $options);
        }
        $boards = $this->ShiftUser->Board->find('list');
        $shifts = $this->ShiftUser->Shift->find('list');
        $users = $this->ShiftUser->User->find('list');
        $this->set(compact('boards', 'shifts', 'users'));
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete($id = null) {
        $this->ShiftUser->id = $id;
        if (!$this->ShiftUser->exists()) {
            throw new NotFoundException(__('Invalid shift user'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ShiftUser->delete()) {
            $this->Session->setFlash(__('The shift user has been deleted.'));
        } else {
            $this->Session->setFlash(__('The shift user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }


    public function myShifts($userId=null, $page = 1)
    {
        $this->recursive = 2;
        $this->ShiftUser->Behaviors->load('Containable');

        $limit = 10;

           $this->paginate =  array(
                'conditions'=>array('ShiftUser.user_id'=>$userId,'ShiftUser.status'=>3),
                'contain'=>array(
                    'Board.Organization',
                     'Shift',
                      'Shift.Shiftnote',
                        'Board.ShiftUser.User'=>array('fields' => array('id','fname', 'lname'))

                        ),
                'limit'=>$limit,'page'=>$page
                // 'order'=>array('ShiftUser.shift_date' => 'DESC')
                );
           $myShifts = $this->Paginator->paginate();

            // debug($myShifts);die();


            $page=$this->params['paging']['ShiftUser']['pageCount'];
            $currentPage = $this->params['paging']['ShiftUser']['page'];
            if(isset($myShifts))
            {

                    $output=array(
                        'status'=>'1',
                        'page'=> $page,
                        'currentPage'=>$currentPage);

                    $this->set('output', $output);
                    $this->set('myShifts',$myShifts);

                    $this->set(array('_serialize'=>array('myShifts', 'output')));
            }

            else
            {
                $output=array('status'=>'0', 'error'=>'No shifts available');

                    $this->set('output', $output);
                    $this->set(array('_serialize'=>array('output')));
            }

            // debug($myShifts);

        
    }

    public function assignShiftToUser()
    {
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
        {

            $this->ShiftUser->create();

            $this->request->data['ShiftUser']['status'] = '0';

            if ($this->ShiftUser->save($this->request->data)) {
                $output = ['status'=>1];
            } else {
                $output = ['status'=>0];
            }
        }

        $this->set(
                    array(
                        "output" => $output,
                        "_serialize" => 'output'
                    )
            );

    }

    public function getRunningShiftsOld($userId = null)
    {
        $this->ShiftUser->Behaviors->load('Containable');
        // $this->ShiftUser->recursive = 2;
        $date = date('Y-m-d');
        $time = date('H:i:s');

        // echo $date." ".$time."<br/>";
        // echo (date("H:i:s", strToTime($time)-(60*30)));

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



        $runningShift = $this->ShiftUser->find('first', $runningOptions);

        if(!empty($runningShift) && $time >= $runningShift['Shift']['endtime'])
        {
            $this->ShiftUser->id = $runningShift['ShiftUser']['id'];

            $d = $runningShift['ShiftUser']['shift_date'].' '.$runningShift['Shift']['endtime'];
            $this->ShiftUser->saveField('check_status', 2);
            $this->ShiftUser->saveField('check_out_time', $d);

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

            $runningShift = $this->ShiftUser->find('first', $runningOptions);

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
            $nextAllShift = $this->ShiftUser->find('all', $nextOptions);
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
             $this->set('output','1'); 
            

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
            $nextAllShift = $this->ShiftUser->find('all', $nextOptions);

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
             $this->set('runningShift', $shift);
             $this->set('output','1'); 
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

        $this->set(array(
            'runningShiftStatus'=>$runningShiftStatus,
            'nextShiftStatus'=>$nextShiftStatus,
            '_serialize'=>array('runningShift', 'output', 'runningShiftStatus', 'nextShiftStatus')
            ));

    }

    public function getRunningShifts($userId = null)
    {
        $shift = $this->ShiftUser->getRunningShifts($userId);

        $data = $shift[0];

        $this->set(array(
            'data'=>$data,
            '_serialize'=>'data',
            '_jsonp'=>true
            ));

    }

    public function checkIn($userId=null, $shiftUserId = null)
    {
        $this->ShiftUser->Behaviors->load('Containable');
        $this->ShiftUser->recursive = 0;
        $check_in_time = date('Y-m-d H:i:s');

        $this->ShiftUser->id = $shiftUserId;

        $shiftTime = $this->ShiftUser->find('first', [
            'conditions'=>['ShiftUser.id'=>$shiftUserId],
            'contain'=>['Shift']
            ]);

        // for late check in
        $shiftStartTime = $shiftTime['Shift']['starttime'];
        $lateTime = date("H:i:s", strToTime($shiftStartTime)+(60*10));
        $checkTime = date("H:i:s",strToTime($check_in_time));

        if($checkTime > $lateTime)
        {
            $data = array('check_in_time'=>$check_in_time, 'check_status'=>'1', 'latestatus'=>'1');
        }
        else
        {
            $data = array('check_in_time'=>$check_in_time, 'check_status'=>'1');
        }


        

        if($this->ShiftUser->exists())
        {
            if($this->ShiftUser->save($data))
            {
                $output = array('status'=>'1');
            }
            else
            {
                $output = array('status'=>'0');
            }
            
            $this->set('output', $output);
            $this->set(array('_serialize'=>array('output')));
        }

    }

    public function checkOut($shiftUserId = null)
    {
        $this->ShiftUser->recursive = 0;
        $check_out_time = date('Y-m-d H:i:s');

        $this->ShiftUser->id = $shiftUserId;

        $shift = $this->ShiftUser->find('first', [
            'conditions'=>['ShiftUser.id'=>$shiftUserId],
            'contain'=>['Shift']
            ]);
            
        $shiftEndTime = $shift['Shift']['endtime'];
        $checkoutTime = date("H:i:s",strToTime($check_out_time));

        if($checkoutTime < $shiftEndTime)
        {
            $data = array('check_out_time'=>$check_out_time, 'check_status'=>'2', 'earlytime'=>$check_out_time);
        }
        elseif($checkoutTime > $shiftEndTime)
        {

            $data = array('check_out_time'=>$check_out_time, 'check_status'=>'2', 'latetime'=>$check_out_time);
        }
        else
        {
            $data = array('check_out_time'=>$check_out_time, 'check_status'=>'2');
        }

        if($this->ShiftUser->exists())
        {
            if($this->ShiftUser->save($data))
            {
                $shift = $this->ShiftUser->find('first', [
                    'conditions'=>['ShiftUser.id'=>$shiftUserId],
                    'contain'=>['Shift']
                ]);
                $this->loadModel("Account");
                $this->Account->saveDate($shift);
                $output = array('status'=>'1');
            }
            else
            {
                $output = array('status'=>'0');
            }
            
            $this->set('output', $output);
            $this->set(array('_serialize'=>array('output')));
        }

    }
    
    public function listOfCheckedInUsersInBranch($orgId=null,$branchId=null){
        $this->ShiftUser->Behaviors->load('Containable');
        $dateToday = date('Y-m-d');
        $this->paginate = array(
            'conditions'=>array(
                "ShiftUser.organization_id"=>$orgId,
                "ShiftUser.check_status >="=>'1',
                "ShiftUser.shift_date"=> $dateToday,
                "Board.Branch_id"=>$branchId
                ),
            'order'=>'ShiftUser.check_in_time ASC',
            'contain'=>array('Organization','Board','Board.Branch','Shift','User')
            );

        $shiftUsers = $this->Paginator->paginate();
          $this->set('shiftUsers', $shiftUsers);

            $this->set(
                    array(
                        "_serialize" => array('shiftUsers'),
                        "_jsonp"=>true
               ));
    }
    
    public function listOfCheckedInUsers($orgId= null)
    {
        $this->ShiftUser->Behaviors->load('Containable');
        $dateToday = date('Y-m-d');
        $this->paginate = array(
            'conditions'=>array(
                "ShiftUser.organization_id"=>$orgId,
                "ShiftUser.check_status >="=>'1',
                "ShiftUser.shift_date"=> $dateToday
                ),
            'order'=>'ShiftUser.check_in_time ASC',
            'contain'=>array('Organization','Board','Board.Branch','Shift','User')
            );

        $shiftUsers = $this->Paginator->paginate();

        $page=$this->params['paging']['ShiftUser']['pageCount'];
        $currentPage = $this->params['paging']['ShiftUser']['page'];

        if (!empty($shiftUser)) {
                $status = 1;
            } else {
                $status = 0;
            }

        $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "listOfCheckedInUsers",
                "status" => $status,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );

            $this->set('output', $output);
            $this->set('shiftUsers', $shiftUsers);

            $this->set(
                    array(
                        "_serialize" => array('shiftUsers', 'output'),
                        "_jsonp"=>true
                    )
            );
    }


     /* ************************** Ashok Neupane ***************** */
    public function shiftRequests($user_id){
        $allShifts=$this->ShiftUser->shiftRequests($user_id);
        $this->set(array(
                'allShifts' => $allShifts,
                '_serialize' => array('allShifts')
            ));
    }
    public function responseRequests(){
        $this->ShiftUser->id=$this->request->data['ShiftUser']['id'];
        if($this->ShiftUser->save($this->request->data)){
            $message="1";
        }else{
            $message="0";
        }
        $this->set(array(
            'message'=>$message,
            '_serialize'=>array('message')
        ));
    }
    public function usersRequests($org_id){
        $allRequests=$this->ShiftUser->usersRequests($org_id);
        $this->set(array(
                'allRequests' => $allRequests,
                '_serialize' => array('allRequests')
            ));
    }
  /* ****************************************************************** */
    public function dashboardShift($user_id = null)
    {
        $todayDate = date('Y-m-d');

       // $this->ShiftUser->recursive= -1;
        $this->ShiftUser->Behaviors->load('Containable');
        $output=$this->ShiftUser->find('all',array(
            
            'limit'=>2,
             'conditions' => array(
                        'ShiftUser.user_id' => $user_id,
                        'ShiftUser.shift_date >=' => $todayDate
                    ),
             'contain'=>['Shift']

           ));
          $this->set('output', $output);

            $this->set(
                    array(
                        "_serialize" => array('shiftDate', 'output')
                    )
            );
    }


    
    /* ************************ Ashok Neupane ********************** */
    public function assignShiftToUsers($planId){
         $this->loadModel('Shiftplan');
         $this->loadModel('ShiftplanUser');
         if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
        {   
            $randomUsers = $this->Shiftplan->autoAssign($planId);
            if(!empty($randomUsers)){
             foreach($randomUsers as $date=>$users){
                if(empty($users)){
                    $output['status'] = 3;
                }
                $shiftDate = $date;
                foreach($users as $u){
                    $this->request->data['ShiftUser']['shift_date'] = $shiftDate;
                    $this->request->data['ShiftplanUser']['0']['shift_date'] = $shiftDate;
                    $this->request->data['ShiftUser']['user_id'] = $u;
                    $this->request->data['ShiftUser']['status'] = 1;

                    if($this->ShiftUser->saveAll($this->request->data)){
                        $output['status'] = 1; // saved
                        $output['userDetails'] = $this->ShiftplanUser->assignDetail($planId);
                    }else{
                        $output['status'] = 0; // not saved
                    }
                }
             }
            } else {
                $output['status'] = 2;// not enough user or already assigned
            }
            $this->set(array(
                'output'=>$output,
                '_serialize'=>array('output')
            ));
        }
    }
    /* ************************************************************ */

    public function getShiftsOnParticularDate($userId = null, $orgId = null, $shiftDate = null)
    {

        $options = array('conditions'=>['ShiftUser.user_id'=>$userId, 'ShiftUser.organization_id'=>$orgId, 'ShiftUser.shift_date'=>$shiftDate], 'ShiftUser.status'=>'3', 'ShiftUser.check_status'=>'0');

        $shiftList = $this->ShiftUser->find('all', $options);
        // debug($shiftList);die();

        if (!empty($shiftList)) {
                    $status = 1;
                } else {
                    $status = 0;    
                }
                $output = array(
                    "params" => $this->request,
                    "method" => $this->method,
                    "action" => "getShiftsOnParticularDate",
                    "status" => $status,
                    "error" => array("validation" => "")
                );

                $this->set('output', $output);
                $this->set('shiftList', $shiftList);

                $this->set(
                        array(
                            "_serialize" => array('shiftList', 'output'),
                            "_jsonp"=>true
                        )
                ); 
    }



    /* ***************Ashok********************************************************* */

    /*by rrabi*/
    public function assignShiftListByDate($org_id = null,$page = 1)
    {
        $limit = 15;
        $todayDate = date('Y-m-d');
        $this->ShiftUser->Behaviors->load('Containable');
        $output=$this->ShiftUser->find('all',array(
            'conditions' => array(
                'ShiftUser.organization_id' => $org_id,
                'ShiftUser.shift_date >=' =>  $todayDate,
                'ShiftUser.status !=' => 5
                ),
                'page'=>$page,
                'limit'=>$limit,
                'contain' => ['Shift','User']
            ));
        $count=$this->ShiftUser->find('count',array(
            'conditions' => array(
                'ShiftUser.organization_id' => $org_id,
                'ShiftUser.shift_date >=' =>  $todayDate,
                'ShiftUser.status !=' => 5
            )));
       $this->set('output',$output);
        $this->set('page',$page);
        $this->set('maxPage',ceil($count/$limit));
       $this->set(
            array(
                    "_serialize" => array('output',"page","maxPage")
                )
        ); 
       
    }
    public function shiftUserStatus($shiftId = null)
    {
         if ($this->ShiftUser->delete($shiftId))
         {
                $output = 1;
            } 
            else {
                $output = 0;
            }
       $this->set('output',$output);
       $this->set(
            array(
                    "_serialize" => array('output'),
                    "_jsonp"=>true
                )
        ); 
    }
    /* By Rabi*/
    public function shiftCancel($user_id = null)
    {
        $todayDate = date('Y-m-d');
        $this->ShiftUser->Behaviors->load('Containable');
        $output=$this->ShiftUser->find('all',array(
                'conditions' => array(
                'ShiftUser.user_id' => $user_id,
                'ShiftUser.shift_date >=' => $todayDate,
                'ShiftUser.status =' => 5
                ),
                'contain' => ['Organization','Shift']
            ));
       // debug($output);
        $this->set('output',$output);
        $this->set(
            array(
                "_serialize" => array('output')
                )
            );
    }


/* ***************Ashok ********************************************************* */

public function getOrganizationDashboardTotal($orgId=null,$start_date=null,$end_date=null){

    // if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
    // {
            $this->loadModel('Shift');

            if($start_date !=null || $end_date !=null){
                
            $totalOrganizationShifts=  $this->Shift->find('count',['conditions'=>['Shift.organization_id'=>$orgId,'Shift.status'=>1]]);
            $totalShifts = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.status >='=>1, 'ShiftUser.check_status'=>2,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
            $noOfOverTimes = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.latetime >='=>1,'ShiftUser.shift_date >='=>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
            
             // debug($noOfOverTimes);
            }else{
                
            $totalOrganizationShifts=  $this->Shift->find('count',['conditions'=>['Shift.organization_id'=>$orgId,'Shift.status'=>1]]);
            $totalShifts = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.status >='=>1, 'ShiftUser.check_status'=>2]]);
            $noOfOverTimes = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.latetime >='=>1]]);

            }

            $totalWorkinHour =0;

           foreach ($totalShifts as $manager) {

                $time = strToTime($manager['ShiftUser']['check_out_time'])-strToTime($manager['ShiftUser']['check_in_time']);
             
                $totalWorkinHour =($totalWorkinHour + $time);

            }

            
            $totalWorkinHour= date(gmdate("H:i:s",$totalWorkinHour));

            

            $totalOverTime =0;

           foreach ($noOfOverTimes as $noOfOverTime) {

                $time = strToTime($noOfOverTime['ShiftUser']['latetime'])-strToTime($noOfOverTime['ShiftUser']['shift_date']." ".$noOfOverTime['Shift']['endtime']);

                $totalOverTime = $totalOverTime + $time;
            
            }        
                $totalOverTime = date(gmdate('H:i:s',$totalOverTime));



            $this->set(

                array(
                    
                    'totalOrganizationShifts'=>$totalOrganizationShifts,
                    'totalWorkinHour'=>$totalWorkinHour,
                    'totalOverTime'=>$totalOverTime,
                    '_serialize'=>array('totalOrganizationShifts','totalWorkinHour','totalOverTime'),
                    '_jsonp'=>true
                    
                    ));
        // }


}



public function getDashboardTotalWork($userId=null,$orgId=null,$start_date=null,$end_date=null){

     if($start_date!=null || $end_date!=null){

        if($orgId==null){


         $totalShifts = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.status >='=>1, 'ShiftUser.check_status'=>2,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
         $totalShiftCount = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.status >='=>1, 'ShiftUser.check_status'=>2,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
         $noOfOverTimes = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.latetime >='=>1,'ShiftUser.shift_date >='=>$start_date,'ShiftUser.shift_date <='=>$end_date]]);   
        }else{


         $totalShifts = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.status >='=>1, 'ShiftUser.check_status'=>2,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
         $totalShiftCount = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.status >='=>1, 'ShiftUser.check_status'=>2,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
         $noOfOverTimes = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.latetime >='=>1,'ShiftUser.shift_date >='=>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
            
        }


    }   else{

        if($orgId==null)

        {
            $totalShifts = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.status >='=>1, 'ShiftUser.check_status'=>2]]);
             $totalShiftCount = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status ' =>2]]);
             $noOfOverTimes = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.latetime >=' =>1]]);
        }
        else
        {
            $totalShifts = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.status >='=>1, 'ShiftUser.check_status'=>2]]);
            $totalShiftCount = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.status >='=>1, 'ShiftUser.check_status'=>2]]);
            $noOfOverTimes = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.latetime >=' =>1]]);
        }

    }
           
        $totalWorkinHourNormal =0;

           foreach ($totalShifts as $shiftUser) {

                $time = strToTime($shiftUser['ShiftUser']['check_out_time'])-strToTime($shiftUser['ShiftUser']['check_in_time']);
             
                $totalWorkinHourNormal = $totalWorkinHourNormal + $time;
            }
            
           $totalWorkinHour= date(gmdate("H:i:s",$totalWorkinHourNormal));

           //debug($totalWorkinHourNormal);

        $totalOverTimeNormal =0;

           foreach ($noOfOverTimes as $noOfOverTime) {

             $time = strToTime($noOfOverTime['ShiftUser']['latetime'])-strToTime($noOfOverTime['ShiftUser']['shift_date']." ".$noOfOverTime['Shift']['endtime']);

                $totalOverTimeNormal = $totalOverTimeNormal + $time;
               
            
            }        
               $totalOverTime = date(gmdate("H:i:s",$totalOverTimeNormal));

               //debug($totalOverTime);


         
         $this->set(
            array(
                'totalShiftCount'=>$totalShiftCount,
                'totalWorkinHourNormal'=>$totalWorkinHourNormal,
                'totalWorkinHour'=>$totalWorkinHour,
                'totalOverTimeNormal'=>$totalOverTimeNormal,
                'totalOverTime'=>$totalOverTime,
                '_serialize'=>array('totalShiftCount','totalWorkinHourNormal','totalWorkinHour','totalOverTimeNormal','totalOverTime'),
                '_jsonp'=>true
                ));

    
     
      }



    public function getCount($userId=null,$orgId=null,$board_id=null,$start_date=null,$end_date=null)
    {
            if($orgId==null){
                $totalNoOfLateCheckIn = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status'=>2, 'ShiftUser.latestatus'=>1]]);
                $totalNoOfShifts = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId, 'ShiftUser.check_status'=>2]]);
                $absent = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.status >='=>1, 'ShiftUser.check_status'=>3]]);
                $earlyCheckOut = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status'=>2,'ShiftUser.earlytime >'=> 0]]);
                $lateCheck = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status'=>2,'ShiftUser.latetime >'=> 0]]);
            }
            elseif($board_id !=null)
                {
                $totalNoOfLateCheckIn = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.board_id'=>$board_id, 'ShiftUser.check_status'=>2,'ShiftUser.latestatus'=>1]]);
                $totalNoOfShifts = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.board_id'=>$board_id, 'ShiftUser.status >='=>2]]);
                $absent = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.board_id'=>$board_id,'ShiftUser.status >='=>1, 'ShiftUser.check_status'=>3]]);
                $earlyCheckOut = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status'=>2,'ShiftUser.board_id'=>$board_id,'ShiftUser.earlytime >'=> 0]]);
                $lateCheck = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status'=>2,'ShiftUser.board_id'=>$board_id,'ShiftUser.latetime >'=> 0]]);
            
                }

                else{
                $totalNoOfLateCheckIn = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId, 'ShiftUser.check_status'=>2,'ShiftUser.latestatus'=>1]]);
                $totalNoOfShifts = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId, 'ShiftUser.status >='=>1,'ShiftUser.check_status'=>2]]);
                $absent = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.status >='=>1, 'ShiftUser.check_status'=>3]]);
                $earlyCheckOut = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status'=>2,'ShiftUser.organization_id'=>$orgId,'ShiftUser.earlytime >'=> 0]]);
                $lateCheck = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status'=>2,'ShiftUser.organization_id'=>$orgId,'ShiftUser.latetime >'=> 0]]);
            }
            
          

            $number['totalNoOfLateCheckIn']=$totalNoOfLateCheckIn;
            $number['totalShifts']=$totalNoOfShifts;
            $number['absent']=$absent;
            $number['present']= $totalNoOfShifts- $absent;
            $number['earlyCheckOut']= $earlyCheckOut;
            $number['lateCheck']= $lateCheck;
            
           


            $this->set(array(
                    'number'=>$number,
                    '_serialize'=>array('number')
                ));
          
            return $number;
        }


     public function getTotal($userId,$orgId=null){
            if($orgId==null)
            {
                $totalShifts = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status >=' =>2]]);
            }
            else
            {
                $totalShifts = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.check_status >=' =>2]]);
            }
               // debug($totalShifts);
            $totalWorkinHour =0;

               foreach ($totalShifts as $shiftUser) {

                    $time = strToTime($shiftUser['ShiftUser']['check_out_time'])-strToTime($shiftUser['ShiftUser']['check_in_time']);
                 

                    $totalWorkinHour = $totalWorkinHour + $time;
                }
                /*debug($totalWorkinHour);*/
             
         $this->set(
            array(
                'output'=>$totalWorkinHour,
                '_serialize'=>array('output')
                ));

         return $totalWorkinHour;
         
          }


    public function getOverTime($userId,$orgId=null,$start_date=null,$end_date=null)
    {
            if($orgId==null){

                $noOfOverTimes = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status'=>2, 'ShiftUser.latetime >=' =>1]]);
                $lateCheckInTimes= $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status'=>2,'ShiftUser.latetime >=' =>1,'ShiftUser.latestatus'=>1]]);
                $lessToFullWorkTimes= $this->ShiftUser->find('all',['conditions'=>['ShiftUser.user_id'=>$userId, 'ShiftUser.check_status'=>2,'Shift.endtime >'=>  date('H:i:s', strToTime('ShiftUser.check_out_time'))]]);
                // debug($lessToFullWorkTimes);die();
                }
           else
           {
                if($start_date!=null || $end_date!=null){
                    $noOfOverTimes = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status'=>2,'ShiftUser.organization_id'=>$orgId,'ShiftUser.latetime >=' =>1,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
                $lateCheckInTimes = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status'=>2,'ShiftUser.organization_id'=>$orgId,'ShiftUser.latetime >=' =>1,'ShiftUser.latestatus'=>1,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
                $lessToFullWorkTimes= $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status'=>2,'ShiftUser.organization_id'=>$orgId,'Shift.endtime >'=> date('H:i:s', strToTime('ShiftUser.check_out_time')),'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]); 

                }else{

                $noOfOverTimes = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status'=>2,'ShiftUser.organization_id'=>$orgId,'ShiftUser.latetime >=' =>1]]);
                $lateCheckInTimes = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status'=>2,'ShiftUser.organization_id'=>$orgId,'ShiftUser.latetime >=' =>1,'ShiftUser.latestatus'=>1]]);
                $lessToFullWorkTimes= $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status'=>2,'ShiftUser.organization_id'=>$orgId,'Shift.endtime >'=> date('H:i:s', strToTime('ShiftUser.check_out_time'))]]); 
                 }
            }

                $totalLessToFullWorkTime=0;
                

                                   
                    foreach ($lessToFullWorkTimes as $lessToFullWorkTime) {
                        if ($lessToFullWorkTime['ShiftUser']['check_out_time'] == "0000-00-00 00:00:00") {
                                if($lessToFullWorkTime['ShiftUser']['check_in_time'] == "0000-00-00 00:00:00"){
                                    $lessHours = strtotime($lessToFullWorkTime['Shift']['endtime']) - strtotime($lessToFullWorkTime['Shift']['starttime']);
                                }else{
                                    $a = strtotime($lessToFullWorkTime['Shift']['endtime']);
                                    $b= strtotime(date("H:i:s",strtotime($lessToFullWorkTime['ShiftUser']['check_in_time'])));
                                    if($a > $b){
                                        $lessHours = $a - $b;
                                    }else{
                                        $lessHours = 0;
                                    }
                                }
                        } else {
                            $a = strToTime($lessToFullWorkTime['ShiftUser']['check_out_time']);
                            $b = strToTime($lessToFullWorkTime['ShiftUser']['shift_date'] . " " . $lessToFullWorkTime['Shift']['endtime']);

                        if ($a < $b) {

                            $lessHours = $b - $a;
                        } else {

                            $lessHours = 0;
                        }
                    }
                    $totalLessToFullWorkTime = $totalLessToFullWorkTime + $lessHours; 
                   
                    }
                
                $totalOverTime =0;
    
               foreach ($noOfOverTimes as $noOfOverTime) {

                    $c = strToTime($noOfOverTime['ShiftUser']['check_out_time']);
                    $d=strToTime($noOfOverTime['ShiftUser']['shift_date']." ".$noOfOverTime['Shift']['endtime']);
                    if($d < $c){
                        $cal = $c- $d;
                    }else {
                        $cal = 0;
                    }
                  
                    $totalOverTime = $totalOverTime + $cal;
                }

                $totalLateCheckInTime=0;

                foreach ($lateCheckInTimes as $lateCheckInTime) {
                    $lateHours =strToTime($lateCheckInTime['ShiftUser']['check_in_time'])-strToTime($lateCheckInTime['Shift']['starttime']);
                    $totalLateCheckInTime =$totalLateCheckInTime + $lateHours;   
                }

                /*   debug($totalLessToFullWorkTime);*/

                $output = [ 'totalOverTimeWorking'=>$totalOverTime, 
                            'totalLateCheckInTime'=>$totalLateCheckInTime,
                            'totalLessToFullWorkTime'=>$totalLessToFullWorkTime
                            ];

                 $this->set(
                 array(
                    'output'=>$output,

                    '_serialize'=>array('output'),
                    '_jsonp'=>true

                    )); 
             
                 return $output;
                
              }

    public function getByDate(){ //in user login

                if(isset($this->request->data['ShiftUser']['organization_id'])){
                   
                    $orgId=$this->request->data['ShiftUser']['organization_id'];
                    $userId=$this->request->data['ShiftUser']['user_id'];
                    $start_date=$this->request->data['ShiftUser']['start_date'];
                    $end_date=$this->request->data['ShiftUser']['end_date'];
                    
                        $totalShifts = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.check_status >=' =>1,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
                        $noOfOverTimes = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.latetime >=' =>1,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
                        $lateCheckInTimes = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.latetime >=' =>1,'ShiftUser.latestatus'=>1,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
                        $lessToFullWorkTimes= $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.check_status'=>2,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date,'Shift.endtime >'=> date('H:i:s', strToTime('ShiftUser.check_out_time'))]]);
          

                        $totalNoOfLateCheckIn = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.check_status'=>2, 'ShiftUser.latestatus'=>1,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
                        $totalNoOfShifts = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId, 'ShiftUser.status >='=>1,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
                        $absent = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.status >='=>1, 'ShiftUser.check_status'=>0,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
                        $earlyCheckOut = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.earlytime >'=> 0,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
                        $lateCheck = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.latetime >'=> 0,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);

                }else{
                    $userId=$this->request->data['ShiftUser']['user_id'];
                    $start_date=$this->request->data['ShiftUser']['start_date'];
                    $end_date=$this->request->data['ShiftUser']['end_date'];
                        $totalShifts = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status >=' =>1,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
                        $noOfOverTimes = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.latetime >=' =>1,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
                        $lateCheckInTimes= $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.latetime >=' =>1,'ShiftUser.latestatus'=>1,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
                        $lessToFullWorkTimes= $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.check_status'=>2,'ShiftUser.shift_date <='=>$end_date,'Shift.endtime >'=>  date('H:i:s', strToTime('ShiftUser.check_out_time'))]]);

                        $totalNoOfLateCheckIn = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId, 'ShiftUser.latestatus'=>1,'ShiftUser.check_status'=>2,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
                        $totalNoOfShifts = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId, 'ShiftUser.status >='=>1,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
                        $absent = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.status >='=>1, 'ShiftUser.check_status'=>0,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
                        $earlyCheckOut = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.earlytime >'=> 0,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);
                        $lateCheck = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.latetime >'=> 0,'ShiftUser.shift_date >=' =>$start_date,'ShiftUser.shift_date <='=>$end_date]]);

         
                }


                        $number['totalNoOfLateCheckIn']=$totalNoOfLateCheckIn;
                        $number['totalShifts']=$totalNoOfShifts;
                        $number['absent']=$absent;
                        $number['present']= $totalNoOfShifts- $absent;
                        $number['earlyCheckOut']= $earlyCheckOut;
                        $number['lateCheck']= $lateCheck;



                    $totalWorkinHour =0;

                       foreach ($totalShifts as $shiftUser) {

                            $time = strToTime($shiftUser['ShiftUser']['check_out_time'])-strToTime($shiftUser['ShiftUser']['check_in_time']);
                         

                            $totalWorkinHour = $totalWorkinHour + $time;
                        }
                        /*debug($totalWorkinHour);*/


                     $totalLessToFullWorkTime=0;

                        foreach ($lessToFullWorkTimes as $lessToFullWorkTime) {

                            $lessTime= strToTime($lessToFullWorkTime['ShiftUser']['check_out_time']);

                       
                            $combined_date_and_time =strToTime($lessToFullWorkTime['ShiftUser']['shift_date'].''.$lessToFullWorkTime['Shift']['endtime']);
                            
                           
                            $lessHours = $combined_date_and_time - $lessTime;

                            $totalLessToFullWorkTime = $totalLessToFullWorkTime + $lessHours; 
                       


                        }
            
                $totalLateCheckInTime=0;

                    foreach ($lateCheckInTimes as $lateCheckInTime) {

                        $lateHours =strToTime($lateCheckInTime['ShiftUser']['check_in_time'])-strToTime($lateCheckInTime['Shift']['starttime']);
                        
                        $totalLateCheckInTime =$totalLateCheckInTime + $lateHours;   
                    }

                /*   debug($totalLessToFullWorkTime);*/

                   

                $totalOverTime =0;

                   foreach ($noOfOverTimes as $noOfOverTime) {

                        $lateTime= strToTime($noOfOverTime['ShiftUser']['latetime']);

                        $late = date("H:i:s", $lateTime);

                        $time = strToTime($late)-strToTime($noOfOverTime['Shift']['endtime']);

                        $totalOverTime = $totalOverTime + $time;
                    }

                       // $works =$this->ShiftUser->find('all', $conditions);

                    if(isset($this->request->data['ShiftUser']['organization_id'])){
                    $this->set(
                             array(
                                'output'=>[
                                'totalOverTimeWorking'=>$totalOverTime, 
                                'totalLateCheckInTime'=>$totalLateCheckInTime,
                                'totalLessToFullWorkTime'=>$totalLessToFullWorkTime,
                                'totalWorkinHour'=>$totalWorkinHour,
                                'number'=>$number,
                                'start_date'=>$start_date,
                                'end_date'=>$end_date,
                                'OrgId'=>$orgId
                                ],

                                '_serialize'=>array('output')

                    ));
                        }else{
                            $this->set(
                                 array(
                                    'output'=>[
                                    'totalOverTimeWorking'=>$totalOverTime, 
                                    'totalLateCheckInTime'=>$totalLateCheckInTime,
                                    'totalLessToFullWorkTime'=>$totalLessToFullWorkTime,
                                    'totalWorkinHour'=>$totalWorkinHour,
                                    'number'=>$number,
                                    'start_date'=>$start_date,
                                    'end_date'=>$end_date
                                    ],

                                    '_serialize'=>array('output')

                        ));
                        }             
     
     }

     

     public function orgEmployeeDetails($userId=null,$orgId=null,$start_date=null,$end_date=null){

        if ($start_date==null || $end_date==null) {

                if($orgId==0){
 
                        $totalShiftsOfEmployees = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status'=>2,'ShiftUser.status' =>3]]);    
                        $totalNoOfLateCheckIn = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId, 'ShiftUser.latestatus'=>1]]);
                        $totalNoOfShifts = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId, 'ShiftUser.check_status'=>2,'ShiftUser.status >='=>1]]);
                        $absent = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.status >='=>1, 'ShiftUser.check_status'=>3]]);
                        $earlyCheckOut = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.earlytime >'=> 0]]);
                        $lateCheck = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.latetime >'=> 0]]);
                        }
                  else{
                    
                        $totalShiftsOfEmployees = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.check_status'=>2,'ShiftUser.status' =>3]]);
                        $totalNoOfLateCheckIn = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId, 'ShiftUser.latestatus'=>1]]);
                        $totalNoOfShifts = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId, 'ShiftUser.status >='=>1,'ShiftUser.check_status'=>2]]);
                        $absent = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.status >='=>1, 'ShiftUser.check_status'=>3]]);
                        $earlyCheckOut = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.earlytime >'=> 0]]);
                        $lateCheck = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.latetime >'=> 0]]);
                }
        
        } else{

            if($orgId==0){
                

                    $totalShiftsOfEmployees = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status'=>2,'ShiftUser.status' =>3,'ShiftUser.shift_date >='=>$start_date, 'ShiftUser.shift_date <=' =>$end_date]]);
                    $totalNoOfShifts = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId, 'ShiftUser.check_status'=>2,'ShiftUser.shift_date >='=>$start_date, 'ShiftUser.shift_date <=' =>$end_date]]);
                    $totalNoOfLateCheckIn = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId, 'ShiftUser.latestatus'=>1,'ShiftUser.shift_date >='=>$start_date, 'ShiftUser.shift_date <=' =>$end_date]]);
                    $absent = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.status >='=>1, 'ShiftUser.check_status'=>3,'ShiftUser.shift_date >='=>$start_date, 'ShiftUser.shift_date <=' =>$end_date]]);
                    $earlyCheckOut = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.earlytime >'=> 0,'ShiftUser.shift_date >='=>$start_date, 'ShiftUser.shift_date <=' =>$end_date]]);
                    $lateCheck = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.latetime >'=> 0,'ShiftUser.shift_date >='=>$start_date, 'ShiftUser.shift_date <=' =>$end_date]]);
                }
                  else{
                     
                    $totalShiftsOfEmployees = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.check_status'=>2,'ShiftUser.status' =>3,'ShiftUser.shift_date >='=>$start_date, 'ShiftUser.shift_date <=' =>$end_date]]);
                    $totalNoOfLateCheckIn = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId, 'ShiftUser.latestatus'=>1,'ShiftUser.shift_date >='=>$start_date, 'ShiftUser.shift_date <=' =>$end_date]]);
                    $totalNoOfShifts = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId, 'ShiftUser.status >='=>1,'ShiftUser.check_status'=>2,'ShiftUser.shift_date >='=>$start_date, 'ShiftUser.shift_date <=' =>$end_date]]);
                    $absent = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.status >='=>1, 'ShiftUser.check_status'=>3,'ShiftUser.shift_date >='=>$start_date, 'ShiftUser.shift_date <=' =>$end_date]]);
                    $earlyCheckOut = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.earlytime >'=> 0,'ShiftUser.shift_date >='=>$start_date, 'ShiftUser.shift_date <=' =>$end_date]]);
                    $lateCheck = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.organization_id'=>$orgId,'ShiftUser.latetime >'=> 0,'ShiftUser.shift_date >='=>$start_date, 'ShiftUser.shift_date <=' =>$end_date]]);
                }


        }

                $totalWorkinHour =0;

               foreach ($totalShiftsOfEmployees as $shiftUser) {

                    $time = strToTime($shiftUser['ShiftUser']['check_out_time'])-strToTime($shiftUser['ShiftUser']['check_in_time']);
                 

                   $totalWorkinHour = $totalWorkinHour + $time;
                }
                //debug($totalWorkinHour);


                $number['totalWorkingHours'] = $this->secondsToHIS($totalWorkinHour);
                $number['totalNoOfLateCheckIn']=$totalNoOfLateCheckIn;
                $number['totalShifts']=$totalNoOfShifts;
                $number['absent']=$absent;
                $number['present']= $totalNoOfShifts- $absent;
                $number['earlyCheckOut']= $earlyCheckOut;
                $number['lateCheck']= $lateCheck;
                
               


                $this->set(array(
                        'number'=>$number,
                        '_serialize'=>array('number')
                    ));
              
                return $number;


     }




     /**************************************************************************************/

    public function getOrganizationCount($orgId=null) {
    
            if($orgId==null){
                $totalNoOfLateCheckIn = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.latestatus'=>1]]);
                $totalNoOfShifts = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.status >='=>1]]);
                $absent = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.status >='=>1, 'ShiftUser.check_status'=>0]]);
                $earlyCheckOut = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.earlytime >'=> 0]]);
                $lateCheck = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.latetime >'=> 0]]);
            }else{
                $totalNoOfLateCheckIn = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.organization_id'=>$orgId, 'ShiftUser.latestatus'=>1]]);
                $totalNoOfShifts = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.organization_id'=>$orgId, 'ShiftUser.status >='=>1]]);
                $absent = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.status >='=>1, 'ShiftUser.check_status'=>0]]);
                $earlyCheckOut = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.earlytime >'=> 0]]);
                $lateCheck = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.latetime >'=> 0]]);
            }
            
          

            $number['totalNoOfLateCheckIn']=$totalNoOfLateCheckIn;
            $number['totalShifts']=$totalNoOfShifts;
            $number['absent']=$absent;
            $number['present']= $totalNoOfShifts- $absent;
            $number['earlyCheckOut']= $earlyCheckOut;
            $number['lateCheck']= $lateCheck;
            
        


                    $this->set(array(
                            'number'=>$number,
                            '_serialize'=>array('number')
                        ));
          
    }

    public function getOrganizationTotal($orgId=null, $startDate = null, $endDate = null){
        
        if($orgId==null){
            $totalShifts = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.check_status >=' =>1]]);
        }
        elseif($orgId != null)
        {
            $totalShifts = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.check_status >=' =>1]]);
        }
        elseif($orgId !=null && $startDate !=null && $endDate != null)
        {

           $totalShifts = $this->ShiftUser->find('all', 
            ['conditions'=>
                [
                'ShiftUser.organization_id'=>$orgId,
                'ShiftUser.check_status >=' =>1,
                'ShiftUser.shift_date >='=>$startDate,
                'ShiftUser.shift_date <='=>$endDate
                ]
            ]);
        }

        $totalWorkinHour =0;

           foreach ($totalShifts as $shiftUser) {

                $time = strToTime($shiftUser['ShiftUser']['check_out_time'])-strToTime($shiftUser['ShiftUser']['check_in_time']);
             

                $totalWorkinHour = $totalWorkinHour + $time;

                
            }
            /*debug($totalWorkinHour);*/
         $this->set(
            array(
                'output'=>$totalWorkinHour,
                '_serialize'=>array('output')
                ));


     return $totalWorkinHour;
        }


    public function getOrganizationOverTime($orgId=null){

                                                
            if($orgId==null){
                $noOfOverTimes = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.latetime >=' =>1]]);
                $lateCheckInTimes= $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.latetime >=' =>1,'ShiftUser.latestatus'=>1]]);
                $lessToFullWorkTimes= $this->ShiftUser->find('all',[
                    'conditions'=>['Shift.endtime >'=>  date('H:i:s', strToTime('ShiftUser.check_out_time'))]]);
                /*debug($lessToFullWorkTimes);*/
     
           }
           else{
                $noOfOverTimes = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.latetime >=' =>1]]);
                $lateCheckInTimes = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.latetime >=' =>1,'ShiftUser.latestatus'=>1]]);
                $lessToFullWorkTimes= $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.organization_id'=>$orgId,'Shift.endtime >'=> date('H:i:s', strToTime('ShiftUser.check_out_time'))]]); 
            }

            $totalLessToFullWorkTime=0;

                foreach ($lessToFullWorkTimes as $lessToFullWorkTime) {

                    $lessTime= strToTime($lessToFullWorkTime['ShiftUser']['check_out_time']);

               
                    $combined_date_and_time =strToTime($lessToFullWorkTime['ShiftUser']['shift_date'].''.$lessToFullWorkTime['Shift']['endtime']);
                    
                   
                    $lessHours = $combined_date_and_time - $lessTime;

                    $totalLessToFullWorkTime = $totalLessToFullWorkTime + $lessHours; 
               
    

                }
                /*debug($totalLessToFullWorkTime);*/
    
                $totalLateCheckInTime=0;

                    foreach ($lateCheckInTimes as $lateCheckInTime) {

                        $lateHours =strToTime($lateCheckInTime['ShiftUser']['check_in_time'])-strToTime($lateCheckInTime['Shift']['starttime']);
                        
                        $totalLateCheckInTime =$totalLateCheckInTime + $lateHours;   
                    }
          
                /*   debug($totalLessToFullWorkTime);*/

                   

                $totalOverTime =0;

                   foreach ($noOfOverTimes as $noOfOverTime) {

                        $lateTime= strToTime($noOfOverTime['ShiftUser']['latetime']);

                        $late = date("H:i:s", $lateTime);

                        $time = strToTime($late)-strToTime($noOfOverTime['Shift']['endtime']);

                        $totalOverTime = $totalOverTime + $time;
                    }


                 $this->set(
                 array(
                    'output'=>[
                    'totalOverTimeWorking'=>$totalOverTime, 
                    'totalLateCheckInTime'=>$totalLateCheckInTime,
                    'totalLessToFullWorkTime'=>$totalLessToFullWorkTime
                    ],

                    '_serialize'=>array('output')

                    )); 
     

      }

    public function getOrganizationUsersWorkHistory($orgId=null,$boardId=null){ //for individual usersin Organization

                 
                 if($boardId != null)
                 {
                    $options = array('conditions'=>['ShiftUser.board_id'=>$boardId], 'group'=>'ShiftUser.user_id');
                 }

                 else
                 {
                    $options = array('conditions'=>['ShiftUser.organization_id'=>$orgId], 'group'=>'ShiftUser.user_id');
                 }

                 $users = $this->ShiftUser->find('all', $options);
                 // debug($users);

                    $i=0;

                if(isset($users) && !empty($users))
                {

                    foreach ($users as $user) {
                        // bickyrajkayastha
                        $id=$user['User']['id'];
                        $workDetail[$i]['UserDetail']=$user['User'];
                        $workDetail[$i]['workDetail']= $this->getCount($id, $orgId);
                        $workDetail[$i]['totalWorkinHour']= $this->getTotal($id, $orgId);
                        $workDetail[$i]['workDetailInHour']= $this->getOverTime($id, $orgId);
                        $workDetail[$i]['boardId']=$boardId;
                        $i++;
                    }
                    
                    // debug($workDetail);

                    $this->set(
                            array(
                                'output'=>$workDetail,
                                '_serialize'=>array('output')
                                ));
                }


      }

    public function organizationShiftCalculation($orgId=null, $startDate=null, $endDate=null){         //countig the no of shift in the Organization
       

                if(isset($startDate) && $startDate != null && isset($endDate) && $endDate != null )
                {
                    $noOfShifts = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.status ' =>3, 'ShiftUser.shift_date >='=>$startDate, 'ShiftUser.shift_date <=' =>$endDate]]);
                    $noOfAbsentShifts = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.check_status' =>0,'ShiftUser.status ' =>3, 'ShiftUser.shift_date >='=>$startDate, 'ShiftUser.shift_date <=' =>$endDate]]);
                }
                else
                {

                    $noOfShifts = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.status ' =>3]]);
                    $noOfAbsentShifts = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.check_status' =>0,'ShiftUser.status ' =>3]]);
                }

                $noOfPresentShifts = $noOfShifts - $noOfAbsentShifts;
                
                /*debug($noOfPresentShifts);*/

                if(isset($noOfShifts) && $noOfShifts == null || isset($noOfAbsentShifts) && $noOfAbsentShifts=null){


                $shiftnumber['noOfShifts']=0;
                $shiftnumber['noOfAbsentShifts']=0;
                $shiftnumber['noOfPresentShifts']=0;
                $shiftnumber['absentPercent']= 0;
                $shiftnumber['presentPercent']= 0;

                }else{


                $shiftnumber['noOfShifts']=$noOfShifts;
                $shiftnumber['noOfAbsentShifts']=$noOfAbsentShifts;
                $shiftnumber['noOfPresentShifts']=$noOfPresentShifts;
                $shiftnumber['absentPercent']= ($noOfAbsentShifts/$noOfShifts)*100;
                $shiftnumber['presentPercent']= ($noOfPresentShifts/$noOfShifts)*100;

                }

                

                // debug($shiftnumber);
               
                $this->set(array(
                'number'=>$shiftnumber,
                '_serialize'=>array('number')
            ));
                return $shiftnumber;

      }


    public function organizationBoardShiftCalculation($boardId=null){         //counting the no of shift in the Organization
       
                $noOfShifts = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.board_id'=>$boardId,'ShiftUser.status ' =>3]]);
                $noOfAbsentShifts = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.board_id'=>$boardId,'ShiftUser.check_status' =>0,'ShiftUser.status ' =>3]]);

                $noOfPresentShifts = $noOfShifts - $noOfAbsentShifts;

                if(isset($noOfShifts) && $noOfShifts == null || isset($noOfAbsentShifts) && $noOfAbsentShifts = null)
                {


                $shiftboardnumber['noOfShifts']=0;
                $shiftboardnumber['noOfAbsentShifts']=0;
                $shiftboardnumber['noOfPresentShifts']=0;

                $shiftboardnumber['absentPercent']= 0;
                $shiftboardnumber['presentPercent']=0;

                }
                else{

                $shiftboardnumber['noOfShifts']=$noOfShifts;
                $shiftboardnumber['noOfAbsentShifts']=$noOfAbsentShifts;
                $shiftboardnumber['noOfPresentShifts']=$noOfPresentShifts;

                $shiftboardnumber['absentPercent']= ($noOfAbsentShifts/$noOfShifts)*100;
                $shiftboardnumber['presentPercent']= ($noOfPresentShifts/$noOfShifts)*100;
               }

               //debug($shiftboardnumber);

                $this->set(array(
                'number'=>$shiftboardnumber,
                '_serialize'=>array('number')
            ));
                return $shiftboardnumber;
      }

    public function getBoardOrganizationTotal($boardId=null){
        
       
        $totalShifts = $this->ShiftUser->find('all', ['conditions'=>['ShiftUser.board_id >=' =>$boardId,'ShiftUser.check_status >=' =>1 , 'ShiftUser.status >=' =>3]]);
           
                //debug($totalShifts);

                 $totalBoardWorkingHour =0;

               foreach ($totalShifts as $shiftUser) {

                    $time = strToTime($shiftUser['ShiftUser']['check_out_time'])-strToTime($shiftUser['ShiftUser']['check_in_time']);

                    $totalBoardWorkingHour = $totalBoardWorkingHour + $time;
                }
               // debug($totalBoardWorkingHour);
             
             $this->set(
                array(
                    'output'=>$totalBoardWorkingHour,
                    '_serialize'=>array('output')
                    ));
          }


    public function getByDateBoard()
    {

            $startDate = $this->request->data['ShiftUser']['start_date'];
            $endDate = $this->request->data['ShiftUser']['end_date'];
            $boardId = $this->request->data['ShiftUser']['board_id'];
            $organization_id = $this->request->data['ShiftUser']['organization_id'];

            $orgPercenHistory = $this->organizationShiftCalculation($organization_id, $startDate, $endDate);
            $getOrganizationTotal = $this->getOrganizationTotal($organization_id, $startDate, $endDate);

            
            if($boardId != '0')
            {

                $options = array(
                'conditions'=>['ShiftUser.board_id'=>$boardId, 'ShiftUser.shift_date >='=>$startDate, 'ShiftUser.shift_date <='=>$endDate],
                'group'=>'ShiftUser.user_id');
            }
            else
            {
                
                $options = array(
                'conditions'=>['ShiftUser.organization_id'=>$organization_id, 'ShiftUser.shift_date >='=>$startDate, 'ShiftUser.shift_date <='=>$endDate],
                'group'=>'ShiftUser.user_id');
            }

            $users = $this->ShiftUser->find('all', $options);

            if(!empty($users))
            {

                $i=0;

                if($boardId != '0')
                {
                    foreach ($users as $user) {

                        $id=$user['User']['id'];
                        $workDetail[$i]['UserDetail']=$user['User'];
                        $workDetail[$i]['workDetail']= $this->getCount($id, $orgId=null, $boardId);
                        $workDetail[$i]['totalWorkinHour']= $this->getTotal($id, $orgId=null, $boardId);
                        $workDetail[$i]['workDetailInHour']= $this->getOverTime($id, $orgId=null, $boardId);
                        $workDetail[$i]['workPercentDetail']= $this->organizationBoardShiftCalculation($boardId);
                        $workDetail[$i]['boardId']=$boardId;
                        $i++;
                    }

                    $this->set(
                            array(
                                'status'=>'1',
                                'boardId'=>$boardId,
                                'output'=>$workDetail,
                                '_serialize'=>array('output', 'boardId', 'status')
                                ));
                }
                else
                {
                    foreach ($users as $user) {

                        $id=$user['User']['id'];
                        $workDetail[$i]['UserDetail']=$user['User'];
                        $workDetail[$i]['workDetail']= $this->getCount($id, $orgId=$organization_id, $boardId = null);
                        $workDetail[$i]['totalWorkinHour']= $this->getTotal($id, $orgId=$organization_id, $boardId = null);
                        $workDetail[$i]['workDetailInHour']= $this->getOverTime($id, $orgId=$organization_id, $boardId = null);
                        $workDetail[$i]['workPercentDetail']= $this->organizationShiftCalculation($organization_id);
                        $workDetail[$i]['organization_id']=$organization_id;
                        $i++;
                    }

                    $this->set(
                            array(
                                'status'=>'1',
                                'organization_id'=>$organization_id,
                                'orgPercenHistory'=>$orgPercenHistory,
                                'output'=>$workDetail,
                                'getOrganizationTotal'=>$getOrganizationTotal,
                                '_serialize'=>array('output', 'organization_id','orgPercenHistory', 'getOrganizationTotal','status')
                                ));
                }

                    
            }

                    else
                    {
                        $this->set(
                                    array(
                                        'status'=>'0',
                                        '_serialize'=>array('status')
                                        ));
                    }
                
    }



// Bicky Raj Kayastha---------------------------------------------------------------------------------------------

        public function getBoardRelatedShiftsOnDate($userId, $orgId, $boardId, $shiftDate)
        {
            $options = array(


                    'conditions'=>['ShiftUser.user_id !='=>$userId, 'ShiftUser.board_id'=>$boardId, 'ShiftUser.shift_date'=>$shiftDate, 'ShiftUser.status'=>'3', 'ShiftUser.check_status'=>'0']
                );

            $swapShiftList = $this->ShiftUser->find('all', $options);
            // debug($swapShiftList);die();

            if (!empty($swapShiftList)) {
                        $status = 1;
                    } else {
                        $status = 0;    
                    }
                    $output = array(
                        "params" => $this->request,
                        "method" => $this->method,
                        "action" => "getBoardRelatedShiftsOnDate",
                        "status" => $status,
                        "error" => array("validation" => "")
                    );

                    $this->set('output', $output);
                    $this->set('swapShiftList', $swapShiftList);

                    $this->set(
                            array(
                                "_serialize" => array('swapShiftList', 'output'),
                                "_jsonp"=>true
                            )
                    );
        }

        public function hisToTime($hisTime)
        {
            $startTime = new DateTime($hisTime);
            return $startTime->format('g:i A');
        }

        public function getShiftPdf($userId = null, $timeslot = null)
        {
            $this->theme = 'Default';

            $conditions = array(
                                'ShiftUser.user_id'=>$userId
                                );
            if($this->ShiftUser->hasAny($conditions))
            {
                $user = $this->ShiftUser->find('first', array('conditions'=>['ShiftUser.user_id'=>$userId]));
                $userName = $user['User']['fname']." ".$user['User']['lname'];


                $currentdate = date('Y-m-d');
                $year = date('Y', strtotime($currentdate));
                $month = date('m', strtotime($currentdate));

                // debug($month);die();

                $n = $timeslot;

                    for($i=0;$i<$n;$i++)
                    {
                        if($month <=12)
                        {
                            $month = $month + $i;
                        }else
                        {
                            $month = 1;
                            $year = $year +1;
                        }

                        $date = new DateTime();
                        $date->setDate($year, $month, 1);
                        $startDate = $date->format('Y-m-d');

                        $date = new DateTime();
                        $date->setDate($year, $month, 31);
                        $endDate = $date->format('Y-m-d');

                        $options = array(
                            'conditions'=>['ShiftUser.user_id'=>$userId, 'ShiftUser.shift_date >='=>$startDate, 'ShiftUser.shift_date <='=>$endDate],
                            'order'=>'ShiftUser.shift_date');
                        $shifts[$i]['Date']=$year."-".str_pad($month,2,"0",STR_PAD_LEFT);
                        $shifts[$i]['ShiftUser'] = $this->ShiftUser->find('all', $options);
                    }

                    // debug($shifts);die();
                    $userOrganizations = $this->ShiftUser->find('all', array(
                        'conditions'=>['ShiftUser.user_id'=>$userId],
                        'group'=>'ShiftUser.organization_id'
                        ));

                    $orgArray = array();

                    $color = '000000';
                    foreach($userOrganizations as $userOrganization)
                    {
                        $color = str_pad(dechex($color + 600),6,'0');
                        $orgArray[$userOrganization['ShiftUser']['organization_id']]['name']=$userOrganization['Organization']['title'];
                        $orgArray[$userOrganization['ShiftUser']['organization_id']]['color'] = '#'.$color;
                    }

                if(isset($shifts) && !empty($shifts))
                {
                    
                    $shiftDetails = array();
                    $i=0;
                    foreach ($shifts as $shiftmonths) {
                        $j=0;

                        $shiftDetails[$i]['date']=$shiftmonths['Date'];
                        foreach ($shiftmonths['ShiftUser'] as $shiftmonth){

                            $shiftDetails[$i]['shiftDetail'][$j]['Organization']= $shiftmonth['Organization']['title'];
                            $shiftDetails[$i]['shiftDetail'][$j]['Board']= $shiftmonth['Board']['title'];
                            $shiftDetails[$i]['shiftDetail'][$j]['Shift']= $shiftmonth['Shift']['title'];
                            $shiftDetails[$i]['shiftDetail'][$j]['From']= $this->hisToTime($shiftmonth['Shift']['starttime']);
                            $shiftDetails[$i]['shiftDetail'][$j]['To']= $this->hisToTime($shiftmonth['Shift']['endtime']);
                            $shiftDetails[$i]['shiftDetail'][$j]['Date']= $shiftmonth['ShiftUser']['shift_date'];
                            $shiftDetails[$i]['shiftDetail'][$j]['Color']=$orgArray[$shiftmonth['Organization']['id']]['color'];

                            $j++;
                        }
                        $i++;
                    }

                    // die();
                    // debug($shiftDetails);die();

                    
                    $output = 1;
                    $this->set(array(
                        'orgArray'=>$orgArray,
                        'name'=>$userName,
                        'shiftDetails'=>$shiftDetails,
                        'output'=>$output));

                    $this->pdfConfig = array(
                        'orientation' => 'portrait',
                        'filename' => 'shifts_'.$userId.'.pdf'
                    );

                }
                else
                {

                    $output = 0;
                    $this->set(array(
                    'output'=>$output
                    ));
                }
            }
            else
            {
                $output = 0;
                $this->set(array(
                    'output'=>$output
                    ));
            }


        }

// end of Bicky's function----------------------------------------------------------------------------------------


        public function deleteShiftUser($shiftplanId=null){
            if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
            
            $this->ShiftUser->deleteAll(array('ShiftUser.shiftplan_id'=> $shiftplanId));

            }
        }

        // public function getShiftUserByDate($shiftUserId=null,$grp_date=null){

        //     $shiftUsers = $this->ShiftUser->getShiftUserByDate($shiftUserId);
        //     $this->set(array(
        //         'shiftUsers'=>$shiftUsers,
        //         '_serialize'=>'shiftUsers'
        //         ));
        // }
       public function shiftUserList($shiftId = null,$boardId = null)
       {
            $this->ShiftUser->Behaviors->load('Containable');
            if ($shiftId == '0') {
                $output = $this->ShiftUser->find('all',array(
                    'conditions' => array(
                            'ShiftUser.board_id' => $boardId,
                            'ShiftUser.status' => '3'
                        ),
                    'contain' => ['User']
                )
                );

               // debug($output);
            }
            else{
            $output = $this->ShiftUser->find('all',array(
                    'conditions' => array(
                            'ShiftUser.board_id' => $boardId,
                            'ShiftUser.shift_id' => $shiftId,
                            'ShiftUser.status' => '3'
                        ),
                    'contain' => ['User']
                )
                );
        }
           // debug($output);
             $this->set('output', $output);
                    
            $this->set(
                    array(
                        "_serialize" => array('output'),
                        "_jsonp"=>true
                    )
            );
       }

       
        //manohar

        public function checkUserIfAvailable($shiftId=null,$boardId=null,$shift_date=null,$userId=null,$orgId=null){
            
            $status = $this->ShiftUser->checkUserIfAvailable($shiftId,$boardId,$shift_date,$userId,$orgId);
            
            $this->set(array(
                'status'=>$status,
                '_serialize'=>array('status'),
                '_jsonp'=>true
            ));
        }

          public function updateUserFromCalender($shiftId=null,$boardId=null,$shift_date=null,$userId=null,$shiftUserId=null){
            
            $status = $this->ShiftUser->updateUserFromCalender($shiftId,$boardId,$shift_date,$userId,$shiftUserId);
            
            $this->set(array(
                'status'=>$status,
                '_serialize'=>array('status'),
                '_jsonp'=>true
            ));
        }

        public function showShiftUserOfBoard($orgId = null,$boardId = null){
            $shiftUser = $this->ShiftUser->showShiftUserOfBoard($orgId,$boardId);
            $this->set(array(
                    'shiftUser' => $shiftUser,
                    '_serialize' => array('shiftUser'),
                    '_jsonp'=>true
                ));

         }   
         
        public function UserResponseFromCalender(){
            $id=$_POST['shiftId'];
            $data['ShiftUser']['user_id']=$_POST['userId'];
            $data['ShiftUser']['status']=$_POST['type'];
            $result=$this->ShiftUser->UserResponseFromCalender($id,$data);
            $this->set(array(
                'result'=>$result,
                '_serialize'=>array('result'),
                '_jsonp'=>true
            ));
        }
        public function shiftRelatedEmploy($orgId = null)
        {

            $todayDate = date('Y-m-d');
            $todayTime = strtotime(date('H:i'));
            $timee = date('H:i');
          //  debug($timee);
           

            $time = strtotime('10:00');
            $earlyTime = date("H:i", strtotime('-30 minutes', $todayTime));
            $endTime = date("H:i", strtotime('+30 minutes', $todayTime));
          //  debug($todayTime);
          //  debug($earlyTime);
          //  debug($endTime);

            $test = $this->ShiftUser->find('all');
            // debug($test);


        }

          // *******************************Ashok Senpai*************************************

        public function secondsToHIS($seconds = null)
        {

            $getHours = floor($seconds / 3600);
            $getMins = floor(($seconds - ($getHours*3600)) / 60);
            $getSecs = floor($seconds % 60);
            return $getHours.':'.$getMins.':'.$getSecs;

        }

        public function HisToseconds($his = null)
       {
           $time = explode(':', $his);

           $getHours = floor($time['0'] * 3600);
           $getMins = floor($time['1'] * 60);
           $getSecs = floor($time['2']);
           return ($getHours+$getMins+$getSecs);

       }

         public function paymentFactorsByShiftId($userId = null,$start_date=null,$end_date=null){


            $this->ShiftUser->Behaviors->load('Containable');

            // wage of user in the organization

            // $this->loadModel('OrganizationUser');

            // $wage = $this->OrganizationUser->findField('wage', array('conditions'=>['']));

            if($start_date==null || $end_date==null){

            $options = array(
                'conditions'=>['ShiftUser.user_id'=>$userId, 'ShiftUser.check_status'=>2],
                'contain'=>false, 
                'group'=>'ShiftUser.shift_id'

                );

          } else{

            $options = array(
                'conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status'=>2,'ShiftUser.shift_date >='=>$start_date,'ShiftUser.shift_date <='=>$end_date],
                'contain'=>false, 
                'group'=>'ShiftUser.shift_id'

                );
          }
            $userShifts = $this->ShiftUser->find('all',$options);

            // debug($userShifts);die();

            $dataDate = array();
            foreach ($userShifts as $key => $value) {
                if($start_date==null || $end_date==null){

                $options = array(
                'conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status'=>2, 'ShiftUser.shift_id'=>$value['ShiftUser']['shift_id']],
                'contain'=>false,
                'group'=>'ShiftUser.shift_date',
                'fields'=>['ShiftUser.shift_date']

                );
            }else{


                 $options = array(
                'conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.check_status'=>2, 'ShiftUser.shift_date >='=>$start_date,'ShiftUser.shift_date <='=>$end_date,'ShiftUser.shift_id'=>$value['ShiftUser']['shift_id']],
                'contain'=>false,
                'group'=>'ShiftUser.shift_date',
                'fields'=>['ShiftUser.shift_date']

                );


            }

                $userData = $this->ShiftUser->find('all', $options);
                // debug($userData);die();
                $dataDate[$value['ShiftUser']['shift_id']] = $userData;
            }

            // debug($dataDate);die();
            $data = array();
            foreach ($dataDate as $key => $value){


                foreach ($value as $shiftuser => $date) {

                $options = array(
                'conditions'=>['ShiftUser.user_id'=>$userId,'ShiftUser.shift_date'=>$date['ShiftUser']['shift_date']],
                'contain'=>['Shift']

                );
            
                    $s = $this->ShiftUser->find('all', $options);

                    $data[$key][$date['ShiftUser']['shift_date']] = $s;
                }
            }

            $this->loadModel('MultiplyPaymentFactor');

            // $this->MultiplyPaymentFactor->recursive = -1;  
            // debug($data);die();

            $v = $this->MultiplyPaymentFactor->find('all');
            // debug($v);die();


            
               $v = array();
               $TotalPayment=0;

               foreach ($data as $key => $value) {

                    foreach ($value as $index => $shiftUsers) {

                        foreach ($shiftUsers as $shiftUser) {

                            $options = array(
                                             'conditions'=>['MultiplyPaymentFactor.shift_id'=>$key,'MultiplyPaymentFactor.implement_date <='=>$index, 'MultiplyPaymentFactor.end_date >=' =>$index]

                                                );
                            $paymentFactor = $this->MultiplyPaymentFactor->find('all', $options);

                            // $v[$key][$index]['paymentfactorType'] = $paymentFactor['Multiplypaymentfactortype']['title'];
                            // debug($paymentFactor);

                            // debug($shiftUser);die();

                            if(strtotime($shiftUser['ShiftUser']['check_out_time']) == 0)
                            {
                                $shiftUser['ShiftUser']['check_out_time'] = $shiftUser['Shift']['endtime'];
                            }
                            $seconds = strtotime($shiftUser['ShiftUser']['check_out_time'])-strtotime($shiftUser['ShiftUser']['check_in_time']);

                            $v[$key][$index]['paymentfactor'] = 'shift';
                            $v[$key][$index]['totalWorkinHour'] = $this->secondsToHIS($seconds);
                            // debug($v);die();
                           
                           $this->loadModel('OrganizationUser');
                        //****************************************
                         if(isset($paymentFactor)&& !empty($paymentFactor))
                         {
                            $j = 0;

                             // $paymentFactor = max( $paymentfactor['MultiplyPaymentFactor']['multiply_factor']);
                             foreach ($paymentFactor as $paymentfactor) {

                                $v[$key][$index]['MultiplyPaymentFactor'][$j]['id'] = $paymentfactor['MultiplyPaymentFactor']['multiplypaymentfactortype_id'];
                                $v[$key][$index]['MultiplyPaymentFactor'][$j]['organization_id']= $paymentfactor['MultiplyPaymentFactor']['organization_id'];

                                $v[$key][$index]['MultiplyPaymentFactor'][$j]['branch_id']= $paymentfactor['MultiplyPaymentFactor']['branch_id'];

                                $branch_id = $paymentfactor['MultiplyPaymentFactor']['branch_id'];
                                $orgId = $paymentfactor['MultiplyPaymentFactor']['organization_id'];
                                $wage = $this->OrganizationUser->field('wage', array('OrganizationUser.organization_id'=>$orgId,'OrganizationUser.user_id'=>$userId, 'OrganizationUser.branch_id'=>$branch_id));
                                $v[$key][$index]['MultiplyPaymentFactor'][$j]['wage']= $wage;

                                $v[$key][$index]['MultiplyPaymentFactor'][$j]['type'] = $paymentfactor['Multiplypaymentfactortype']['title'];

                             $v[$key][$index]['MultiplyPaymentFactor'][$j]['paymentFactor'] = $paymentfactor['MultiplyPaymentFactor']['multiply_factor'];
                              $v[$key][$index]['MultiplyPaymentFactor'][$j]['ImplementOn'] = $paymentfactor['MultiplyPaymentFactor']['implement_date'];
                              $v[$key][$index]['MultiplyPaymentFactor'][$j]['EndOn'] = $paymentfactor['MultiplyPaymentFactor']['end_date'];

                             $j++;

                            }
                            // debug($v);die();

                            $payarr = array();
                            foreach ( $v[$key][$index]['MultiplyPaymentFactor'] as $p) {
                                $payarr[] = $p['paymentFactor'] * $p['wage'];
                                
                            }
                            // debug($payarr);die();
                            // debug(date('H:i:s', $seconds));
                            // debug($seconds);die();
                             $v[$key][$index]['TotalPayment']= round($seconds/3600 * max($payarr), 2);
                         }
                         else
                         {
                            $v[$key][$index]['MultiplyPaymentFactor']['0']['id'] =0;
                            $v[$key][$index]['MultiplyPaymentFactor']['0']['type'] = 'normal';
                            $v[$key][$index]['MultiplyPaymentFactor']['0']['paymentFactor'] = 1;

                            $v[$key][$index]['TotalPayment']=  round($seconds/3600, 3);
                         }

                 
                        }

                    }
               }

               // debug($this->HisToseconds('01:00:00'));
               $arr = array();
                   foreach ($v as $keys) {
                     //debug($keys);
                        $a =0;
                        $b =0;


                        foreach ($keys as $key) {

                            // debug($key['totalWorkinHour']);

                            $paytype = reset($key['MultiplyPaymentFactor']);
                            if(isset($paytype) && !empty($paytype))
                            {
                                $a = $this->HisToseconds($key['totalWorkinHour']) + $a;
                                $arr[$paytype['type']]['workingHour'] = $this->secondsToHIS($a);
                                $b = $key['TotalPayment']+$b;
                                $arr[$paytype['type']]['payment'] = $b;    
                            }
                            else
                            {

                                $a = $this->HisToseconds($key['totalWorkinHour']) + $a;
                                $arr['normal']['workingHour'] = $this->secondsToHIS($a);
                                $b = $key['TotalPayment']+$b;
                                $arr['normal']['payment'] = $b;


                            }
                        }
                   }


                $totalPayment = 0;
                $totalHours = 0;
                $grandTotalPayment = 0;
                $grandTotalHours = 0;
                $afterTaxDeduction = 0;
                $taxableAmount =0;

                if (isset($arr) && !empty($arr)) {
                    
                foreach ($arr as $key => $value) {

                 if (isset($arr['normal']['payment']) && !empty($arr['normal']['payment'])){

                $arr['totalNormalPayment'] = $totalPayment +$arr['normal']['payment'] ;
                $arr['totalNormaHours'] = $totalHours + $arr['normal']['workingHour']; 
                    
                 }


                    $grandTotalPayment = $grandTotalPayment + $value['payment'];
                    $grandTotalHours =$grandTotalHours + $this->HisToseconds($value['workingHour']);
                  }

                  $arr['grandTotalPayment']=$grandTotalPayment;
                  $arr['grandTotalHours']=$this->secondsToHIS($grandTotalHours);
                  $arr['afterTaxDeduction' ]= round($grandTotalPayment - (($grandTotalPayment)*(13/100)), 2);
                  $arr['taxableAmount'] = round((($grandTotalPayment)*(13/100)), 2);
                   
                    $this->set(array(
                                    'output'=>1,
                                    'arr'=>$arr,                       
                                    '_serialize'=>array('arr','output'),
                                    '_jsonp'=>true
                        ));

                   }

                   else{
                     $this->set(array(
                                    'output'=>0,                       
                                    '_serialize'=>array('output'),
                                    '_jsonp'=>true
                        ));
                   }
                  //debug($arr);
            }



        public function getTotalAttendace($userId=null,$start_date=null,$end_date=null){

            $this->loadModel('MultiplyPaymentFactor');

            $totalTitle = $this->MultiplyPaymentFactor->find('count',['conditions'=>['MultiplyPaymentFactor.status'=>1]]);
            //debug($totalTitle);

           if($start_date==null || $end_date==null){

            $totalShifts = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id' =>$userId,'ShiftUser.check_status' =>2 , 'ShiftUser.status'=>3]]

                );
            
            }else{

             $totalShifts = $this->ShiftUser->find('count', ['conditions'=>['ShiftUser.user_id' =>$userId,'ShiftUser.shift_date >='=>$start_date,'ShiftUser.shift_date <='=>$end_date,'ShiftUser.check_status' =>2 , 'ShiftUser.status' =>3]]

                );
             }
             
            // debug($totalShifts);
              
          $this->set(array(
                'output'=>1,
                'totalTitle'=>$totalTitle,
                'totalShifts'=>$totalShifts,
                '_serialize'=>array('output', 'totalShifts','totalTitle')
                ));
         }



        public function organizationPaymentFactors($orgId = null,$userId=null,$start_date=null,$end_date=null){

            $this->ShiftUser->Behaviors->load('Containable');
            
            if($start_date==null || $end_date==null){

                    if($userId==0){

                        $options = array(
                            'conditions'=>['ShiftUser.organization_id'=>$orgId],
                            'contain'=>false, 
                            'group'=>'ShiftUser.shift_id'

                            );
                    }else{
                             $options = array(
                            'conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.user_id'=>$userId],
                            'contain'=>false, 
                            'group'=>'ShiftUser.shift_id'

                            );

                    }


          } else{

                if($userId==0){
                    $options = array(
                        'conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.shift_date >='=>$start_date,'ShiftUser.shift_date <='=>$end_date],
                        'contain'=>false, 
                        'group'=>'ShiftUser.shift_id'


                        );
                }else{

                    $options = array(
                        'conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.user_id'=>$userId,'ShiftUser.shift_date >='=>$start_date,'ShiftUser.shift_date <='=>$end_date],
                        'contain'=>false, 
                        'group'=>'ShiftUser.shift_id'

                        );
                }
          }


            $userShifts = $this->ShiftUser->find('all',$options);
            $dataDate = array();
            foreach ($userShifts as $key => $value) {

                if($start_date==null || $end_date==null){

                    if($userId==0){

                        $options = array(
                        'conditions'=>['ShiftUser.organization_id'=>$orgId, 'ShiftUser.shift_id'=>$value['ShiftUser']['shift_id']],
                        'contain'=>false,
                        'group'=>'ShiftUser.shift_date',
                        'fields'=>['ShiftUser.shift_date']
                         );
                    }else{

                         $options = array(
                        'conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.user_id'=>$userId,'ShiftUser.shift_id'=>$value['ShiftUser']['shift_id']],
                        'contain'=>false,
                        'group'=>'ShiftUser.shift_date',
                        'fields'=>['ShiftUser.shift_date']
                         );

                    }

            }else{
                    if($userId==0){

                         $options = array(
                        'conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.shift_date >='=>$start_date,'ShiftUser.shift_date <='=>$end_date, 'ShiftUser.shift_id'=>$value['ShiftUser']['shift_id']],
                        'contain'=>false,
                        'group'=>'ShiftUser.shift_date',
                        'fields'=>['ShiftUser.shift_date']

                        );
                    }else{

                        $options = array(
                        'conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.user_id'=>$userId,'ShiftUser.shift_date >='=>$start_date,'ShiftUser.shift_date <='=>$end_date, 'ShiftUser.shift_id'=>$value['ShiftUser']['shift_id']],
                        'contain'=>false,
                        'group'=>'ShiftUser.shift_date',
                        'fields'=>['ShiftUser.shift_date']

                         );   
                     }

            }

                $userData = $this->ShiftUser->find('all', $options);
                $dataDate[$value['ShiftUser']['shift_id']] = $userData;
            }

            // debug($dataDate);die();
            $data = array();
            foreach ($dataDate as $key => $value){


                foreach ($value as $shiftuser => $date) {
                  if($start_date==null || $end_date==null){     

                $options = array(
                'conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.shift_date'=>$date['ShiftUser']['shift_date']],
                'contain'=>false

                );
            }else
            {
                $options = array(
                'conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.shift_date >='=>$start_date,'ShiftUser.shift_date <='=>$end_date,'ShiftUser.shift_date'=>$date['ShiftUser']['shift_date']],
                'contain'=>false

                 );
            }
                    $s = $this->ShiftUser->find('all', $options);

                    $data[$key][$date['ShiftUser']['shift_date']] = $s;
                }
            }

            $this->loadModel('MultiplyPaymentFactor');

            // $this->MultiplyPaymentFactor->recursive = -1;  
            //debug($data);die();

            $v = $this->MultiplyPaymentFactor->find('all');
            // debug($v);die();


            
               $v = array();
               $TotalPayment=0;

               foreach ($data as $key => $value) {

                    foreach ($value as $index => $shiftUsers) {

                        foreach ($shiftUsers as $shiftUser) {

                            $options = array(
                                             'conditions'=>['MultiplyPaymentFactor.shift_id'=>$key,'MultiplyPaymentFactor.implement_date <='=>$index, 'MultiplyPaymentFactor.end_date >=' =>$index]

                                                );
                            $paymentFactor = $this->MultiplyPaymentFactor->find('all', $options);

                            // $v[$key][$index]['paymentfactorType'] = $paymentFactor['Multiplypaymentfactortype']['title'];
                            // debug($paymentFactor);

                            $seconds = strtotime($shiftUser['ShiftUser']['check_out_time'])-strtotime($shiftUser['ShiftUser']['check_in_time']);

                            $v[$key][$index]['paymentfactor'] = 'ab';
                            $v[$key][$index]['totalWorkinHour'] = $this->secondsToHIS($seconds);
                           
                        //****************************************
                         if(isset($paymentFactor)&& !empty($paymentFactor))
                         {
                            $j = 0;

                             // $paymentFactor = max( $paymentfactor['MultiplyPaymentFactor']['multiply_factor']);
                             foreach ($paymentFactor as $paymentfactor) {

                                $v[$key][$index]['MultiplyPaymentFactor'][$j]['id'] = $paymentfactor['MultiplyPaymentFactor']['multiplypaymentfactortype_id'];
                                $v[$key][$index]['MultiplyPaymentFactor'][$j]['type'] = $paymentfactor['Multiplypaymentfactortype']['title'];

                             $v[$key][$index]['MultiplyPaymentFactor'][$j]['paymentFactor'] = $paymentfactor['MultiplyPaymentFactor']['multiply_factor'];
                              $v[$key][$index]['MultiplyPaymentFactor'][$j]['ImplementOn'] = $paymentfactor['MultiplyPaymentFactor']['implement_date'];
                              $v[$key][$index]['MultiplyPaymentFactor'][$j]['EndOn'] = $paymentfactor['MultiplyPaymentFactor']['end_date'];

                             $j++;

                            }

                            $payarr = array();
                            foreach ( $v[$key][$index]['MultiplyPaymentFactor'] as $p) {
                                $payarr[] = $p['paymentFactor'];
                                
                            }
                             $v[$key][$index]['TotalPayment']= 0.166 * $seconds * max($payarr);
                         }
                         else
                         {
                            $v[$key][$index]['MultiplyPaymentFactor']['0']['id'] =0;
                            $v[$key][$index]['MultiplyPaymentFactor']['0']['type'] = 'normal';
                            $v[$key][$index]['MultiplyPaymentFactor']['0']['paymentFactor'] = 1;

                            $v[$key][$index]['TotalPayment']=  0.166* $seconds;
                         }

                 
                        }

                    }
               }
                   // debug($v);die();

               // debug($this->HisToseconds('01:00:00'));
               $arr = array();
                   foreach ($v as $keys) {

                        // debug($keys);
                        $a=0;
                        $b = 0;
                        $totalPayment = 0;
                        $totalHours = 0;
                        $grandTotalPayment=0;

                        foreach ($keys as $key) {

                            // debug($key['totalWorkinHour']);

                            $paytype = reset($key['MultiplyPaymentFactor']);
                            if(isset($paytype) && !empty($paytype))
                            {
                                $a = $this->HisToseconds($key['totalWorkinHour']) + $a;
                                $arr[$paytype['type']]['workingHour'] = $this->secondsToHIS($a);
                                $b = $key['TotalPayment']+$b;
                                $arr[$paytype['type']]['payment'] = $b;    
                            }
                            else
                            {

                                $a = $this->HisToseconds($key['totalWorkinHour']) + $a;
                                $arr['normal']['workingHour'] = $this->secondsToHIS($a);
                                $b = $key['TotalPayment']+$b;
                                $arr['normal']['payment'] = $b;

                            }
                        }
                   }


                $totalPayment = 0;
                $totalHours = 0;
                $grandTotalPayment = 0;
                $grandTotalHours = 0;
                $afterTaxDeduction = 0;
                $taxableAmount =0;

                if (isset($arr) && !empty($arr)) {
                    
                    foreach ($arr as $key => $value) {

                         if (isset($arr['normal']['payment']) && !empty($arr['normal']['payment'])){

                                $arr['totalNormalPayment'] = $totalPayment +$arr['normal']['payment'] ;
                                $arr['totalNormaHours'] = $totalHours + $arr['normal']['workingHour']; 
                            
                         }
                         else{

                            $arr['totalNormalPayment'] = 0;
                            $arr['totalNormaHours'] = 0; 
                         }


                            $grandTotalPayment = $grandTotalPayment + $value['payment'];
                            $grandTotalHours =$grandTotalHours + $this->HisToseconds($value['workingHour']);
                      }

                      $arr['grandTotalPayment']=$grandTotalPayment;
                      $arr['grandTotalHours']=$this->secondsToHIS($grandTotalHours);
                      $arr['afterTaxDeduction' ]= $grandTotalPayment - (($grandTotalPayment)*(13/100));
                      $arr['taxableAmount'] = (($grandTotalPayment)*(13/100));
                      
                      $this->set(array(
                            'output'=>1,
                            'arr'=>$arr,                       
                            '_serialize'=>array('arr','output'),
                            '_jsonp'=>true
                            ));
                   }else{
                    
                     $this->set(array(
                            'output'=>0,                       
                            '_serialize'=>array('output'),
                            '_jsonp'=>true
                        ));
                   
                   
                   }

                  //debug($arr);
                 

        }



    public function shiftAssignNotificationUser($userId = null)
    {
        $this->ShiftUser->Behaviors->load('Containable');
        // debug($userId);die();
        $options = array(
            'conditions'=>['ShiftUser.user_id'=>$userId, 'ShiftUser.status'=>1, 'ShiftUser.shift_date >= '=>date('Y-m-d')],
            'fields'=>['shift_date', 'id'],
            'contain'=>['Organization.title','Shift.title','Shift.starttime', 'Shift.endtime']
            );
        $shifts = $this->ShiftUser->find('all',$options);

        // debug($shifts);

        $unreadoptions = array(
            'conditions'=>['ShiftUser.user_id'=>$userId, 'ShiftUser.status'=>1, 'ShiftUser.shift_date >= '=>date('Y-m-d'), 'ShiftUser.shiftassignnotification'=>0],
            'fields'=>['shift_date', 'id'],
            'contain'=>['Organization.title','Shift.title','Shift.starttime', 'Shift.endtime']
            );

        $unreadNotification = $this->ShiftUser->find('count', $unreadoptions);

        if($unreadNotification >0)
        {
            $this->ShiftUser->updateAll(
                                        array('ShiftUser.shiftassignnotification' => 1),
                                        // conditions
                                        array('ShiftUser.user_id' => $userId, 'ShiftUser.shiftassignnotification'=>0)
                                    );
        }



        $count = $this->ShiftUser->find('count',  $options);
        $data = array();
        if(isset($shifts) && !empty($shifts))
        {
            $status=1;
            $data['shiftList'] = $shifts;
            $data['count'] = $count;
            $data['unreadNotification'] = $unreadNotification;
        }
        else
        {
            $status = 0;
        }

        $this->set(array(
            'status'=>$status,
            'output'=>$data,
            '_serialize'=>['output', 'status'],
            '_jsonp'=>true
            ));
        // debug($data);
        // die();
    }

    
     public function shiftResponseNotifications($orgId=null, $boardList = null)
        {
            $this->ShiftUser->Behaviors->load('Containable');

            if($boardList != 0)
            {

                $arr = explode('_', $boardList);
                $options = array(
                    'conditions'=>['ShiftUser.board_id'=>$boardList, 'ShiftUser.managernotifications'=>0, 'ShiftUser.status'=>[0,3]],
                    'contain'=>['User.fname', 'User.lname'],
                    );

                $notifications = $this->ShiftUser->find('all', $options);

                if(isset($notifications) && !empty($notifications))
                {
                    $output = 1;

                    $this->ShiftUser->updateAll(["managernotifications"=>1],['ShiftUser.board_id'=>$boardList, 'ShiftUser.managernotifications'=>0, 'ShiftUser.status'=>[0,3]]);
                    $from ="user";
                }
                else
                {
                    $from ="user";
                    $output = 0;
                }

            }
            elseif($orgId !=0)
            {
               $options = array(
                'conditions'=>['ShiftUser.organization_id'=>$orgId, 'ShiftUser.orgnotifications'=>0, 'ShiftUser.status'=>[0,3]],
                'contain'=>['User.fname', 'User.lname']
                );
               $notifications = $this->ShiftUser->find('all', $options);

                if(isset($notifications) && !empty($notifications))
                {
                    $output = 1;
                    $this->ShiftUser->updateAll(["orgnotifications"=>1],['ShiftUser.orgnotifications'=>0, 'ShiftUser.status'=>[0,3]]);
                    $from= "org";
                }
                else
                {
                    $from="org";
                    $output = 0;
                }
            }
            else
            {
                $output=0;
                $notifications=0;
                $from=0;
            }

            $this->set(array(
                        'output'=>$output,
                        'notifications'=> $notifications,
                        'from'=>$from,
                        '_serialize'=>['notifications', 'output', 'from'],
                        '_jsonp'=>true
                    ));
        }


public function deleteShiftById($id){
        $this->ShiftUser->id = $id;
        if($this->ShiftUser->delete()){
            $output = 1;
        } else {
            $output = 2;
        }

        $this->set(array(
            'message'=>$output,
            '_serialize'=>'message',
            'jsonp'=>true
            ));
    }

     public function searchUserShifts($userId = null,$fromDate = null, $toDate = null)
      {
          if($fromDate!= null || $toDate!=null)
          {
            $this->ShiftUser->Behaviors->load('Containable');
            $myShifts = $this->ShiftUser->find('all',array(
                    'conditions' => array(
                        'ShiftUser.user_id' => $userId,
                        'ShiftUser.shift_date >=' =>$fromDate,
                        'ShiftUser.shift_date <=' =>$toDate
                        ),
                    'contain'=>array(
                        'Board.Organization',
                         'Shift',
                          'Shift.Shiftnote',
                            'Board.ShiftUser.User'=>array('fields' => array('id','fname', 'lname'))

                            )
                    // 'order'=>array('ShiftUser.shift_date' => 'DESC')
                    
                ));
           // debug($myShifts);
          }
          else{
            $this->ShiftUser->Behaviors->load('Containable');
                $myShifts = $this->ShiftUser->find('all', array(
                    'conditions'=>array('ShiftUser.user_id'=>$userId),
                    'contain'=>array(
                        'Board.Organization',
                         'Shift',
                          'Shift.Shiftnote',
                            'Board.ShiftUser.User'=>array('fields' => array('id','fname', 'lname'))

                            )
                    // 'order'=>array('ShiftUser.shift_date' => 'DESC')
                    ));
                // debug($myShifts);
          }
           $this->set('output', $myShifts);

            $this->set(
                        array(
                            "_serialize" => array('output')
                        )
                );
      }


      public function addShiftForUser($orgId=null,$shiftId=null,$boardId=null,$userId=null,$shiftDate=null){
        $this->request->data['ShiftUser']['organization_id'] = $orgId;
        $this->request->data['ShiftUser']['board_id'] = $boardId;
        $this->request->data['ShiftUser']['user_id'] = $userId;
        $this->request->data['ShiftUser']['shift_id'] = $shiftId;
        $this->request->data['ShiftUser']['shift_date'] = $shiftDate;
        $this->request->data['ShiftUser']['status'] = 0;
        $this->ShiftUser->create();
        $this->ShiftUser->getInsertID();

        $this->loadModel('User');
        $userDetail = $this->User->userDetail($userId);
        $fullname = $userDetail['User']['fname'].' '.$userDetail['User']['lname'];
        $output['fullname'] =  $fullname;
       
        if($this->ShiftUser->save($this->request->data)){
               $lastId = $this->ShiftUser->getInsertID(); 
            $shift = $this->ShiftUser->find('first',array(
                    'conditions'=>array('ShiftUser.id'=>$lastId)
                ));

        $starttime = $shift['Shift']['starttime'];
        $endtime = $shift['Shift']['endtime'];
        $stime = date("g:i a",strtotime($starttime));
        $etime = date("g:i a",strtotime($endtime));
        $output['starttime'] = $stime;
        $output['endtime'] = $etime;
        $output['shift'] = $shift['Shift']['title'];
        $output['id'] = $lastId;
            $output['status'] = 1;
        } else {
            $output['status'] = 0;
        }
        $this->set(array(
            'output' => $output,
            '_serialize' => 'output',
            'jsonp' =>true
            ));
      }   

      public function ymdtofjy($date)
        {   
            $date = strtotime($date);
            return date('F j, Y', $date);
        }
        
      public function getOrganizationShiftUsers($orgId=null){
            $shiftUsers = $this->ShiftUser->getOrganizationShiftUser($orgId);
            $this->set(array(
               "shftUsers"=>$shiftUsers,
               "_serialize"=>array("shftUsers"),
               "_jsonp"=>true 
            ));
      }
    
    public function filterEmployeeList($orgId,$name){
        $output = $this->ShiftUser->filterEmployeeList($orgId,$name);
        $this->set(array('output'=>$output,'_serialize'=>'output'));
    }

    public function todaysShift($userId=null)
    {
        $output = $this->ShiftUser->todaysShift($userId);
        $this->set(array(
                'output'=>$output,
                '_serialize'=>'output'
            ));
        
    }

    public function todaysShiftForOrg($orgId){
        $output = $this->ShiftUser->todaysShiftForOrg($orgId);
        $this->set(array(
                'output'=>$output,
                '_serialize'=>'output'
            ));   
    }

    public function changeShiftTime($shiftId){
        
        $output = $this->ShiftUser->changeShift($shiftId);
        
        $this->set(array(
                'output'=>$output,
                '_serialize'=>'output' 
                ));
    }

    public function filterTodayShift($orgId,$branchId,$boardId){
        $output = $this->ShiftUser->filterTodayShift($orgId,$branchId,$boardId);
        $this->set(array(
                'output'=>$output,
                '_serialize'=>'output'
            ));   
    }

    public function getShiftHistoryOfEmp($userId = null, $orgId = null)
    {
        $data = $this->ShiftUser->getShiftHistoryOfEmp($userId, $orgId);

        $status = 0;
        if(isset($data) && !empty($data))
        {
            $status = 1;
        }

        $this->set(array(
                'status'=>$status,
                'total'=>$data,
                '_serialize'=>['status', 'total'],
                '_jsonp'=>true
                ));

    }

    public function getAllShiftHistoryOfEmp($userId = null, $sDate = null, $eDate = null)
    {
        $data = $this->ShiftUser->getAllShiftHistoryOfEmp($userId, $sDate, $eDate);

        $status = 0;
        if(isset($data) && !empty($data))
        {
            $status = 1;
        }

        $this->set(array(
                'status'=>$status,
                'total'=>$data,
                '_serialize'=>['status', 'total'],
                '_jsonp'=>true
                ));

    }

    // Get shift of Employee on a particular department.
    public function getEmpShiftOnBoard( $userId = null, $boardId = null)
    {
        $data = $this->ShiftUser->getEmpShiftOnBoard($userId, $boardId);

        $status = 0;
        if(isset($data) && !empty($data))
        {
            $status = 1;
        }

        $this->set(array(
                'status'=>$status,
                'data'=>$data,
                '_serialize'=>['status', 'data'],
                '_jsonp'=>true
                ));
    }

    // Get overall shift of Employee in the system.
    public function getEmpShiftSchedule( $userId = null)
    {
        $data = $this->ShiftUser->getEmpShiftSchedule($userId);

        $status = 0;
        if(isset($data) && !empty($data))
        {
            $status = 1;
        }

        $this->set(array(
                'status'=>$status,
                'data'=>$data,
                '_serialize'=>['status', 'data'],
                '_jsonp'=>true
                ));
    }

    public function myFriend($id){
        $output = $this->ShiftUser->myFriend($id);
        $this->set(array(
                'output'=>$output,
                '_serialize'=>'output'
            ));
    }

    public function getShiftUser($shiftUserId = null)
        {
            $this->ShiftUser->Behaviors->load('Containable');

            $options = array(
                'conditions'=>['ShiftUser.id'=>$shiftUserId, 'ShiftUser.managernotifications'=>0, 'ShiftUser.status'=>[0,3]],
                'contain'=>['User.fname', 'User.lname'],
                );

            $notifications = $this->ShiftUser->find('first', $options);

            if(isset($notifications) && !empty($notifications))
            {
                $output = 1;

                $this->ShiftUser->id = $notifications['ShiftUser']['id'];
                $this->ShiftUser->saveField('managernotifications',1);
                $from ="user";
            }
            else
            {
                $from ="user";
                $output = 0;
            }

            $this->set(array(
                        'output'=>$output,
                        'notifications'=> $notifications,
                        'from'=>$from,
                        '_serialize'=>['notifications', 'output', 'from'],
                        '_jsonp'=>true
                    ));
        }

}
