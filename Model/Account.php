<?php
App::uses('AppModel', 'Model');
/**
 * Account Model
 *
 * @property Organization $Organization
 * @property User $User
 * @property Shift $Shift
 */
class Account extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'account';

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
		'date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'workinghours' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'paymentfactor' => array(
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
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
     * Account::saveDate()
     * 
     * @param mixed $data
     * @return
     */
    public function saveDate($data){
        $boards = ClassRegistry::init('Board'); 
        $branch_id = $boards->getBranchId($data['Board']['id']);
        
        $orgUser = ClassRegistry::init('OrganizationUser');    
        $wage = $orgUser->getOrgUserWage($data['Organization']['id'],$data['User']['id'],$branch_id['Board']['branch_id']);   
        
        $data1['wage'] = $wage['OrganizationUser']['wage'];
        $data1['tax'] = $wage['OrganizationUser']['tax'];    
        
        $data1["organization_id"]=$data['ShiftUser']['organization_id'];
        $data1["user_id"]=$data['ShiftUser']['user_id'];
        $data1['shift_id']=$data['ShiftUser']['shift_id'];
        $date1=new DateTime();
        $data1['date']=$date1->format("Y-m-d H:i:s");

        $checkOutTime = $data['ShiftUser']['check_out_time'];
        $startDate = DateTime::createFromFormat("Y-m-d H:i:s",$data['ShiftUser']['check_in_time']);
        $day = $startDate->format("N");
        $startDate = $startDate->format("U");
        $endDate = DateTime::createFromFormat("Y-m-d H:i:s",$data['ShiftUser']['check_out_time']);
        $endDate = $endDate->format("U");
        if($endDate > $startDate){
            $difference = $endDate-$startDate;
        }else{
            $difference = $startDate-$endDate;
        }
        $data1["workedhours"]= $difference/3600;
        
        $shftStart = DateTime::createFromFormat("H:i:s",$data['Shift']['starttime']);
        $shftStart = (int)$shftStart->format("U");
        $shftEnd = DateTime::createFromFormat("H:i:s",$data['Shift']['endtime']);
        $shftEnd = (int)$shftEnd->format("U");
        $shftDiff = $shftEnd-$shftStart;
        $shftDiff1 = $shftDiff/3600;
        
        if($data1["workedhours"] < $shftDiff1){
            $data1['lesshours'] = $shftDiff1 - $data1["workedhours"];
            $data1['morehours'] = 0;
        }else{
            $data1['lesshours'] = 0;
            $data1['morehours'] = $data1["workedhours"]-$shftDiff1;
        }
        
        $multipleFactor = ClassRegistry::init('MultiplyPaymentFactor');
        $multipleFactor->Behaviors->load('Containable');
        $factors = $multipleFactor->find("all",array("contain"=>array("Multiplypaymentfactortype")));
        
        foreach($factors as $key=>$value){
            $start = DateTime::createFromFormat("Y-m-d",$value['MultiplyPaymentFactor']['implement_date']);
            $end = DateTime::createFromFormat("Y-m-d",$value['MultiplyPaymentFactor']['end_date']);
            $check = DateTime::createFromFormat("Y-m-d",$data['ShiftUser']['shift_date']) ;
 
            if($start <= $check && $check <= $end && $value['MultiplyPaymentFactor']['shift_id'] == '0' && $check->format("l") == $value['Multiplypaymentfactortype']['title'] && $data['ShiftUser']['organization_id'] == $value['Multiplypaymentfactortype']['organization_id']){ 
                $data1['paymentfactor'] = (float)$value['MultiplyPaymentFactor']['multiply_factor'];
            }elseif($start <= $check && $check <= $end && $value['MultiplyPaymentFactor']['shift_id'] == $data['ShiftUser']['shift_id'] && $value['Multiplypaymentfactortype']['title'] == "Shift" && $data['ShiftUser']['organization_id'] == $value['Multiplypaymentfactortype']['organization_id']){
                $data1['paymentfactor'] = (float)$value['MultiplyPaymentFactor']['multiply_factor'];
            }else{
                $data1['paymentfactor'] = (float)1;
            }

        }
        if(in_array($day, array(3,4,5)))
        {
            $orgId = $data['ShiftUser']['organization_id'];
            $weekEndFactor = $multipleFactor->find("first",array("conditions"=>['MultiplyPaymentFactor.organization_id'=>$orgId,'MultiplyPaymentFactor.multiplypaymentfactortype_id'=>1], "contain"=>array("Multiplypaymentfactortype")));

            if(isset($weekEndFactor) && !empty($weekEndFactor))
            {
                $data1['paymentfactor'] = (float)max($weekEndFactor['MultiplyPaymentFactor']['multiply_factor'], $data1['paymentfactor']);
            }
        }


        $url = "http://data.gov.au/api/action/datastore_search?resource_id=0f94ad45-c1b4-49de-bada-478ccd3805f0";
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);

        $publicHolidayArr = array();

        foreach ($json_data['result']['records'] as $key => $value) {

            $publicHolidayArr[] = date("Y")."-".substr($value['DTSTART'],4,2)."-".substr($value['DTSTART'],6,2);
        }

        $dateOnly1 = DateTime::createFromFormat("Y-m-d H:i:s",$data['ShiftUser']['check_in_time']);
        $dateOnly = $dateOnly1->format("Y-m-d");


        if(in_array($dateOnly, $publicHolidayArr))
        {
            $orgId = $data['ShiftUser']['organization_id'];
            $publicHolidayFactor = $multipleFactor->find("first",array("conditions"=>['MultiplyPaymentFactor.organization_id'=>$orgId,'MultiplyPaymentFactor.multiplypaymentfactortype_id'=>2], "contain"=>array("Multiplypaymentfactortype")));

            if(isset($publicHolidayFactor) && !empty($publicHolidayFactor))
            {
                $data1['paymentfactor'] = (float)max($publicHolidayFactor['MultiplyPaymentFactor']['multiply_factor'], $data1['paymentfactor']);
            }
        }

        $data1['date'] = $checkOutTime;
        $this->create();
        if($this->save($data1)){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * Account::getOrgData()
     * 
     * @param mixed $orgid
     * @return
     */
    public function getOrgUserData($orgid,$userid,$start_date,$end_date){
        if($start_date==null){
            $date = new DateTime();
            if($date->format("m") >= 7){
                $start = new DateTime($date->format("Y")."/7/1");
            }else{
                $start = new DateTime(($date->format("Y")-1)."/7/1");
            }
            $start1 = $start->format("Y-m-d H:i:s");
        }else{
            $date = new DateTime($start_date);
            $start1 = $date->format("Y-m-d H:i:s");
        }
        
        if($end_date==null){
            $date1 = new DateTime();
            $end1 = $date1->format("Y-m-d H:i:s");
        }else{
            $date1 = new DateTime($end_date);
            $end1 = $date1->format("Y-m-d H:i:s");
        }
        return $this->find("all",array(
            "conditions"=>array("Account.organization_id"=>$orgid,"Account.user_id"=>$userid,"Account.date >="=>$start1,"Account.date <="=>$end1),
            "order"=>array("Account.date"=>"Desc")
        ));
    }
    
    /**
     * Account::getUserData()
     * 
     * @param mixed $user_id
     * @return
     */
    public function getUserData($user_id){
        $date=new DateTime();
        if($date->format("m") >= 7){
            $start = new DateTime($date->format("Y")."/7/1");
        }else{
            $start = new DateTime(($date->format("Y")-1)."/7/1");
        }
        $start1 = $start->format("Y-m-d H:i:s");
        return $this->find("all",array(
        "contain"=>array("User","Organization","Shift"),
        "conditions"=>array("Account.user_id"=>$user_id,"Account.date >="=>$start1),
        'fields'=>array("Account.organization_id","Organization.title","Organization.logo","Organization.logo_dir",'SUM((Account.workedhours * Account.paymentfactor * Account.wage) - (Account.tax * Account.workedhours * Account.paymentfactor * Account.wage)) as amount'),
        "group"=>array("Account.organization_id")
        ));
    }
    
    /**
     * Account::getOrgData()
     * 
     * @param mixed $orgid
     * @return
     */
    public function getOrgOverall($orgid = null, $sDate = null, $eDate = null){
        $date=new DateTime();
        if($date->format("m") >= 7){
            $start = new DateTime($date->format("Y")."/7/1");
        }else{
            $start = new DateTime(($date->format("Y")-1)."/7/1");
        }
        $start1 = $start->format("Y-m-d H:i:s");

        if (empty($sDate))
        {
            return $this->find("all",array(
                        "contain"=>array("User","Organization","Shift"),
                        "conditions"=>array("Account.organization_id"=>$orgid,"Account.date >="=>$start1),
                        'fields'=>array("Account.user_id","User.fname","User.lname","User.image","User.image_dir",'SUM((Account.workedhours * Account.paymentfactor * Account.wage) - (Account.tax * Account.workedhours * Account.paymentfactor * Account.wage)) as amount'),
                        "group"=>array("Account.user_id")
                        ));
        }else
        {
            return $this->find("all",array(
                        "contain"=>array("User","Organization","Shift"),
                        "conditions"=>array("Account.organization_id"=>$orgid,"Account.date >="=>$sDate, "Account.date <="=>$eDate),
                        'fields'=>array("Account.user_id","User.fname","User.lname","User.image","User.image_dir",'SUM((Account.workedhours * Account.paymentfactor * Account.wage) - (Account.tax * Account.workedhours * Account.paymentfactor * Account.wage)) as amount'),
                        "group"=>array("Account.user_id")
                        ));
        }
    }

    public function getShiftHistory($orgId = null, $sDate = null, $eDate = null){
        $date=new DateTime();
        if($date->format("m") >= 7){
            $start = new DateTime($date->format("Y")."/7/1");
        }else{
            $start = new DateTime(($date->format("Y")-1)."/7/1");
        }
        $start1 = $start->format("Y-m-d H:i:s");

        if (empty($sDate))
        {
            return $this->find("all",array(
                        "contain"=>array("User","Organization","Shift"),
                        "conditions"=>array("Account.organization_id"=>$orgId,"Account.date >="=>$start1),
                        'fields'=>array("Account.user_id","User.gender","User.fname","User.lname","User.image","User.image_dir",
                            'SUM((Account.workedhours * Account.paymentfactor * Account.wage) - (Account.tax * Account.workedhours * Account.paymentfactor * Account.wage)) as amount', 'SUM(Account.workedhours) as workedhours',
                            'SUM(Account.lesshours) as lesshours', 'SUM(Account.morehours) as morehours'),
                        "group"=>array("Account.user_id")
                        ));
        }else
        {
            $sDate = new DateTime($sDate);
            $sDate = $sDate->format("Y-m-d H:i:s");
            $eDate = new DateTime($eDate);
            $eDate = $eDate->format("Y-m-d H:i:s");

            return $this->find("all",array(
                        "contain"=>array("User","Organization","Shift"),
                        "conditions"=>array("Account.organization_id"=>$orgId,"Account.date >="=>$sDate, "Account.date <="=>$eDate),
                        'fields'=>array("Account.user_id","User.gender","User.fname","User.lname","User.image","User.image_dir",
                            'SUM((Account.workedhours * Account.paymentfactor * Account.wage) - (Account.tax * Account.workedhours * Account.paymentfactor * Account.wage)) as amount', 'SUM(Account.workedhours) as workedhours',
                            'SUM(Account.lesshours) as lesshours', 'SUM(Account.morehours) as morehours'),
                        "group"=>array("Account.user_id")
                        ));
        }
    }

    public function getTotalWorkingAndOvertime($orgId = null, $sDate = null, $eDate = null)
    {
        $date=new DateTime();
        if($date->format("m") >= 7){
            $start = new DateTime($date->format("Y")."/7/1");
        }else{
            $start = new DateTime(($date->format("Y")-1)."/7/1");
        }
        $start1 = $start->format("Y-m-d H:i:s");

        if (empty($sDate)) {
            return $this->find("all",array(
                    "contain"=>false,
                    "conditions"=>array("Account.organization_id"=>$orgId,"Account.date >="=>$start1),
                    'fields'=>array('SUM(Account.workedhours) as workedhours','SUM(Account.morehours) as morehours')
                    )); 
        }
        else
        {
            $sDate = new DateTime($sDate);
            $sDate = $sDate->format("Y-m-d H:i:s");
            $eDate = new DateTime($eDate);
            $eDate = $eDate->format("Y-m-d H:i:s");

            return $this->find("all",array(
                    "contain"=>false,
                    "conditions"=>array("Account.organization_id"=>$orgId,"Account.date >="=>$sDate, "Account.date <="=>$eDate),
                    'fields'=>array('SUM(Account.workedhours) as workedhours','SUM(Account.morehours) as morehours')
                    ));  
        }
       
    }

    public function getEmpRelatedOrgHistory($orgId = null, $userId = null, $sDate = null , $eDate = null)
    {
        if (empty($sDate))
        {
            $this->virtualFields['workedhours'] = 0;
            $this->virtualFields['morehours'] = 0;
            $this->virtualFields['totalShifts'] = 0;
            $this->virtualFields['totalAmount'] = 0;
            $this->virtualFields['lesshours'] = 0;

            $options = array('conditions'=>['Account.organization_id'=>$orgId, 'Account.user_id'=>$userId], 'contain'=>false,'fields'=>['SUM(Account.workedhours) as Account__workedhours','SUM(Account.morehours) as Account__morehours','SUM((Account.workedhours * Account.paymentfactor * Account.wage)- (Account.workedhours * Account.paymentfactor * Account.wage * Account.tax)) as Account__totalAmount','Count(Account.shift_id) as Account__totalShifts','SUM(Account.lesshours) as Account__lesshours']);

            return $this->find('all', $options)[0];
        }
        else
        {
            $this->virtualFields['workedhours'] = 0;
            $this->virtualFields['morehours'] = 0;
            $this->virtualFields['totalShifts'] = 0;
            $this->virtualFields['totalAmount'] = 0;
            $this->virtualFields['lesshours'] = 0;

            $sDate = new DateTime($sDate);
            $sDate = $sDate->format("Y-m-d H:i:s");
            $eDate = new DateTime($eDate);
            $eDate = $eDate->format("Y-m-d H:i:s");

            $options = array('conditions'=>['Account.organization_id'=>$orgId, 'Account.user_id'=>$userId, 'Account.date >='=>$sDate, 'Account.date <='=>$eDate], 'contain'=>false,'fields'=>['SUM(Account.workedhours) as Account__workedhours','SUM(Account.morehours) as Account__morehours','SUM((Account.workedhours * Account.paymentfactor * Account.wage)- (Account.workedhours * Account.paymentfactor * Account.wage * Account.tax)) as Account__totalAmount','Count(Account.shift_id) as Account__totalShifts','SUM(Account.lesshours) as Account__lesshours']);

            return $this->find('all', $options)[0];
        }

    }

    public function getAllEmpRelOrgHistory( $userId = null, $sDate = null , $eDate = null )
    {
        if (empty($sDate))
        {
            $this->virtualFields['workedhours'] = 0;
            $this->virtualFields['morehours'] = 0;

            $options = array('conditions'=>['Account.user_id'=>$userId], 'contain'=>false,'fields'=>['SUM(Account.workedhours) as Account__workedhours','SUM(Account.morehours) as Account__morehours']);

            return $this->find('all', $options)[0];
        }
        else
        {
            $this->virtualFields['workedhours'] = 0;
            $this->virtualFields['morehours'] = 0;

            $sDate = new DateTime($sDate);
            $sDate = $sDate->format("Y-m-d H:i:s");
            $eDate = new DateTime($eDate);
            $eDate = $eDate->format("Y-m-d H:i:s");

            $options = array('conditions'=>['Account.user_id'=>$userId, 'Account.date >='=>$sDate, 'Account.date <='=>$eDate], 'contain'=>false,'fields'=>['SUM(Account.workedhours) as Account__workedhours','SUM(Account.morehours) as Account__morehours']);

            return $this->find('all', $options)[0];
        }

    }

    public function getPayCycle($userId = null, $orgId = null, $sDate = null, $eDate = null, $cycleType = null)
    {

            $this->virtualFields['total'] = 0;

            $d = Date('Y-m-d', strtotime('Sunday last week', time()));
            $sDate = new DateTime($d);
            $sDate = $sDate->format("Y-m-d H:i:s");

            $e = Date('Y-m-d', strtotime('Saturday this week', time()));
            $eDate = new DateTime($e);
            $eDate = $eDate->format("Y-m-d H:i:s");

        if ($orgId != null) {
            $options = array('conditions'=>['Account.organization_id'=>$orgId, 'Account.user_id'=>$userId, 'Account.date >='=>$sDate, 'Account.date <='=>$eDate], 'contain'=>false,'fields'=>['SUM((Account.workedhours * Account.paymentfactor * Account.wage)- (Account.workedhours * Account.paymentfactor * Account.wage * Account.tax)) as Account__total']);

            return $this->find('all', $options)[0];
        }
        else
        {
            $options = array('conditions'=>['Account.user_id'=>$userId, 'Account.date >='=>$sDate, 'Account.date <='=>$eDate], 'contain'=>false,'fields'=>['SUM((Account.workedhours * Account.paymentfactor * Account.wage)- (Account.workedhours * Account.paymentfactor * Account.wage * Account.tax)) as Account__total']);

            return $this->find('all', $options)[0];
        }

    }
}
