<?php
App::uses('AppModel', 'Model');
/**
 * Useravailability Model
 *
 * @property User $User
 * @property Day $Day
 */
class Useravailability extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'day_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'starttime' => array(
			'time' => array(
				'rule' => array('time'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'endtime' => array(
			'time' => array(
				'rule' => array('time'),
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Day' => array(
			'className' => 'Day',
			'foreignKey' => 'day_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);	


	//Edited by manohar khadka
	public function listAllAvailableUsers($dayId,$starttime_shift,$endtime_shift,$userId){
		$this->Behaviors->load('Containable');
		$available = $this->find('all',array(
			'conditions'=>array(
				'Useravailability.user_id'=>$userId,
				'Useravailability.day_id'=>$dayId,
				'Useravailability.starttime <='=>$starttime_shift,
				'Useravailability.starttime <'=>$endtime_shift,
				'Useravailability.endtime >'=>$starttime_shift,
				'Useravailability.endtime >='=>$endtime_shift
				)
			//'contain'=>array('Useravailability')
			));
	
		//debug($available);
		return $available; 
	}


  public function listAllAvailableUser($shiftId,$boardId,$shift_date){

    $BoardUsers = ClassRegistry::init("BoardUser");
    $ShiftsUsers = ClassRegistry::init("ShiftUser");
    $Shifts = ClassRegistry::init("Shift");
    $Users = ClassRegistry::init("User");
        
        $availableUserForAShift = array();
        $shift_user = array();

        $shifts = $Shifts->find('first',array('conditions'=>array('Shift.id' => $shiftId )));

        //debug($shifts);

        $starttime_shift = $shifts['Shift']['starttime']; 
        $endtime_shift = $shifts['Shift']['endtime'];

        $users = $BoardUsers->listUserFromBoardId($boardId);
        
  //       debug($users);
        $shiftDate = DateTime::createFromFormat('Y-m-d',$shift_date);
        $dayId = $shiftDate->format('w')+1;


        $u = array();
            $count=0;   
          foreach($users as $user){
                // debug($user);
                $u[$count] = $user['BoardUser']['user_id'];
                // debug($u[$count]);
                if($this->hasAny(['user_id'=>$u[$count],'status'=>0,'day_id'=>$dayId])){
                    
                    if($ShiftsUsers->hasAny(['shift_date'=>$shift_date,'user_id'=>$u[$count],'status'=>[0,1,2,3]])){
                      
                      $shift_user1 = $ShiftsUsers->findShiftUserForNoStatus($u[$count],$shift_date);
                      $k = 0;
                    //debug($shift_user1);
                    $shiftID = array();
                   foreach($shift_user1 as $shift){
                        $userID = $shift['ShiftUser']['user_id'];
                        $shiftID[$userID][$k]['shift_id'] = $shift['ShiftUser']['shift_id'];
                   $k++;
                   }

      foreach ($shiftID as $key => $value) {
                    
                    foreach($value as $val){
                        $shift_id = $val['shift_id'];

                        $shifts = $Shifts->findShiftById($shift_id);
                        $values=$this->compareTime($starttime_shift,$endtime_shift,$shifts['Shift']['starttime'],$shifts['Shift']['endtime']);
                        //debug($starttime_shift.' '.$endtime_shift.' '.$shifts['Shift']['starttime'].' '.$shifts['Shift']['endtime']);

                        //debug($values);
                        if($values==true){

                            $availableUserForAShift[$key]=$key;
                        }else{
                            if(isset($availableUserForAShift[$key])){
                                 unset($availableUserForAShift[$key]);
                            }
                           continue 2;
                        }
                    }
               }
                    }else{
                      $availableUserForAShift[$u[$count]] = $u[$count];
                      // debug($u[$count]);
                    }
                    
                    //debug($freeforAllShift);
                   //debug($u[$count]);
                
                } elseif($this->hasAny(['user_id'=>$u[$count],'status'=>1,'day_id'=>$dayId])){

                //debug($u[$count]);           
                $freeForGivenShift = $this->listAllAvailableUsers($dayId,$starttime_shift,$endtime_shift,$u[$count]);
               //debug($freeForGivenShift);
                //$freeforThisShift = array();
                
                if($ShiftsUsers->hasAny(['shift_date'=>$shift_date,'user_id'=>$u[$count],'status'=>3])){

                foreach($freeForGivenShift as $key => $free){
                    $freeforThisShift[$key] = $free['Useravailability']['user_id'];
                    //from 
                    
                    $shift_user = $ShiftsUsers->findShiftUserById($freeforThisShift[$key],$shift_date);
                    //debug($shift_user);
    
                }

                //debug($shift_user);
                $k = 0;
                $shiftID = array();
               foreach($shift_user as $shift){
                    $userID = $shift['ShiftUser']['user_id'];
                    $shiftID[$userID][$k]['shift_id'] = $shift['ShiftUser']['shift_id'];
               $k++;
               }
               //debug($shiftID);


               foreach ($shiftID as $key => $value) {
                    
                    foreach($value as $val){
                        $shift_id = $val['shift_id'];

                        $shifts = $Shifts->findShiftById($shift_id);
                        $values=$this->compareTime($starttime_shift,$endtime_shift,$shifts['Shift']['starttime'],$shifts['Shift']['endtime']);
//debug($values);
                        if($values==true){
                            $availableUserForAShift[$key]=$key;
                        }else{
                            if(isset($availableUserForAShift[$key])){
                                 unset($availableUserForAShift[$key]);
                            }
                           continue 2;
                        }
                    }
               }
           }
            else {
                foreach($freeForGivenShift as $freeForGivenShifts){
                    $availableUserForAShift[$freeForGivenShifts['User']['id']]=$freeForGivenShifts['User']['id'];
                }
                
            }

                }
                 $count++;
            }

           // if(!empty($freeforAllShift) && !empty($availableUserForAShift)){
           //      $available = array_merge($freeforAllShift,$availableUserForAShift);
           // }elseif(empty($freeforAllShift)){
           //      $available=$availableUserForAShift;
           // }else{
           //      $available=$freeforAllShift;
           // }
              if(!empty($availableUserForAShift)){
                $available=$availableUserForAShift;
              }

            // debug($available);
           if(!empty($available)){
                foreach($available as $userid){
                    $result = $Users->userDetail($userid);
                    if(!empty($result)){
                      $output[$result['User']['id']]['name']=ucwords($result['User']['fname']." ".$result['User']['lname']);
                      $output[$result['User']['id']]['user_id']=$result['User']['id'];
                    }
               }
               
           } else {

              $output = 'User not Found';
           }
           return $output;
           //debug($output);

  }

	  public function compareTime($assigned_start,$assigned_end,$shift_start,$shift_end){
        
        $one_day = 24 * 60 * 60;
        $assigned_start = $this->convert($assigned_start);
        $assigned_end = $this->convert($assigned_end);
         
        if ($assigned_end < $assigned_start) {
            $assigned_end += $one_day;
        }
         
        $shift_start = $this->convert($shift_start);
        $shift_end = $this->convert($shift_end);
         
        if ($shift_end < $shift_start) {
            $shift_end += $one_day;
        }

        if(($shift_end >= $assigned_start && $shift_end <= $assigned_end) || ($shift_start >= $assigned_start && $shift_start <= $assigned_end )){
            return false;
        }else{
            return true;
        }

    }   

    public function findDurationIfNotAvailable($userId,$shift_date){
      $shiftDate = DateTime::createFromFormat('Y-m-d',$shift_date);
      $dayId = $shiftDate->format('w')+1;      
      $shiftUser = ClassRegistry::init('ShiftUser');

      $condition = ['ShiftUser.shift_date'=>$shift_date,'ShiftUser.user_id'=>$userId,'ShiftUser.status'=>3];
      
      if($shiftUser->hasAny($condition)){
        $result = $shiftUser->find('first',array(
            'conditions'=>$condition
          ));
        $results['Useravailability']['starttime'] = $result['Shift']['starttime'];
        $results['Useravailability']['endtime'] = $result['Shift']['endtime'];

      } else {

        $results = $this->find('first',array(
          'conditions'=>array(
            'Useravailability.user_id'=>$userId,'Useravailability.day_id'=>$dayId),
          'fields'=>array('Useravailability.starttime','Useravailability.endtime')
          )
        );
      }

      
      return $results;
    }

    public function checkToConfirm($userId,$shiftId,$shiftDate){
        $shiftUser = ClassRegistry::init('ShiftUser');

        $rule = array('ShiftUser.user_id'=>$userId,'ShiftUser.shift_Date'=>$shiftDate,'ShiftUser.status'=>3);
        
        $shift = ClassRegistry::init("Shift");
       
        $status = 1;
        if($shiftUser->hasAny($rule)){
//debug('enter');
          $shifts = $shift->find('first',array('conditions'=>array('Shift.id' => $shiftId )));
          //debug($shifts);
          $starttime_shift = $shifts['Shift']['starttime']; 
          $endtime_shift = $shifts['Shift']['endtime']; 

          $shiftUsers = $shiftUser->find('all',array(
              'conditions'=>$rule
            ));

          foreach($shiftUsers as $user){
           //debug($starttime_shift.' '.$endtime_shift.' '.$user['Shift']['starttime'].' '.$user['Shift']['endtime']);
            $check = $this->compareTime($starttime_shift,$endtime_shift,$user['Shift']['starttime'],$user['Shift']['endtime']);
            //debug($check);
            if($check == true){
              $status = 1;
            } else {              
              $status = 0;
              break;
            }
          }
          //debug($status);
        }
        return $status;    
    }


     public function convert($t)
    {
        list ($h, $m, $s) = explode(':', $t);
        return $s + 60 * ($m + 60 * $h);
    }
	}