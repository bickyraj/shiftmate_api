<?php
App::uses('AppModel', 'Model');

class Leaverequest extends AppModel{
    
    public $validate = array(
		'detail' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
                'user_id'=>array(
                    'numeric' => array(
				    'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				    'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                ),
            'branch_id' => array(
                'numeric' => array(
				    'rule' => array('numeric'),
				    //'message' => 'Your custom message here',
				    'allowEmpty' => false,
				    //'required' => false,
				    //'last' => false, // Stop validation after this rule
				    //'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
        'org_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
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
        'status' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
        'startdate' => array(
			'notEmpty' => array(
				'rule' => 'date',
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
        'enddate' => array(
			'notEmpty' => array(
				'rule' => 'date',
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
//        'image' => array(
//                    'thumbnailSizes' => array(
//                    'xvga' => '1024x768',
//                    'vga' => '640x480',
//                    'thumb' => '200x138'),
//                    'rule' => 'isFileUpload',
//                    'required' => false,
//                    'message' => 'File was missing from submission'
//        )
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
                )
            )
        )
    );

     public $belongsTo = array(
		'Leavetype' => array(
			'className' => 'Leavetype',
			'foreignKey' => 'leavetype_id',
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
                'Board' => array(
			'className' => 'Board',
			'foreignKey' => 'board_id',
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
	);
 
    
    
    /**
     * myLeaveRequests method
     * @param int $user_id
     * @return array()
     **/
    public function myLeaveRequests($user_id,$startat){
        $limit=10;
        $leavecountdata['datas']=$this->find('all', array('conditions'=>array('Leaverequest.user_id'=>$user_id),'limit'=>$limit,'page'=>$startat,'order' => array('Leaverequest.requestdate DESC'),'recursive'=>0));
        $leavecountdata['counts']=$this->find('count', array('conditions'=>array('Leaverequest.user_id'=>$user_id),'order' => array('Leaverequest.requestdate DESC'),'recursive'=>0));
        $leavecountdata['limit']=$limit;
        $leavecountdata['page']=$startat;
        return $leavecountdata;
    }
    
    
    /**
     * userLeaveRequests method
     * @param int $org_id
     * @return array()
     **/
    public function userLeaveRequest($org_id,$user_id,$status){
        return $this->find('first',array('conditions'=>array('Leaverequest.organization_id'=>$org_id,'Leaverequest.user_id'=>$user_id,'Leaverequest.status'=>$status),'order' => array('Leaverequest.requestdate DESC'),'recursive'=>0));
    }
    
 public function countAcceptedLeave($orgId,$userId){
    return $this->find('count',array('conditions'=>array('Leaverequest.organization_id'=>$orgId,'Leaverequest.user_id'=>$userId,'Leaverequest.status'=>1),'recursive'=>-1));
 }
 
 
 public function distinctLeaveUser($orgId,$startat,$status){
    $limit=10;
    $leavecountdata['datas']=$this->find('all',array('conditions'=>array('Leaverequest.organization_id'=>$orgId,'Leaverequest.status'=>$status),'limit'=>$limit,'page'=>$startat,'fields' => array('DISTINCT Leaverequest.user_id')));
    $leavecountdata['counts']=$this->find('count',array('fields' =>'DISTINCT Leaverequest.user_id','conditions'=>array('Leaverequest.organization_id'=>$orgId,'Leaverequest.status'=>$status)));
    $leavecountdata['limit']=$limit;
    $leavecountdata['page']=$startat;
    return $leavecountdata;
 }
 
 public function overallInCalendar($user_id){
    $results = $this->find('all',array('conditions'=>array('Leaverequest.user_id'=>$user_id)));
    $count=0;
    $mySch=array();
    foreach($results as $result){
        $mySch[$count]['title']="Leave";
        $mySch[$count]['description']=$result['Leaverequest']['detail'];
        $mySch[$count]['start']=$result['Leaverequest']['startdate'];
        $mySch[$count]['end']=$result['Leaverequest']['enddate'];
        $mySch[$count]['org']['id']=$result['Organization']['id'];
        $mySch[$count]['org']['title']=$result['Organization']['title'];
        //$mySch[$count]['board']=$result['Board']['title'];
        $mySch[$count]['status']=$result['Leaverequest']['status'];
        $mySch[$count]['id']=$result['Leaverequest']['id'];
        $count++;
    }
    return $mySch;
 }
 
}