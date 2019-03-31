<?php
App::uses('AppController', 'Controller');

class ShiftplansController extends AppController {
 /**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator', 'RequestHandler');
    
    public function beforeFilter() {
            parent::beforeFilter();
        }
        
        
    /**
     * ShiftplansController::savePlan()
     * 
     * @return void
     */
    public function savePlan(){
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
            $this->Shiftplan->create();
            $this->Shiftplan->data['Shiftplan']['status']='0';
            $this->request->data['Shiftplan']['created_date'] = date('Y-m-d');

            if($this->Shiftplan->saveAll($this->request->data)){
                $output['id'] = $this->Shiftplan->id;
                $output['date'] = date('Y-m-d');
                $output['status']=1;
            }else{
                $output['status']=0;
            }
            $this->set(array(
                'output'=>$output,
                '_serialize'=>array('output') 
            ));
        }
    }
    
    /**
     * ShiftplansController::editPlan()
     * 
     * @return void
     */
    public function editPlan(){
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
            $this->Shiftplan->data['Shiftplan']['status']='0';
            $this->Shiftplan->data['Shiftplan']['id']=$this->request->data['Shiftplan']['id'];
            if($this->Shiftplan->saveAll($this->request->data)){
                $message="Successfully edited shift plan.";
            }else{
                $message="Shift plan not edited.";
            }
            $this->set(array(
                'message'=>$message,
                '_serialize'=>array('message') 
            ));
        }
    }
    
    /**
     * ShiftplansController::deletePlan()
     * 
     * @return void
     */
    public function deletePlan(){
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
            $this->Shiftplan->data['Shiftplan']['id']=$this->request->data['Shiftplan']['id'];
            if($this->Shiftplan->save($this->request->data)){
                $output['status'] = 1;
            }else{
                $output['status']= 0;
            }
            $this->set(array(
                'output'=>$output,
                '_serialize'=>array('output') 
            ));
        }
    }
    

    public function getPlans($orgId=null){     
    $result = $this->Shiftplan->getPlans($orgId);
    //debug($result);

       $this->set(array(
        'result' => $result,
        '_serialize' => 'result',
        '_jsonp'=> 'true'
        ));
   }

    /**
     * ShiftplansController::getPlans()
     * 
     * @param int $orgId
     * @return void
     */
    // public function getPlans($orgId=null){
    //     $res=$this->Shiftplan->getPlans($orgId);
    //     $this->set(array(
    //         'allPlans'=>$res,
    //         '_serialize'=>array('allPlans')

    //     ));

    // }
    
    /**
     * ShiftplansController::getAPlan()
     * 
     * @param mixed $planId
     * @return void
     */
    public function getAPlan($planId){
        $res=$this->Shiftplan->getAplan($planId);
            $startdate1=new DateTime();
            $datastartdate=DateTime::createFromFormat('Y-m-d', $res['Shiftplan']['start_date']);
            $dataenddate=DateTime::createFromFormat('Y-m-d', $res['Shiftplan']['end_date']);       
            $startdate=$startdate1->diff($datastartdate);
            $enddate=$startdate1->diff($dataenddate);        
            $res['time']['startdate']=$startdate->format('%R%ad');
            $res['time']['enddate']=$enddate->format('%R%ad');
        
        $this->set(array(
            'aPlans'=>$res,
            '_serialize'=>array('aPlans')
        ));
    }

    /**
     * ShiftplansController::getOpenPlans()
     * 
     * @param mixed $orgID
     * @return void
     */
    public function getOpenPlans($orgID){
        $data=$this->Shiftplan->getOpenPlan($orgID);
        $this->set(array(
            'openPlans'=>$data,
            '_serialize'=>array('openPlans')
            ));
    }
    
    /**
     * ShiftplansController::getOrgOpenPlans()
     * 
     * @param mixed $orgID
     * @return void
     */
    public function getOrgOpenPlans($orgID){
        $data=$this->Shiftplan->getOrgOpenPlan($orgID);
        $this->set(array(
            'orgOpenPlans'=>$data,
            '_serialize'=>array('orgOpenPlans')
            ));
    }
    
    /**
     * ShiftplansController::getClosedPlans()
     * 
     * @param mixed $orgId
     * @param mixed $userId
     * @return void
     */
    public function getClosedPlans($orgId,$userId){
        $this->loadModel('ShiftplanUser');
        $datas=$this->ShiftplanUser->getAClosedPlan($orgId,$userId);
        $this->set(array(
        'closedPlans'=>$datas,
        '_serialize'=>array('closedPlans')
        ));
    }
    
    /**
     * ShiftplansController::getOrgClosedPlans()
     * 
     * @param mixed $orgId
     * @param mixed $userId
     * @return void
     */
    public function getOrgClosedPlans($orgId,$userId){
        $this->loadModel('ShiftplanUser');
        $datas=$this->ShiftplanUser->getClosedPlans($orgId,$userId);
        $this->set(array(
        'closedPlans'=>$datas,
        '_serialize'=>array('closedPlans')
        ));
    }

    public function autoAssign($planId = null){
        $output = $this->Shiftplan->autoAssign($planId);
        $this->set(array(
                'output'=>$output,
                '_serialize'=>'output'
            ));
    }
}  