<?php
App::uses('AppController', 'Controller');


class EmployeeshiftexpensesController extends AppController
{

	public $components = array('Paginator');

	public function add( $shiftUserId= null)
	{

			if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
			{
			 
    if(isset($_FILES['expenseSupportingImage']) && !empty($_FILES['expenseSupportingImage'])){
            $this->request->data['Employeeshiftexpense']['image']=array(
                'name'=>$_FILES['expenseSupportingImage']['name'],
                'type'=> $_FILES['expenseSupportingImage']['type'],
                'tmp_name'=> $_FILES['expenseSupportingImage']['tmp_name'],
                'error'=> $_FILES['expenseSupportingImage']['error'],
                'size'=> $_FILES['expenseSupportingImage']['size'],
                'x' =>0 ,
                'y' => 0,
                'srcW' => 100,
                'srcH' => 100
            );
        }
				$this->Employeeshiftexpense->create();

				$this->request->data['Employeeshiftexpense']['shiftuser_id'] = $shiftUserId;

				if($this->Employeeshiftexpense->save($this->request->data)){
					$output = ['status'=>1];
				}else{
					$output = ['status'=>0];
				}
				$this->set(array(
						'output'=>$output,
						'_serialize'=>array('output'),
						'_jsonp'=>true
					));
			}	
	}


	public function view($user_id=null,$orgId=null/*,$shiftUserId=null*/)
	{
		$this->Employeeshiftexpense->recursive = 2;
		$orgIdLists = explode('_', $orgId);
		$options = array('conditions'=>['ShiftUser.user_id'=>$user_id, 'ShiftUser.organization_id'=>$orgIdLists/*,'Employeeshiftexpense.shiftuser_id'=>$shiftUserId*/],
						 'contain'=>['ShiftUser.Shift','ShiftUser.Organization']);

		$employeeshiftexpenses = $this->Employeeshiftexpense->find('all', $options);

		// debug($employeeshiftexpenses);die();
		
		$this->set(array(
				'employeeshiftexpenses'=>$employeeshiftexpenses,
				'_serialize'=>['employeeshiftexpenses']
			));


	}



	public function viewUserShiftById($shiftUserId=null)
	{
		$this->Employeeshiftexpense->recursive = -1;
		
		$options = array('conditions'=>['Employeeshiftexpense.shiftuser_id'=>$shiftUserId]);

		$shiftuserexpenses = $this->Employeeshiftexpense->find('all', $options);

		// debug($employeeshiftexpenses);die();
		$shiftExpenseTotal = $this->getUserTotal($shiftUserId);
		$this->set(array(
				'shiftuserexpenses'=>$shiftuserexpenses,
				'shiftExpenseTotal'=>$shiftExpenseTotal,
				'_serialize'=>['shiftuserexpenses', 'shiftExpenseTotal']
			));
	}

	
	public function getUserTotal($shiftUserId=null){

		$this->Employeeshiftexpense->recursive = -1;
		$options = array('conditions'=>['Employeeshiftexpense.shiftuser_id'=>$shiftUserId]);

		$userWiseExpenses = $this->Employeeshiftexpense->find('all', $options);

		$totalUserShiftAmount=0;
		foreach ($userWiseExpenses as $expense) {

	                $totalUserShiftAmount = $totalUserShiftAmount + $expense['Employeeshiftexpense']['price'];
	            }

	             // debug($totalUserShiftAmount);die();

			$this->set(array(
				
				'totalUserShiftAmount'=>$totalUserShiftAmount,

					'_serialize'=>['totalUserShiftAmount']
				));

			return $totalUserShiftAmount;





	}

	public function getTotalAmount($orgId=null,$start_date=null,$end_date=null){
		
		$this->loadModel('Shift');

		if($start_date==null || $end_date==null){ //if date range Filter

			$options = array('conditions'=>['ShiftUser.organization_id'=>$orgId]);
			$expenses = $this->Employeeshiftexpense->find('all', $options);
			$totalShiftNo = $this->Shift->find('count',['conditions'=>['Shift.status'=>1,'Shift.organization_id'=>$orgId]]);//total Shift Count
		}
		else{

			$options = array('conditions'=>['ShiftUser.organization_id'=>$orgId, "STR_TO_DATE(Employeeshiftexpense.expense_on_date,'%Y-%m-%d') >=" =>$start_date,"STR_TO_DATE(Employeeshiftexpense.expense_on_date,'%Y-%m-%d') <=" =>$end_date]);
			$expenses = $this->Employeeshiftexpense->find('all', $options);
			$totalShiftNo = $this->Shift->find('count',['conditions'=>['Shift.status'=>1,'Shift.organization_id'=>$orgId]]);
		}




		$totalShiftAmount=0;
		foreach ($expenses as $expense) {

	                $totalShiftAmount = $totalShiftAmount + $expense['Employeeshiftexpense']['price'];
	            }

	            /*debug($totalShiftNo);
	            die();
*/
			$this->set(array(
				'totalShiftNo'=>$totalShiftNo,
				'totalShiftAmount'=>$totalShiftAmount,

					'_serialize'=>['totalShiftAmount','totalShiftNo']
				));




	}


	public function viewByShift($org_id=null,$shift_id=null,$start_date=null, $end_date=null)
	{

		$this->Employeeshiftexpense->Behaviors->load('Containable');
		if($start_date==null || $end_date==null){

			$options = array(
			'conditions'=>['ShiftUser.organization_id'=>$org_id, 'ShiftUser.Shift_id'=>$shift_id],
			'contain'=>['ShiftUser','ShiftUser.User']);

		}else{

			$options = array(
			'conditions'=>['ShiftUser.organization_id'=>$org_id, 'ShiftUser.Shift_id'=>$shift_id, "STR_TO_DATE(Employeeshiftexpense.expense_on_date,'%Y-%m-%d') >=" =>$start_date,"STR_TO_DATE(Employeeshiftexpense.expense_on_date,'%Y-%m-%d') <=" =>$end_date],
			'contain'=>['ShiftUser','ShiftUser.User']);

		}

		$shiftExpenses = $this->Employeeshiftexpense->find('all', $options);

		$totalShiftExpenses=0;

		foreach ($shiftExpenses as $total) {
			
			$totalShiftExpenses = $totalShiftExpenses + $total['Employeeshiftexpense']['price'];
		}


		if(isset($shiftExpenses) && !empty($shiftExpenses))
		{
			$output = ['status'=>1];
		}else
		{
			$output=['status'=>0];
		}

		$this->set(array(
			'output'=>$output,
			'totalShiftExpenses'=>$totalShiftExpenses,
			'shiftExpenses'=>$shiftExpenses,
			'_serialize'=>['output','shiftExpenses', 'totalShiftExpenses']
			));


	}



	public function getUserExpenses($orgId = null,$shift_id=null,$start_date=null,$end_date=null)
	{
		$this->Employeeshiftexpense->recursive = 1;
		$this->Employeeshiftexpense->Behaviors->load('Containable');

		if($start_date==null || $end_date==null){

		$options=array(

				'conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.shift_id'=>$shift_id],// filter by org id and shift id
				'contain'=>['ShiftUser', 'ShiftUser.User', 'ShiftUser.Employeeshiftexpense'],
				'group'=>'ShiftUser.user_id',
				'field'=>'ShiftUser.User'
			);
	}else{
			$options=array(
				'conditions'=>['ShiftUser.organization_id'=>$orgId,'ShiftUser.shift_id'=>$shift_id,"STR_TO_DATE(Employeeshiftexpense.expense_on_date,'%Y-%m-%d') >=" =>$start_date,"STR_TO_DATE(Employeeshiftexpense.expense_on_date,'%Y-%m-%d') <=" =>$end_date],// filter by org id and shift id
				'contain'=>['ShiftUser', 'ShiftUser.User', 'ShiftUser.Employeeshiftexpense'],
				'group'=>'ShiftUser.user_id',
				'field'=>'ShiftUser.User'
			);


	}

		$userExpenses = $this->Employeeshiftexpense->find('all', $options);

		$totaluserShiftExpenses=0;

		foreach($userExpenses as $userShiftExpense) {
			
			$totaluserShiftExpenses = $totaluserShiftExpenses + $userShiftExpense['Employeeshiftexpense']['price'];
		}



		if(isset($userExpenses) && !empty($userExpenses))
		{
			$output = ['status'=>1];
		}else
		{
			$output=['status'=>0];
		}

		$this->set(array(
			'output'=>$output,
			'userExpenses'=>$userExpenses,
			'totaluserShiftExpenses'=>$totaluserShiftExpenses,
			'_serialize'=>['output','userExpenses', 'totaluserShiftExpenses']
			));
	}




}