<?php
App::uses('AppModel', 'Model');
/**
 * Shiftplan Model
 *
 * @property User $User
 * @property Organization $Organization
 * @property Board $Board
 * @property Shift $Shift
 * @property ShiftplanUser $ShiftplanUser
 * @property Shiftplangroup $Shiftplangroup
 */
class Shiftplan extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'id' => array(
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
				//'allowEmpty' => false,`
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
		'title' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'no_of_employer' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'start_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'end_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'documenttype' => array(
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Organization' => array(
			'className' => 'Organization',
			'foreignKey' => 'organization_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
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
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ShiftplanUser' => array(
			'className' => 'ShiftplanUser',
			'foreignKey' => 'shiftplan_id',
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
		'Shiftplangroup' => array(
			'className' => 'Shiftplangroup',
			'foreignKey' => 'shiftplan_id',
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


// 	 public function getPlans($orgId){
// 	 	// debug($orgId);die();
//         $this->Behaviors->load('Containable');
//        	$UserGroups = ClassRegistry::init("UserGroup");
//        	$Useravailability = ClassRegistry::init("Useravailability");
//        	$res = $this->find('all',array('contain'=>array('User','Organization','Board','Shift','ShiftplanUser','Shiftplangroup','Shiftplangroup.Group','ShiftplanUser.ShiftUser','ShiftplanUser.ShiftUser.User'),'conditions'=>array('Shiftplan.organization_id'=>$orgId,'Shiftplan.status'=>'0'),'order'=>array('Shiftplan.created_date DESC')));
//        	$Users = ClassRegistry::init("User");
//        	$ShiftUsers = ClassRegistry::init("ShiftUser");
//        	$ShiftplanUsers = ClassRegistry::init("ShiftplanUser");
       
//         $count2 = array();
//         $reqData=array();
       
//         $count = 0;

//         foreach($res as $result){

//             $begin = new DateTime( $result['Shiftplan']['start_date'] );
// 			$end = new DateTime( $result['Shiftplan']['end_date'] );

// 			$interval = DateInterval::createFromDateString('1 day');
// 			$period = new DatePeriod($begin, $interval, $end->add($interval));

// 			$count9=0;
// 			foreach ( $period as $dt ) {
//             $reqData[$count]['id']= $result['Shiftplan']['id'];
//             $reqData[$count]['title']= $result['Shiftplan']['title'];
//             $reqData[$count]['board']=$result['Board']['title'];
//             $reqData[$count]['boardId']=$result['Board']['id'];
//             $reqData[$count]['documenttype']=$result['Shiftplan']['documenttype'];
//             $reqData[$count]['shift']=$result['Shift']['title'];
//             $reqData[$count]['shiftId']=$result['Shift']['id'];
//             $reqData[$count]['duration']=$result['Shiftplan']['start_date']." to ".$result['Shiftplan']['end_date'];
//             $reqData[$count]['start_date']=$result['Shiftplan']['start_date'];
//             $reqData[$count]['end_date']=$result['Shiftplan']['end_date'];
//             $reqData[$count]['employee_no']=$result['Shiftplan']['no_of_employer'];
//             $reqData[$count]['created']=$result['Shiftplan']['created_date'];
//             $shiftId = $result['Shift']['id'];
//             $boardId = $result['Board']['id'];
// 			$shift_date = $dt->format( "Y-m-d");


// 			$ShiftplanUser1 = $ShiftplanUsers->getShiftPlanUser($result['Shiftplan']['id'],$shift_date);
// 			//$ShiftplanUser1 = $ShiftplanUsers->getShiftPlanUser(18,'2016-01-29');
		    
// 		    if($ShiftplanUser1){
// 				 $reqData[$count]['ShiftplanUser'][] = $ShiftplanUser1;
// 			}

// 			$available = $Useravailability->listAllAvailableUser($shiftId,$boardId,$shift_date);
//             $user_found = 0;
//             if($available!='User not Found'){
// 	            foreach($available as $av){  
// 	            	$user_found++;
// 	            }
//         	}
  				
//   			//$req = $this->shiftPlanGroup($result['Shiftplangroup'],$UserGroups,$available,$count,$count9,$shift_date);

//   			//debug($req);
//           foreach($result['Shiftplangroup'] as $Shiftplangroup){
//         	$employeeInGroup=array();
//         	$employeeInGroup[$count][$count9] = $UserGroups->findAllUserOfGroup($Shiftplangroup['Group']['id']);
// 			$uid=array();
// 			$uid2=array();
//             if($available!='User not Found'){
// 				foreach($available as $k=>$v){
// 					$uid[$k]=$k;
// 				}
// 			}
// 					foreach($employeeInGroup as $k1=>$emp){
// 						foreach($emp as $k2=>$emp1){
// 							foreach($emp1 as $emp2){
// 								$uid2[$emp2['UserGroup']['user_id']]=$emp2['UserGroup']['user_id'];
// 							}
// 						}
						
						
// 					}

// 				$reqData[$count]['group'][$count9]['group'][$Shiftplangroup['Group']['id']]['UserGroup'][] = array_intersect($uid,$uid2);
//   				$reqData[$count]['group'][$count9]['date']=$shift_date;
//   				$reqData[$count]['group'][$count9]['group'][$Shiftplangroup['Group']['id']]['shiftplangroup_id']=$Shiftplangroup['id'];
// 				$reqData[$count]['group'][$count9]['group'][$Shiftplangroup['Group']['id']]['group_id']=$Shiftplangroup['Group']['id'];
// 				$reqData[$count]['group'][$count9]['group'][$Shiftplangroup['Group']['id']]['group_name']=$Shiftplangroup['Group']['title'];
//             }  
// 			foreach($reqData as $res){
// 				//debug($res);
// 				// debug('-----');

// 			    if($res['group']){
// 			        foreach($res['group'] as $group1){

// 			        	 $ree = array();
// 			        	 $count90=0;
// 			        	foreach($group1['group'] as $group){
// 			            if(isset($group['UserGroup'])){
// 			                foreach($group['UserGroup'] as $grp){
// 			                	if($grp){
// 			                	foreach($grp as $v){
// 			                			if($v){
// 			                				$ree[$count90][$v]['id']=$v;

// 			                				$usr = $Users->userDetail($v);
// 			                				//debug($usr);
// 			                				$ree[$count90][$v]['fname']=$usr['User']['fname'];
// 			                				$ree[$count90][$v]['lname']=$usr['User']['lname'];
			                			
// 			                			} 
// 			                		}
// 			                	}
// 			                }
// 			            }
// 			            $count2[$count][$count9]=$ree;
// 			            $count90++;
// 			        }
// 			    }
			  
// 			    }
// 			}
// 			$rand_num[$count][$count9] = $result['Shiftplan']['no_of_employer'];
// 			$usr_found[$count][$count9] = $user_found;
// 			$count9++;  	
// 	}

// 	$count++;
// }
// 		if($count2){
//         	foreach($count2 as $k=>$count1){
//         		if($count1){
// 	        		foreach($count1 as $k1=>$countx){
// 	        			foreach($countx as $count4){
// 	        				foreach($count4 as $count3){
// 	        			if($count3){
// 	        				$reqData[$k]['group'][$k1]['User_det'][$count3['id']]['id']=$count3['id'];
// 							$reqData[$k]['group'][$k1]['User_det'][$count3['id']]['fname']=$count3['fname'];
// 							$reqData[$k]['group'][$k1]['User_det'][$count3['id']]['lname']=$count3['lname'];
// 	        			}
// 	        		}
	        			
// 	        		}
// 	        		//debug($usr_found[$k][$k1].'_'.$rand_num[$k][$k1]);die();

// 					if($usr_found[$k][$k1]>=$rand_num[$k][$k1]){
// 		        		$kx = array();
// 		        		if(isset($reqData[$k]['group'][$k1]['User_det']) && count($reqData[$k]['group'][$k1]['User_det'])>=$rand_num[$k][$k1]){
// 		        		$kx1 = array_rand($reqData[$k]['group'][$k1]['User_det'],$rand_num[$k][$k1]);

// 		        		if($rand_num[$k][$k1] == 1){
// 		        			$kx[]=$kx1;
// 		        		} else{
// 		        			$kx = $kx1;
// 		        		}
// 		        		foreach($kx as $key){

// 		        			$reqData[$k]['group'][$k1]['User_rand'][$key] = $reqData[$k]['group'][$k1]['User_det'][$key];
// 		        		}
// 	        			}else{
// 	        				$reqData[$k]['group'][$k1]['User_rand']= 'Not enough User';
// 	        			}
// 	        		} 
// 	        		else {
// 	        			$reqData[$k]['group'][$k1]['User_rand']= 'Not enough User';
// 	        			}
// 				}
// 			}
// 		}
// 	}
//      return $reqData;

//     }


    public function getAplan($planId){
        return $this->find('first',array('conditions'=>array('Shiftplan.id'=>$planId)));
    }

    public function getOpenPlan($orgID){
    	 $this->Behaviors->load('Containable');
        return $this->find('first',array('contain'=>array('User','Organization','Board','Shift','ShiftplanUser','ShiftplanUser.ShiftUser','ShiftplanUser.ShiftUser.User'),'conditions'=>array('Shiftplan.organization_id'=>$orgID,'Shiftplan.documenttype'=>'1','Shiftplan.status'=>'0','Shiftplan.end_date >='=>date('Y-m-d')),'order'=>array('Shiftplan.created_date DESC')));
    }

    public function getOrgOpenPlan($orgID){
        $this->Behaviors->load('Containable');
        return $this->find('all',array('contain'=>array('User','Organization','Board','Shift','ShiftplanUser','ShiftplanUser.ShiftUser','ShiftplanUser.ShiftUser.User'),'conditions'=>array('Shiftplan.organization_id'=>$orgID,'Shiftplan.documenttype'=>'1','Shiftplan.status'=>'0','Shiftplan.end_date >='=>date('Y-m-d')),'order'=>array('Shiftplan.created_date DESC')));
    }

        public function getPlans($orgId){
    	$this->Behaviors->load('Containable');
       	$res = $this->find('all',array('contain'=>array('User','Organization','Board','Shift','ShiftplanUser','Shiftplangroup','Shiftplangroup.Group','Organization.Group','ShiftplanUser.ShiftUser','ShiftplanUser.ShiftUser.User'),'conditions'=>array('Shiftplan.organization_id'=>$orgId,'Shiftplan.status'=>'0'),'order'=>array('Shiftplan.created_date DESC')));
       	//debug($res);
       	$count = 0;
       	$reqData = array();
        foreach($res as $result){
        	//debug($result);
            $reqData[$count]['id']= $result['Shiftplan']['id'];
            $reqData[$count]['title']= $result['Shiftplan']['title'];
            $reqData[$count]['board']=$result['Board']['title'];
            $reqData[$count]['boardId']=$result['Board']['id'];
            $reqData[$count]['documenttype']=$result['Shiftplan']['documenttype'];
            $reqData[$count]['shift']=$result['Shift']['title'];
            $reqData[$count]['shiftId']=$result['Shift']['id'];
            $reqData[$count]['duration']=$result['Shiftplan']['start_date']." to ".$result['Shiftplan']['end_date'];
            $reqData[$count]['start_date']=$result['Shiftplan']['start_date'];
            $reqData[$count]['end_date']=$result['Shiftplan']['end_date'];
            $reqData[$count]['employee_no']=$result['Shiftplan']['no_of_employer'];
            $reqData[$count]['created']=$result['Shiftplan']['created_date'];
            $reqData[$count]['group'] = $result['Shiftplangroup'];
            if(!empty($result['ShiftplanUser'])){
            	$reqData[$count]['ShiftplanUser'] = 1;
            } else {
            	$reqData[$count]['ShiftplanUser'] = 0;
            }
            $count++; 
    	}
    	//debug($reqData);
    	return $reqData;

	}

    public function autoAssign($planId){
	   	$Useravailability = ClassRegistry::init("Useravailability");
	   	$result = $this->findPlanById($planId);
	   	if(!empty($result)){
	   	
		   	$shiftDates = array();
		   	$i = 0;
		   	if(!empty($result['ShiftplanUser'])){
			   	foreach($result['ShiftplanUser'] as $r){
			   		$shiftDates[$i] = $r['shift_date'];
			   		$i++;
			   	}
		   	}

		    $begin = new DateTime( $result['Shiftplan']['start_date'] );
			$end = new DateTime( $result['Shiftplan']['end_date'] );
			$employeeNo = $result['Shiftplan']['no_of_employer'];

			$shiftId = $result['Shiftplan']['shift_id'];
			$boardId = $result['Shiftplan']['board_id'];
			

			$interval = DateInterval::createFromDateString('1 day');
			$period = new DatePeriod($begin, $interval, $end->add($interval));		

			$groupUser = $this->groupUser($result['Shiftplangroup']);
			//debug($groupUser);

			$randomUsers = array();

			foreach ( $period as $dt ) {
				$shift_date = $dt->format( "Y-m-d");
				//if(!empty($result['ShiftplanUser'])){
					if(!in_array($shift_date, $shiftDates)){
					$available = $Useravailability->listAllAvailableUser($shiftId,$boardId,$shift_date);

					$user_found = 0;
			        $availableUser=array();
			        if($available!='User not Found'){
						foreach($available as $k=>$v){
							$availableUser[$user_found]=$k;
							$user_found++;
						}
					}

						$users = array();
						if($user_found >= $employeeNo && count($groupUser) >= $employeeNo){
							$users = array_intersect(array_unique($groupUser), $availableUser);
							$randomUsers[$shift_date] = $this->arrayRandomAssoc($users,$employeeNo);
						}
					}
				//}
				
			}
		}	
		//debug($randomUsers);
		return $randomUsers;

	}



	public function groupUser($shiftPlanUser){
   		$UserGroups = ClassRegistry::init("UserGroup");
		$groupUser=array();
		$ct = 0;
		foreach($shiftPlanUser as $Shiftplangroup){
			$employeeInGroup = array();
	    	$employeeInGroup = $UserGroups->findAllUserOfGroup($Shiftplangroup['group_id']);

	    	
			foreach($employeeInGroup as $k1=>$emp){
				$groupUser[$ct] = $emp['UserGroup']['user_id'];
				$ct++;
			}
			
		}
		return $groupUser;
	}

	public function findPlanById($planId){
		$this->Behaviors->load('Containable');
		
		$result = $this->find('first',array('conditions'=>
    	array('Shiftplan.id'=>$planId,'Shiftplan.status'=>'0'),
    	'fields'=>array('board_id','no_of_employer','shift_id','start_date','end_date'),
    	'contain'=>array('Shiftplangroup','ShiftplanUser')
    	));
    	
    	return $result;
	}

	public function arrayRandomAssoc($arr, $num = 1) {
	    $keys = array_keys($arr);
	    shuffle($keys);
	    $r = array();
	    for ($i = 0; $i < $num; $i++) {
	    	if(isset($keys[$i])){
	        	$r[$keys[$i]] = $arr[$keys[$i]];
	    	}
	    }
	    return $r;
	}


}
