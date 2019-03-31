<?php
App::uses('AppController', 'Controller');
/**
 * Accounts Controller
 *
 * @property Account $Account
 * @property PaginatorComponent $Paginator
 */
class AccountsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
    
    /**
     * AccountsController::getOrgData()
     * 
     * @param mixed $orgid
     * @return void
     */
    public function getOrgUserData($orgid = null, $userid = null, $start=null, $end=null){
        $result = $this->Account->getOrgUserData($orgid,$userid,$start,$end);
        if(isset($result) && !empty($result)){
            foreach($result as $key=>$value){
                $date = new DateTime($value['Account']['date']);
                $result[$key]['Account']['date']=$date->format("d M Y H:i A");
            }
        }
        $this->set(array(
            'result'=>$result,
            "_serialize"=>array('result'),
            "_jsonp"=>true
        ));
    }
    
    /**
     * AccountsController::getUserData()
     * 
     * @param mixed $user_id
     * @return void
     */
    public function getUserData($user_id){
        $result = $this->Account->getUserData($user_id);
        $this->set(array(
            'result'=>$result,
            "_serialize"=>array('result'),
            "_jsonp"=>true
        ));
    }
    
    public function getOrgOverall($orgid = null, $sDate = null, $eDate = null){
        $result = $this->Account->getOrgOverall($orgid, $sDate, $eDate);
        $this->set(array(
            'result'=>$result,
            "_serialize"=>array('result'),
            "_jsonp"=>true
        ));
    }

    public function getShiftHistory($orgId = null, $sDate = null, $eDate = null)
    {

        $history = $this->Account->getShiftHistory($orgId, $sDate, $eDate);
        $status = 0;

        if(isset($history) && !empty($history))
        {
            $status = 1;
        }

        $this->set(array(
            'history'=>$history,
            'status'=>$status,
            '_serialize'=>['history', 'status'],
            '_jsonp'=>true
            ));
    }

    public function getTotalWorkingAndOvertime($orgId = null, $sDate = null, $eDate = null)
    {

        // if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
        //    {
                $total = $this->Account->getTotalWorkingAndOvertime($orgId,$sDate, $eDate);
                $status = 0;

                if(isset($total) && !empty($total))
                {
                    $status = 1;
                }

                $this->set(array(
                    'total'=>$total,
                    'status'=>$status,
                    '_serialize'=>['total', 'status'],
                    '_jsonp'=>true
                    ));
        // }
    }

    public function getEmpRelatedOrgHistory($orgId = null, $userId = null, $sDate = null, $eDate = null)
    {
        $total = $this->Account->getEmpRelatedOrgHistory($orgId, $userId, $sDate, $eDate);

        $status = 0;
        if (isset($total) && !empty($total)) {

            if (is_null($total['Account']['workedhours'])) {
                $total['Account']['workedhours'] = 0;
            }

            if (is_null($total['Account']['morehours'])) {
                $total['Account']['morehours'] = 0;
            }
            $status = 1;
        }

        $this->set(array(
            'total'=>$total,
            'status'=>$status,
            '_serialize'=>['total', 'status'],
            '_jsonp'=>true
        ));
    }

    public function getAllEmpRelOrgHistory($userId = null, $sDate = null, $eDate = null)
    {
        $total = $this->Account->getAllEmpRelOrgHistory($userId, $sDate, $eDate);

        $status = 0;
        if (isset($total) && !empty($total)) {
            $status = 1;
        }

        $this->set(array(
            'total'=>$total,
            'status'=>$status,
            '_serialize'=>['total', 'status'],
            '_jsonp'=>true
        ));
    }

    public function getPayCycle($userId = null, $orgId = null, $sDate = null, $eDate = null, $cycleType = null)
    {
        $data = $this->Account->getPayCycle($userId, $orgId, $sDate, $eDate, $cycleType);


        $status = 0;
        if (isset($data['Account']['total']) && !empty($data['Account']['total'])) {
            $status = 1;
        }

        $this->set(array(
            'PayCycle'=>$data,
            'status'=>$status,
            '_serialize'=>['PayCycle', 'status'],
            '_jsonp'=>true
        ));
    }

}
