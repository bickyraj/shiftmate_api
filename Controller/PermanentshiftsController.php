<?php
App::uses('AppController', 'Controller');
/**
 * ShiftUsers Controller
 *
 * @property ShiftUser $ShiftUser
 * @property PaginatorComponent $Paginator
 */
class PermanentshiftsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	
	public function beforeFilter() {
            parent::beforeFilter();
			
            
        }
        
        public function priceCalculateOrgBranchesPermanent($user_id, $start_date = NULL, $end_date = NULL){
            if($end_date == NULL){
                $end_date = date('Y-m-d');
            }
            $this->loadModel('MultiplyPaymentFactor');
            $this->loadModel('Organizationfunction');
            
            // for users permanent shift list
            $perma_shifts = $this->Permanentshift->myPermanentShiftsRange($user_id, $start_date, $end_date);
            //debug($perma_shifts);
            //$dayArr = array('1'=>'Sunday', '2'=>'Monday', '3'=>'Tuesday', '4'=>'Wednesday', '5'=>'Thursday', '6'=>'Friday', '7'=>'Saturday');
           // $dayArr_rev = array('Sunday'=>'1', 'Monday'=>'2', 'Tuesday'=>'3', 'Wednesday'=>'4', 'Thursday'=>'5', 'Friday'=>'6', 'Saturday'=>'7');
           $hour_worked_sec = 0;
          // debug($perma_shifts);
           //$count = 0;
           $total_cost = 0;
           $total_worked_hour = 0;
           $org_id = 0;
           $branch_id = 0;
           foreach($perma_shifts as $perma_shift){
               foreach($perma_shift['User']['OrganizationUser'] as $orgUser){
                    $wage_rate[$orgUser['organization_id']][$orgUser['branch_id']]= $orgUser['wage'];
               }        
                       
                $org_id = $perma_shift['Board']['organization_id'];
                $branch_id = $perma_shift['Board']['branch_id'];
                // for payment Rate    
                $paymentFactorRates = $this->MultiplyPaymentFactor->paymentFactorRates($org_id, $branch_id);
            
                foreach($paymentFactorRates as $paymentFactorRate){
			$paymentFactorRateArray[$paymentFactorRate['Multiplypaymentfactortype']['title']] = $paymentFactorRate['MultiplyPaymentFactor']['multiply_factor']; 	
		}
                
                // for holiday
                $holidays = $this->Organizationfunction->holidays($org_id, $branch_id, $start_date, $end_date);
                $holiday_arr = array();
                foreach($holidays as $holiday){
			$holiday_arr[] = $holiday['Organizationfunction']['function_date'];
		}
                
                $starttime = strtotime($perma_shift['Shift']['starttime']);
                $endtime = strtotime($perma_shift['Shift']['endtime']);
                $time_diff = $endtime - $starttime;
                if($time_diff < 0){
                        $time_diff = $time_diff + 24*3600;	
                }
                $time_diff_hour = $time_diff / 3600;
                $hour_worked_sec = $hour_worked_sec + $time_diff;
                
                
               // $day_id = $perma_shift['Permanentshift']['day_id'];
                $day_name = $perma_shift['Day']['title']; //$dayArr[$day_id];
                $perma_start_date_sec = strtotime($perma_shift['Permanentshift']['start_date']);
                $perma_end_date_sec = strtotime($perma_shift['Permanentshift']['end_date']);
                for($a = 0; $a<=10000; $a++){
                    if(date('l', $perma_start_date_sec) == $day_name){
                        $day_range_arr[date('l', $perma_start_date_sec)][] = date('Y-m-d', $perma_start_date_sec);
                    }
                   $perma_start_date_sec = $perma_start_date_sec + 3600*24;
                   if($perma_start_date_sec >= $perma_end_date_sec){
                       $a = 100000;
                 }
                } 
               // debug($holidays);
                $output = array();
                $total_worked_hour = 0;
                foreach($day_range_arr[$day_name] as $day){
                    $cost = 0;
                    if($day >= $start_date && $day <= $end_date){
                        if(in_array($day, $holiday_arr)){

                            if(isset($paymentFactorRateArray['Holiday']) && !empty($paymentFactorRateArray['Holiday'])){
                                    $rate = $paymentFactorRateArray['Holiday'];
                            }else{
                                    $rate = 1;	
                            }
                           $cost = @$rate * @$time_diff_hour * @$wage_rate[$org_id][$branch_id];
                           $total_cost = $total_cost + $cost;

                        }else{
                            if(isset($paymentFactorRateArray[$day_name]) && !empty($paymentFactorRateArray[$day_name])){
                                            $rate = $paymentFactorRateArray[$day_name];

                            }else{
                                    $rate = 1;
                            }
                            $cost = @$rate * @$time_diff_hour * @$wage_rate[$org_id][$branch_id];
                            $total_cost = $total_cost + $cost;
                        }
                        $total_worked_hour = $total_worked_hour + $time_diff_hour;
                    }
                }
                 
                //$count++;
                $output['total_cost'] = @$total_cost;
                $output['hour_worked'] = @$total_worked_hour;
                //debug($output);
            }
           // debug($holiday_arr);
           // debug($paymentFactorRates);
           // debug($day_range_arr);
            //debug($perma_shifts);
           //debug($output);
            $this->set(array(
                'output'=>$output,
                '_serialize' => array('output')
            ));
        }
        
        public function myPermanentShifts($user_id = NULL){
            $perma_shift = $this->Permanentshift->myPermanentShifts($user_id);
            //debug($perma_shift);
            $this->set(array(
                'perma_shift'=>$perma_shift,
                '_serialize' => array('perma_shift')
            ));
        }
        
        public function permanentlist($board_id = NULL){
            $this->Permanentshift->Behaviors->load('Containable');
            $pList = $this->Permanentshift->find('all', array(
                'contain'=>array('Shift', 'User'),
                'conditions'=>array(
                    'Permanentshift.board_id'=>$board_id,
                    'Permanentshift.status'=> 1
                    )
                ));
            //debug($pList);
            $this->set(array(
                    'message' => $pList,
                    '_serialize' => array('message')
                 ));
        }
        
        public function myPermanentlist($user_id){
            $this->Permanentshift->Behaviors->load('Containable');
            $pList = $this->Permanentshift->find('all', array(
                'contain'=>array('Shift'),
                'conditions'=>array('Permanentshift.user_id'=>$user_id),
                ));
            
            $this->set(array(
                    'message' => $pList,
                    '_serialize' => array('message')
                 ));
        }
	
        
}
