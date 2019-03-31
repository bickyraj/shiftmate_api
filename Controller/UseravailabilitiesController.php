<?php
App::uses('AppController', 'Controller');


/**
 * Useravailabilities Controller
 *
 * @property Useravailability $Useravailability
 * @property PaginatorComponent $Paginator
 */
class UseravailabilitiesController extends AppController {

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
        
        public function userAvailability($user_id){
            $this->Useravailability->Behaviors->load('Containable');
            
            
            $userAvailability = $this->Useravailability->find('all', array(
                'fields'=>array(
                    'Useravailability.organization_id',
                    'Useravailability.status',
                    'Useravailability.day_id'
                    ),
                'contain'=>FALSE,
                'conditions'=>array(
                    'Useravailability.user_id'=>$user_id
                    )
                )
                    );
            //debug($userAvailability);
           //die(); 
            $this->set(array(
                    'message' => $userAvailability,
                    '_serialize' => array('message')
                
                ));	
        }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Useravailability->recursive = 0;
		$this->set('useravailabilities', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Useravailability->exists($id)) {
			throw new NotFoundException(__('Invalid useravailability'));
		}
		$options = array('conditions' => array('Useravailability.' . $this->Useravailability->primaryKey => $id));
		$this->set('useravailability', $this->Useravailability->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Useravailability->create();
			if ($this->Useravailability->save($this->request->data)) {
				$this->Session->setFlash(__('The useravailability has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The useravailability could not be saved. Please, try again.'));
			}
		}
		$users = $this->Useravailability->User->find('list');
		$days = $this->Useravailability->Day->find('list');
		$this->set(compact('users', 'days'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Useravailability->exists($id)) {
			throw new NotFoundException(__('Invalid useravailability'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Useravailability->save($this->request->data)) {
				$this->Session->setFlash(__('The useravailability has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The useravailability could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Useravailability.' . $this->Useravailability->primaryKey => $id));
			$this->request->data = $this->Useravailability->find('first', $options);
		}
		$users = $this->Useravailability->User->find('list');
		$days = $this->Useravailability->Day->find('list');
		$this->set(compact('users', 'days'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Useravailability->id = $id;
		if (!$this->Useravailability->exists()) {
			throw new NotFoundException(__('Invalid useravailability'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Useravailability->delete()) {
			$this->Session->setFlash(__('The useravailability has been deleted.'));
		} else {
			$this->Session->setFlash(__('The useravailability could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        // from shyam
         
        public function addEmployeeAvailabilities($userId = null){
           if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
               
                // foreach($this->request->data['Useravailability'] as $key=>$availabilities):
                //     if($availabilities['availabilities'] == 1){
                //     foreach($availabilities['time'] as $availableTime):
                //     $data[] = array('user_id'=>$userId, 'day_id'=>$key, 'starttime'=>$availableTime['starttime'], 'endtime'=>$availableTime['endtime'], 'status'=>$availabilities['availabilities']);
                //     endforeach;
                //     }else{
                //         $data[] = array('user_id'=>$userId, 'day_id'=>$key, 'status'=>$availabilities['availabilities']);  
                //     }
                // endforeach;

                foreach($this->request->data['Useravailability'] as $key=>$availabilities):
                    
                    if($availabilities['availabilities'] == 1){
                          foreach($availabilities['time'] as $availableTime):

                            if(!isset($availableTime['organization_id']))
                            {
                              $availableTime['organization_id'] = '0';
                            }

                            $st=date("H:i:s", strtotime($availableTime['starttime']));
                            $et=date("H:i:s", strtotime($availableTime['endtime']));
                            $availableTime['starttime']  = $st;
                            $availableTime['endtime']  = $et;

                            $data[] = array('user_id'=>$userId, 'day_id'=>$key, 'starttime'=>$availableTime['starttime'], 'endtime'=>$availableTime['endtime'], 'organization_id'=>$availableTime['organization_id'], 'status'=>$availabilities['availabilities']);
                          endforeach;
                    }else
                    {
                            if(!empty($availabilities['id'])){
                            $data[] = array('id'=>$availabilities['id'], 'user_id'=>$userId, 'starttime'=>'00:00:00', 'endtime'=>'00:00:00', 'day_id'=>$key, 'status'=>$availabilities['availabilities']);  
                        }else{
                           $data[] = array('user_id'=>$userId, 'starttime'=>'00:00:00', 'endtime'=>'00:00:00', 'day_id'=>$key, 'status'=>$availabilities['availabilities']);   
                        }
                    }
                endforeach;
                //debug($data);die();
               
                if($this->Useravailability->saveMany($data)){
                    $output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                       "action" => "addEmployeeAvailabilities",
                                       "status"=>1,
                                       //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Employees availabilities added.")
                                      );
                }else{
                    $output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                       "action" => "addEmployeeAvailabilities",
                                       "status"=>0,
                                       //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Employee availabilities couldnot be added.")
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
            
            /* Ajay */
            
            function  _checkUserInUseravailibity($userId = null){
                $userAvailability = $this->Useravailability->find('count', array(
                    'conditions'=>array('Useravailability.user_id' => $userId)
                ));
                return $userAvailability;
            }


            public function useravailabilityList($userId = null)
                {
                         if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
                             debug($this->request->data);
                         }
                        
                        $userAvailabilityCheck = $this->_checkUserInUseravailibity($userId);

                        if($userAvailabilityCheck > 0):
                         
                                $days = $this->Useravailability->Day->find('list');

                                foreach($days as $key=>$day):
                                    $datas[$key] = $this->Useravailability->find('all', array('conditions'=>array('user_id'=>$userId, 'day_id'=>$key)));
                                endforeach;

                                foreach($datas as $key1 =>$data):
                                    //$result['time'] = array();
                                    foreach($data as $time):
                                    $availabilities[$key1]['data'] = $time['Useravailability'];
                                    $availabilities[$key1]['day'] = $time['Day'];


                                    // $starttime = date('h:i:s a', strtotime($time['Useravailability']['starttime']));
                                    // $starttime = explode(":", $starttime);
                                    // $starthour = $starttime['0'];
                                    // $startmin = $starttime['1'];
                                    // $startmeridian = explode(" ", $starttime['2']);
                                    // $startmeridian = $startmeridian['1'];


                                    // $endtime = date('h:i:s a', strtotime($time['Useravailability']['endtime']));
                                    // $endtime = explode(":", $endtime);
                                    // $endhour = $endtime['0'];
                                    // $endmin = $endtime['1'];
                                    // $endmeridian = explode(" ", $endtime['2']);
                                    // $endmeridian = $endmeridian['1'];

                                    // $endtime = date('h:i:s a', strtotime($time['Useravailability']['endtime']));
                                    $availabilities[$key1]['time'][] = array('id'=>$time['Useravailability']['id'],
                                                                             'starttime'=>$time['Useravailability']['starttime'],
                                                                             'endtime'=>$time['Useravailability']['endtime'],
                                                                             'organizationId'=>$time['Useravailability']['organization_id']);
                                endforeach;
                                 //$result[] = Set::insert($data, 'time', $data1);
                                endforeach;
                                    $availabilities_status = 1;
                        else:
                                $availabilities_status = 0;
                        $availabilities[] = '';
                        endif;
                        //debug($availabilities_status);
                        
                        $this->set('availabilities_status',$availabilities_status);

                        $this->set('availabilities',$availabilities);
                        $this->set(
                                            array(
                                                "_serialize" =>array('availabilities', 'availabilities_status')
                                            )
                                    );
                        //debug($data);
                }
            
            
            //function for test in api. not used for view file.
            public function updateEmployeeAvailabilitiesApi ($userId = null){
                
                if ($this->request->is(array('post', 'put'))) {
                    
                    //debug($this->request->data);
                }
                $days = $this->Useravailability->Day->find('list');
                
                foreach($days as $key=>$day):
                    $datas[$key] = $this->Useravailability->find('all', array('conditions'=>array('user_id'=>$userId, 'day_id'=>$key)));
                endforeach;
                
                foreach($datas as $key1 =>$data):
                    //$result['time'] = array();
                    foreach($data as $time):
                    $availabilities[$key1]['data'] = $time['Useravailability'];
                    $availabilities[$key1]['day'] = $time['Day'];
                
                    $starttime = date('h:i:s a', strtotime($time['Useravailability']['starttime']));
                    $starttime = explode(":", $starttime);
                    $starthour = $starttime['0'];
                    $startmin = $starttime['1'];
                    $startmeridian = explode(" ", $starttime['2']);
                    $startmeridian = $startmeridian['1'];
                    
                    
                    $endtime = date('h:i:s a', strtotime($time['Useravailability']['endtime']));
                    $endtime = explode(":", $endtime);
                    $endhour = $endtime['0'];
                    $endmin = $endtime['1'];
                    $endmeridian = explode(" ", $endtime['2']);
                    $endmeridian = $endmeridian['1'];
                    
                    $endtime = date('h:i:s a', strtotime($time['Useravailability']['endtime']));
                    $availabilities[$key1]['time'][] = array('id'=>$time['Useravailability']['id'],
                                                             'starttime'=>array('hour'=>$starthour, 'min'=>$startmin, 'meridian'=>$startmeridian),
                                                             'endtime'=>array('hour'=>$endhour, 'min'=>$endmin, 'meridian'=>$endmeridian),
                                                             'organizationId'=>$time['Useravailability']['organization_id']);
                endforeach;
                 //$result[] = Set::insert($data, 'time', $data1);
                endforeach;
                //debug($availabilities);
                $this->set('availabilities',$availabilities);
                
                //debug($data);
            }
            
            public function updateEmployeeAvailabilities($userId = null){
               // debug($this->request->data);die();
                if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
                foreach($this->request->data['Useravailability'] as $key=>$availabilities):
                    
                    if($availabilities['availabilities'] == 1){
                         $avai = $this->Useravailability->find('list', array('conditions'=>array('user_id'=>$userId, 'day_id'=>$key)));
                         $this->Useravailability->delete($avai);
                          foreach($availabilities['time'] as $availableTime):

                            if(!isset($availableTime['organization_id']))
                            {
                              $availableTime['organization_id'] = '0';
                            }

                            $st=date("H:i:s", strtotime($availableTime['starttime']));
                            $et=date("H:i:s", strtotime($availableTime['endtime']));
                            $availableTime['starttime']  = $st;
                            $availableTime['endtime']  = $et;

                            $data[] = array('user_id'=>$userId, 'day_id'=>$key, 'starttime'=>$availableTime['starttime'], 'endtime'=>$availableTime['endtime'], 'organization_id'=>$availableTime['organization_id'], 'status'=>$availabilities['availabilities']);
                          endforeach;
                    }else{
                        $avai = $this->Useravailability->find('list', array('conditions'=>array('user_id'=>$userId, 'day_id'=>$key, 'status'=>1, 'organization_id'=>0)));
                        $this->Useravailability->delete($avai);
                        if(!empty($availabilities['id'])){
                        $data[] = array('id'=>$availabilities['id'], 'user_id'=>$userId, 'starttime'=>'00:00:00', 'endtime'=>'00:00:00', 'day_id'=>$key, 'status'=>$availabilities['availabilities']);  
                    }else{
                       $data[] = array('user_id'=>$userId, 'starttime'=>'00:00:00', 'endtime'=>'00:00:00', 'day_id'=>$key, 'status'=>$availabilities['availabilities']);   
                    }
                    }
                endforeach;
                //debug($data);die();
               if($this->Useravailability->saveMany($data)){
                    $output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                       "action" => "updateEmployeeAvailabilities",
                                       "status"=>1,
                                       //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Employees availabilities Updated.")
                                      );
                }else{
                    $output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                       "action" => "updateEmployeeAvailabilities",
                                       "status"=>0,
                                       //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Employee availabilities couldnot be Updated.Please Try Again")
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


//      public function listAllAvailableUser($shiftId=null,$boardId=null,$shift_date=null){
       
//         $this->loadModel('BoardUser');
//         $this->loadModel('ShiftUser');
//         $this->loadModel('Shift');
//         $this->loadModel('User');
//         $availableUserForAShift=array();
//         $shift_user=array();

        
//         $shifts = $this->Shift->find('first',array('conditions'=>array('Shift.id' => $shiftId )));

//         $starttime_shift = $shifts['Shift']['starttime']; 
//         $endtime_shift = $shifts['Shift']['endtime']; 
        
//         $users = $this->BoardUser->listUserFromBoardId($boardId);
        
//         // //debug($users);
//         $shiftDate=DateTime::createFromFormat('Y-m-d',$shift_date);
//         $dayId = $shiftDate->format('w')+1;
//            $u = array();
//             $count=0;   
//           foreach($users as $user){
//                 //debug($user);
//                 $u[$count] = $user['BoardUser']['user_id'];
//                 //debug($u[$count]);
//                 if($this->Useravailability->hasAny(['user_id'=>$u[$count],'status'=>0,'day_id'=>$dayId])){
                   
//                     $freeforAllShift[$u[$count]] = $u[$count];
//                     //debug($freeforAllShift);
//                    //debug($u[$count]);
                
//                 } elseif($this->Useravailability->hasAny(['user_id'=>$u[$count],'status'=>1,'day_id'=>$dayId])){

//                 //debug($u[$count]);           
//                 $freeForGivenShift = $this->Useravailability->listAllAvailableUser($dayId,$starttime_shift,$endtime_shift,$u[$count]);
//                // debug($freeForGivenShift);
//                 //$freeforThisShift = array();
                
//                 if($this->ShiftUser->hasAny(['shift_date'=>$shift_date])){
//                 foreach($freeForGivenShift as $key => $free){
//                     $freeforThisShift[$key] = $free['Useravailability']['user_id'];

//                     //from 
                    
//                     $shift_user = $this->ShiftUser->findShiftUserById($freeforThisShift[$key],$shift_date);
//                     //debug($shift_user);
    
//                 }

//                 //debug($shift_user);
//                 $k = 0;
//                 $shiftID = array();
//                foreach($shift_user as $shift){
//                     $userID = $shift['ShiftUser']['user_id'];
//                     $shiftID[$userID][$k]['shift_id'] = $shift['ShiftUser']['shift_id'];
//                $k++;
//                }
//                //debug($shiftID);


//                foreach ($shiftID as $key => $value) {
                    
//                     foreach($value as $val){
//                         $shift_id = $val['shift_id'];

//                         $shifts = $this->Shift->findShiftById($shift_id);
//                         $values=$this->compareTime($starttime_shift,$endtime_shift,$shifts['Shift']['starttime'],$shifts['Shift']['endtime']);
// //debug($values);
//                         if($values==true){
//                             $availableUserForAShift[$key]=$key;
//                         }else{
//                             if(isset($availableUserForAShift[$key])){
//                                  unset($availableUserForAShift[$key]);
//                             }
//                            continue 2;
//                         }
//                     }
//                }
//            }
//             else {
//                 foreach($freeForGivenShift as $freeForGivenShifts){
//                     $availableUserForAShift[$freeForGivenShifts['User']['id']]=$freeForGivenShifts['User']['id'];
//                 }
                
//             }

//                 }
//                  $count++;
//             }

//            if(!empty($freeforAllShift) && !empty($availableUserForAShift)){
//                 $available = array_merge($freeforAllShift,$availableUserForAShift);
//            }elseif(empty($freeforAllShift)){
//                 $available=$availableUserForAShift;
//            }else{
//                 $available=$freeforAllShift;
//            }
           
//            if(!empty($available)){
//                 foreach($available as $userid){
//                 //debug($userid);
//                     $result=$this->User->userDetail($userid);
//                     $userxy[$result['User']['id']]['name']=ucwords($result['User']['fname']." ".$result['User']['lname']);
//                     $userxy[$result['User']['id']]['id']=$result['User']['id'];
//                }

//                $this->set(array(
//                 'user'=>$userxy,
//                 '_serialize'=>array('user')
//                 ));
//            }else{
//                 $this->set(array(
//                 'message'=>"No users found.",
//                 '_serialize'=>array('message')
//                 ));
//            }
            
            
            

//             }


    public function compareTime($assigned_start,$assigned_end,$shift_start,$shift_end){
        if(($assigned_start < $shift_start && $assigned_end <= $shift_start) || ($assigned_start >= $shift_end && $assigned_end > $shift_end)){
            return true;
        }else{
            return false;
        }
    }
    
    public function listAllAvailableUser($shiftId=null,$boardId=null,$shift_date=null){

        $available = $this->Useravailability->listAllAvailableUser($shiftId,$boardId,$shift_date);

        
        $this->set(array(
            'user'=>$available,
            '_serialize'=>'user',
            '_jsonp'=>true
            ));
    }

    public function findDurationIfNotAvailable($userId=null,$shiftId=null){
        $results = $this->Useravailability->findDurationIfNotAvailable($userId,$shiftId);

        $output = array();
        if(isset($results) && !empty($results))
        {
            $starttime = $results['Useravailability']['starttime'];
            $endtime = $results['Useravailability']['endtime'];
            $stime = date("g:i a",strtotime($starttime));
            $etime = date("g:i a",strtotime($endtime));
            $output['starttime'] = $stime;
            $output['endtime'] = $etime;
        }
        
        $this->set(array(
            'output'=>$output,
            '_serialize'=>'output',
            '_jsonp'=>true
            ));
    }

    // public function test($a,$b,$c,$d){
    //     $this->Useravailability->compareTime($a,$b,$c,$d);
    // }

    public function checkToConfirm($userId = null,$shiftId = null,$shiftDate = null){
        $output = $this->Useravailability->checkToConfirm($userId,$shiftId,$shiftDate);
        $this->set(array(
            'output'=>$output,
            '_serialize'=>'output'
            ));
    }

    public function convert($t)
    {
        list ($h, $m, $s) = explode(':', $t);
        return $s + 60 * ($m + 60 * $h);
    }

    public function compareTimeInterval(){
        
        $one_day = 24 * 60 * 60;
        $starttime1 = $this->convert('17:00:00');
        $endtime1 = $this->convert('15:00:00');
         
        if ($endtime1 < $starttime1) {
            $endtime1 += $one_day;
        }
         
        $starttime2 = $this->convert('17:00:00');
        $endtime2 = $this->convert('15:00:00');
         
        if ($endtime2 < $starttime2) {
            $endtime2 += $one_day;
        }
         
        if (($endtime2 >= $starttime1 && $endtime2 <= $endtime1) ||
            ($starttime2 >= $starttime1 && $starttime2 <= $endtime1))
        {
            echo ("intersect");
        } else {
            echo ("doesn't intersect");
        }
    
    }

    public function confirmCalendarRequest($userId = null,$shiftUserId = null){

      $this->loadModel('ShiftUser');
      $result = $this->ShiftUser->find('first',array(
            'recursive'=>-1,
            'conditions'=>['ShiftUser.id'=>$shiftUserId]
        ));

      $shiftDate = $result['ShiftUser']['shift_date'];
      $shiftId = $result['ShiftUser']['shift_id'];

      $output = $this->Useravailability->checkToConfirm($userId,$shiftId,$shiftDate);
      
      $this->set(array(
            'output'=>$output,
            '_serialize'=>'output'
        ));
    }



}

