<?php
App::uses('AppController', 'Controller');
/**
 * Shifts Controller
 *
 * @property Shift $Shifts
 * @property PaginatorComponent $Paginator
 */
class ShiftswapsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'RequestHandler');
    
    public function beforeFilter() {
            parent::beforeFilter();
            //$this->Auth->allow(array('addUserInShift'));
            
        }

	public function addSwapRequest()
	{
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
		{


			$this->Shiftswap->create();
            $rule = array(
                'Shiftswap.user_id'=>$this->request->data['Shiftswap']['user_id'],
                'Shiftswap.organization_id'=>$this->request->data['Shiftswap']['organization_id'],
                'Shiftswap.shift_id'=>$this->request->data['Shiftswap']['shift_id'],
                'Shiftswap.board_id'=>$this->request->data['Shiftswap']['board_id'],
                'Shiftswap.shiftuser_id'=>$this->request->data['Shiftswap']['shiftuser_id'],
                'Shiftswap.withshiftuserid'=>$this->request->data['Shiftswap']['withshiftuserid'],
                'Shiftswap.requested_to'=>$this->request->data['Shiftswap']['requested_to'],
                'Shiftswap.shift_date'=>$this->request->data['Shiftswap']['shift_date'],
                'Shiftswap.to_date'=>$this->request->data['Shiftswap']['to_date']
                );

            $this->request->data['Shiftswap']['requested_date'] = date('Y-m-d H:i:s');
            $this->request->data['Shiftswap']['status'] = '0';
            if(!$this->Shiftswap->hasAny($rule)){
                if ($this->Shiftswap->save($this->request->data)) {
                $output = ['status'=>1];
                } else {
                    $output = ['status'=>0];
                }
            } else {
                $output = ['status'=>2]
;            }

            
		}

		$this->set('output', $output);
		$this->set(
                    array(
                        "_serialize" => array('output')
                    )
            );
	}

	public function listSwapShifts($userId=null)
	{

		$this->Shiftswap->recursive = 0;
        $limit = 20;
        $this->paginate = array('conditions'=>['Shiftswap.user_id'=>$userId], 'limit'=>$limit);
  
        $listSwapShifts = $this->Paginator->paginate();

        // debug($listSwapShifts);die();

        $page=$this->params['paging']['Shiftswap']['pageCount'];
        $currentPage = $this->params['paging']['Shiftswap']['page'];

        if (!empty($listSwapShifts)) {
                $status = 1;
            } else {
                $status = 0;
            }

            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "listSwapShifts",
                "status" => $status,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );

         $this->set(array(
         	'output'=>$output,
         	'listSwapShifts'=>$listSwapShifts,
         	'_serialize'=>['output', 'listSwapShifts']
         	));

		
	}


    // get shift swap request according to boards

    public function getShiftSwapRequestOfBoards($userId=null, $boardIds = null)
    {
        $boardIdList = explode('_', $boardIds);
        $currentDate = date('Y-m-d');

        $this->Shiftswap->recursive = 0;
        $this->Shiftswap->Behaviors->load('Containable');

        $this->paginate = array(
                'conditions'=>['Shiftswap.board_id'=>$boardIdList, 'Shiftswap.status'=>0, 'Shiftswap.shift_date >='=>$currentDate, 'Shiftswap.to_date >='=>$currentDate],
                'contain'=>['From_User','To_User', 'Board', 'Shift']
            );

  
        $listSwapRequests = $this->Paginator->paginate();

        // debug($listSwapRequests);die();

        $page=$this->params['paging']['Shiftswap']['pageCount'];
        $currentPage = $this->params['paging']['Shiftswap']['page'];

        if (!empty($listSwapRequests)) {
                $status = 1;
            } else {
                $status = 0;
            }

            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "listSwapRequests",
                "status" => $status,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );

         $this->set(array(
            'output'=>$output,
            'listSwapRequests'=>$listSwapRequests,
            '_serialize'=>['output', 'listSwapRequests']
            ));
    }
    // end function


    // accept swap request by board manager

    public function acceptSwapRequestByManager($shiftSwapId = null)
    {
        
        $this->Shiftswap->recursive = 0;
        $this->Shiftswap->id = $shiftSwapId;

        if($this->Shiftswap->exists())
        {
            if($this->Shiftswap->save(['status'=>'1']))
            {
                $output = ['status'=>1, 'error'=>'Accepted'];
            }
            else
            {
                $output = ['status'=>0, 'error'=>'Server Error.'];
            }
        }
        else
        {
            $output = ['status'=>0, 'error'=>'Shift does not exists.'];
        }

        $this->set(array(
                'output'=>$output,
                '_serialize'=>['output'],
                '_jsonp'=>true
                ));
    }
    // end function


    // reject swap request by board manager

    public function rejectSwapRequestByManager($shiftSwapId = null)
    {
        
        $this->Shiftswap->recursive = 0;
        $this->Shiftswap->id = $shiftSwapId;

        if($this->Shiftswap->exists())
        {
            if($this->Shiftswap->save(['status'=>'3']))
            {
                $output = ['status'=>1, 'error'=>'Rejected'];
            }
            else
            {
                $output = ['status'=>0, 'error'=>'Server Error.'];
            }
        }
        else
        {
            $output = ['status'=>0, 'error'=>'Shift does not exists.'];
        }

        $this->set(array(
                'output'=>$output,
                '_serialize'=>['output'],
                '_jsonp'=>true
                ));
    }
    // end function

    public function getShiftSwapRequests($userId=null)
    {
        $currentDate = date('Y-m-d');

        $this->Shiftswap->recursive = 0;
        $this->Shiftswap->Behaviors->load('Containable');

        $this->paginate = array(
                'conditions'=>['Shiftswap.requested_to'=>$userId, 'Shiftswap.status'=>1, 'Shiftswap.shift_date >='=>$currentDate, 'Shiftswap.to_date >='=>$currentDate],
                'contain'=>['From_User','To_User', 'Board', 'Shift']
            );

  
        $listSwapRequests = $this->Paginator->paginate();

        // debug($listSwapRequests);die();

        $page=$this->params['paging']['Shiftswap']['pageCount'];
        $currentPage = $this->params['paging']['Shiftswap']['page'];

        if (!empty($listSwapRequests)) {
                $status = 1;
            } else {
                $status = 0;
            }

            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "getShiftSwapRequests",
                "status" => $status,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );

         $this->set(array(
            'output'=>$output,
            'listSwapRequests'=>$listSwapRequests,
            '_serialize'=>['output', 'listSwapRequests']
            ));
    }


    public function acceptSwapRequest($shiftSwapId = null)
    {
        $this->Shiftswap->recursive = -1;
        $this->Shiftswap->id = $shiftSwapId;


        if($this->Shiftswap->exists())
        {
            $options = array('conditions'=>['Shiftswap.id'=>$shiftSwapId]);
            if($this->Shiftswap->save(['status'=>'2']))
            {
                $shiftswapId = $this->Shiftswap->find('first',$options);

                // debug($shiftswapId);die();

                $user_id = $shiftswapId['Shiftswap']['user_id'];
                $withUser_id = $shiftswapId['Shiftswap']['requested_to'];

                $shiftUser_id = $shiftswapId['Shiftswap']['shiftuser_id'];
                $withshiftUser_id = $shiftswapId['Shiftswap']['withshiftuserid'];

                $this->loadModel('ShiftUser');
                $this->ShiftUser->recursive = -1;

                $this->ShiftUser->id = $shiftUser_id;
                $this->ShiftUser->save(['user_id'=>$withUser_id]);

                $this->ShiftUser->id = $withshiftUser_id;
                $this->ShiftUser->save(['user_id'=>$user_id]);
                // $s = $this->ShiftUser->find('first',array('conditions'=>['ShiftUser.id'=>$shiftUser_id]));
                
                $output = ['status'=>1, 'error'=>'Accepted'];
            }
            else
            {
                $output = ['status'=>0, 'error'=>'Server Error.'];
            }
        }
        else
        {
            $output = ['status'=>0, 'error'=>'Shift does not exists.'];
        }

        $this->set(array(
                'output'=>$output,
                '_serialize'=>['output'],
                '_jsonp'=>true
                ));
    }

    public function rejectSwapRequest($shiftSwapId = null)
    {
        $this->Shiftswap->recursive = 0;
        $this->Shiftswap->id = $shiftSwapId;

        if($this->Shiftswap->exists())
        {
            if($this->Shiftswap->save(['status'=>'3']))
            {
                $output = ['status'=>1, 'error'=>'Rejected'];
            }
            else
            {
                $output = ['status'=>0, 'error'=>'Server Error.'];
            }
        }
        else
        {
            $output = ['status'=>0, 'error'=>'Shift does not exists.'];
        }

        $this->set(array(
                'output'=>$output,
                '_serialize'=>['output'],
                '_jsonp'=>true
                ));
    }


    public function swapNotification($boardLists = null)
    {
        $this->Shiftswap->Behaviors->load('Containable');

        $boardList = array();
        $boardList = explode('_', $boardLists);

        $options = array('conditions'=>['Shiftswap.status'=>'0', 'Shiftswap.board_id'=>$boardList]);
        $shifts =  $this->Shiftswap->find('count', $options);

        if(isset($shifts) && !empty($shifts))
        {
            $output = array('status'=>1);
        }
        else
        {
            $output = array('status'=>0);
        }

        $this->set(array(
            'output'=>$output,
            'shifts'=>$shifts,
            '_serialize'=>['output', 'shifts']
            ));


    }

}