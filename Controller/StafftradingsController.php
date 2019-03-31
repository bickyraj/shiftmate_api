<?php
App::uses('AppController', 'Controller');
/**
 * Stafftradings Controller
 *
 * @property Stafftrading $Stafftrading
 * @property PaginatorComponent $Paginator
 */
class StafftradingsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
    
    /**
     * StafftradingsController::saveNewTrading()
     * 
     * @return void
     */
    public function saveNewTrading(){
        $this->Stafftrading->create();
        if($this->Stafftrading->save($this->request->data)){
            $message="Trading request send and saved";
        }else{
            $message="Sorry! there is some error sending trading request, try again.";
        }
        $this->set(array(
            'message'=>$message,
            '_serialize'=>array('message')
        ));
    }
    
    /**
     * StafftradingsController::getOrgRequests()
     * 
     * @param mixed $orgId
     * @return void
     */
    public function getOrgRequests($orgId=null){
        $result = $this->Stafftrading->getOrgRequest($orgId);
        $this->set(array(
            'tradingList'=>$result,
            '_serialize'=>array('tradingList')
        ));
    }
    /**
     * StafftradingsController::getOrgRequests()
     * 
     * @param mixed $orgId
     * @return void
     */
    public function getUserRequests($userId=null){
        $result = $this->Stafftrading->getUserRequest($userId);
        $this->set(array(
            'tradingList'=>$result,
            '_serialize'=>array('tradingList')
        ));
    }
    
    /**
     * StafftradingsController::orgResponse()
     * 
     * @param mixed $status
     * @param mixed $tradeid
     * @return void
     */
    public function orgResponse($status=null,$tradeid=null){
        $this->loadModel('ShiftUser');
        $this->Stafftrading->id=$tradeid;
        $this->request->data['Stafftrading']['status']=$status;
        if($this->Stafftrading->save($this->request->data)){
            $message = 1;
        }else{
            $message = 0;
        }
        if($message == 1){
             if($status == 3){
                $result=$this->Stafftrading->find('first',array('conditions'=>array('Stafftrading.id'=>$tradeid)));
                $data['ShiftUser']['organization_id']=$result['Stafftrading']['organization_id'];
                $data['ShiftUser']['board_id']=$result['Stafftrading']['board_id'];
                $data['ShiftUser']['shift_id']=$result['Stafftrading']['shift_id'];
                $data['ShiftUser']['user_id']=$result['Stafftrading']['user_id'];
                $data['ShiftUser']['shift_date']=$result['Stafftrading']['shiftdate'];
                $this->ShiftUser->save($data);
            }
        }
        $this->set(array(
            'message'=>$message,
            '_serialize'=>array('message'),
            '_jsonp'=>true
        ));
    }
}
