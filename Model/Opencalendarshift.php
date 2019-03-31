<?php
App::uses('AppModel', 'Model');
/**
 * Opencalendarshift Model
 *
 * @property Organization $Organization
 * @property Board $Board
 * @property Shift $Shift
 */
class Opencalendarshift extends AppModel {

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
		'shift_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'noemployee' => array(
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
    
    public function saveOpenShift($orgId,$boardId,$shiftId,$shiftDate,$noEmp){
        $data['Opencalendarshift']['organization_id']=$orgId;
        $data['Opencalendarshift']['board_id']=$boardId;
        $data['Opencalendarshift']['shift_id']=$shiftId;
        $data['Opencalendarshift']['shift_date']=$shiftDate;
        $data['Opencalendarshift']['noemployee']=$noEmp;
        $result = array();
        if($this->save($data)){

            $cId = $this->id;

            $result = $this->find('first',array(
                            'conditions'=>array(
                                'Opencalendarshift.organization_id'=>$orgId,
                                'Opencalendarshift.noemployee >'=>0,
                                'Opencalendarshift.id'=>$cId,   
                            ),
                        ));

            $shiftUser = array();

            $shiftUser['start']=$result['Opencalendarshift']['shift_date']."T".$result['Shift']['starttime'];
            $shiftUser['end']=$result['Opencalendarshift']['shift_date']."T".$result['Shift']['endtime'];
            $shiftUser['Shift']['id']=$result['Shift']['id'];
            $shiftUser['Shift']['title']=$result['Shift']['title'];
            $shiftUser['Board']['id']=$result['Board']['id'];
            $shiftUser['Board']['title']=$result['Board']['title'];
            $shiftUser['openCShiftId']=$result['Opencalendarshift']['id'];
            $shiftUser['openCShiftcount']=$result['Opencalendarshift']['noemployee'];
            $shiftUser['assignedcount']=$result['Opencalendarshift']['assignedEmployee'];

            $data['result'] = $shiftUser;
            $data['status'] = 1;
        }else{

            $data['status'] = 0;
        }

        return $data;
    }
    
    public function showOpenCalendarShift($orgId,$boardId){
        $results = $this->find('all',array(
            'conditions'=>array(
                'Opencalendarshift.organization_id'=>$orgId,
                'Opencalendarshift.board_id'=>$boardId,
                'Opencalendarshift.noemployee >'=>0,    
            ),
        ));
        $count=0;
            if(isset($results) && !empty($results)){
                foreach($results as $result){
                    $shiftUser[$count]['start']=$result['Opencalendarshift']['shift_date']."T".$result['Shift']['starttime'];
                    $shiftUser[$count]['end']=$result['Opencalendarshift']['shift_date']."T".$result['Shift']['endtime'];
                    $shiftUser[$count]['Shift']['id']=$result['Shift']['id'];
                    $shiftUser[$count]['Shift']['title']=$result['Shift']['title'];
                    $shiftUser[$count]['openCShiftId']=$result['Opencalendarshift']['id'];
                    $shiftUser[$count]['openCShiftcount']=$result['Opencalendarshift']['noemployee'];
                    $count++;
                }
            }else{
                $shiftUser = array();
            }
            return $shiftUser;
    }
    
    public function showOrgOpenCalendarShift($orgId){
        $results = $this->find('all',array(
            'conditions'=>array(
                'Opencalendarshift.organization_id'=>$orgId,
                'Opencalendarshift.noemployee >'=>0,    
            ),
        ));
        $count=0;
            if(isset($results) && !empty($results)){
                foreach($results as $result){
                    $shiftUser[$count]['start']=$result['Opencalendarshift']['shift_date']."T".$result['Shift']['starttime'];
                    $shiftUser[$count]['end']=$result['Opencalendarshift']['shift_date']."T".$result['Shift']['endtime'];
                    $shiftUser[$count]['Shift']['id']=$result['Shift']['id'];
                    $shiftUser[$count]['Shift']['title']=$result['Shift']['title'];
                    $shiftUser[$count]['Board']['id']=$result['Board']['id'];
                    $shiftUser[$count]['Board']['title']=$result['Board']['title'];
                    $shiftUser[$count]['openCShiftId']=$result['Opencalendarshift']['id'];
                    $shiftUser[$count]['openCShiftcount']=$result['Opencalendarshift']['noemployee'];
                    $shiftUser[$count]['assignedcount']=$result['Opencalendarshift']['assignedEmployee'];
                    $count++;
                }
            }else{
                $shiftUser = array();
            }
            return $shiftUser;
    }
    
    public function openScheduleForCalenders($userId){
        $results = $this->find('all',array(
            'conditions'=>array('Opencalendarshift.noemployee >'=>0,'Opencalendarshift.shift_date >='=>date("Y-m-d")),
        ));
        $user = ClassRegistry::init("User");
        $relation = $user->loginUserRelationToOther($userId);
        if(isset($relation['BoardUser']) && !empty($relation['BoardUser'])){
            foreach($relation['BoardUser'] as $rln){
                $org[$rln['Board']['id']]=$rln['Board']['id'];
            }
        }
        $count=0;
        foreach($results as $result){
            foreach($org as $org1){
                if($result['Opencalendarshift']['board_id'] == $org1){
                    $mySch[$count]['title']=$result['Shift']['title'];
                    $mySch[$count]['start']=$result['Opencalendarshift']['shift_date']."T".$result['Shift']['starttime'];
                    $mySch[$count]['end']=$result['Opencalendarshift']['shift_date']."T".$result['Shift']['endtime'];
                    $mySch[$count]['org']['id']=$result['Organization']['id'];
                    $mySch[$count]['org']['title']=$result['Organization']['title'];
                    $mySch[$count]['org']['img_dir']=$result['Organization']['logo_dir'];
                    $mySch[$count]['org']['img']=$result['Organization']['logo'];
                    $mySch[$count]['status']= 0;  
                    $mySch[$count]['openCalId']=$result['Opencalendarshift']['id'];
                    $count++;
                }
            }
        }
        return $mySch;
    }
    
    public function UserResponseFromCalender($id,$userId){
        $shiftUSers = ClassRegistry::init("ShiftUser");
        $result = $this->find("first",array('conditions'=>array('Opencalendarshift.id'=>$id)));
        
        $data['ShiftUser']['organization_id']=$result['Opencalendarshift']['organization_id'];
        $data['ShiftUser']['board_id']=$result['Opencalendarshift']['board_id'];
        $data['ShiftUser']['shift_id']=$result['Opencalendarshift']['shift_id'];
        $data['ShiftUser']['user_id']=$userId;
        $data['ShiftUser']['shift_date']=$result['Opencalendarshift']['shift_date'];
        $data['ShiftUser']['status']=2;
        $data['ShiftUser']['created']=date("Y-m-d");
        
        $data1['Opencalendarshift']['noemployee'] = ($result['Opencalendarshift']['noemployee'] -1);
        $data1['Opencalendarshift']['assignedEmployee'] = ($result['Opencalendarshift']['assignedEmployee'] +1);
        $this->id=$id;
        if($shiftUSers->save($data)){
            if($this->save($data1)){
                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }
    
    public function updateOpenShift($id,$shiftId,$noEmp){
        $this->id=$id;
        $data['Opencalendarshift']['shift_id']=$shiftId;
        $data['Opencalendarshift']['noemployee']=$noEmp;
        if($this->save($data)){
            return 1;
        }else{
            return 0;
        }
    }
    public function updateOpenShift1($id,$boardId,$shiftId,$noEmp){
        $this->id=$id;
        $data['Opencalendarshift']['shift_id']=$shiftId;
        $data['Opencalendarshift']['board_id']=$boardId;
        $data['Opencalendarshift']['noemployee']=$noEmp;
        if($this->save($data)){
            return 1;
        }else{
            return 0;
        }
    }

    public function getOpenShiftOfBoard($boardId = null){
        $results = $this->find('all',array(
            'conditions'=>array(
                'Opencalendarshift.board_id'=>$boardId,
                'Opencalendarshift.noemployee >'=>0,    
            ),
        ));
        $count=0;
            if(isset($results) && !empty($results)){
                foreach($results as $result){
                    $shiftUser[$count]['orgId']=$result['Organization']['id'];
                    $shiftUser[$count]['orgTitle']=$result['Organization']['title'];
                    $shiftUser[$count]['orgDir']=$result['Organization']['logo_dir'];
                    $shiftUser[$count]['orgImage']=$result['Organization']['logo'];

                    $shiftUser[$count]['start']=$result['Opencalendarshift']['shift_date']."T".$result['Shift']['starttime'];
                    $shiftUser[$count]['end']=$result['Opencalendarshift']['shift_date']."T".$result['Shift']['endtime'];
                    $shiftUser[$count]['Shift']['id']=$result['Shift']['id'];
                    $shiftUser[$count]['Shift']['title']=$result['Shift']['title'];
                    $shiftUser[$count]['openCShiftId']=$result['Opencalendarshift']['id'];
                    $shiftUser[$count]['openCShiftcount']=$result['Opencalendarshift']['noemployee'];
                    $count++;
                }
            }else{
                $shiftUser = array();
            }
            return $shiftUser;
    }

    public function userResponseToShift($id,$userId){
        $shiftUSers = ClassRegistry::init("ShiftUser");
        $result = $this->find("first",array('conditions'=>array('Opencalendarshift.id'=>$id)));
        
        $data['ShiftUser']['organization_id']=$result['Opencalendarshift']['organization_id'];
        $data['ShiftUser']['board_id']=$result['Opencalendarshift']['board_id'];
        $data['ShiftUser']['shift_id']=$result['Opencalendarshift']['shift_id'];
        $data['ShiftUser']['user_id']=$userId;
        $data['ShiftUser']['shift_date']=$result['Opencalendarshift']['shift_date'];
        $data['ShiftUser']['status']=3;
        $data['ShiftUser']['created']=date("Y-m-d");
        $data['ShiftUser']['opencalendarshift_id']=$id;
        
        
        $data1['Opencalendarshift']['noemployee'] = ($result['Opencalendarshift']['noemployee'] -1);
        $data1['Opencalendarshift']['assignedEmployee'] = ($result['Opencalendarshift']['assignedEmployee'] +1);
        $this->id=$id;
        if($shiftUSers->save($data)){
            if($this->save($data1)){
                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }
}
