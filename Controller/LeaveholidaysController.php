<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 */


class LeaveholidaysController extends AppController {

	/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');



		public function index() {
		$this->Shift->recursive = 0;
		$this->set('leaveholidays', $this->Paginator->paginate());
	}

    public function holidayRequestForBoardManager($board_id_string = null){
        $board_id_array = explode('_', $board_id_string);
        $this->Leaveholiday->Behaviors->load('Containable');
        $leaveRequestList = $this->Leaveholiday->find('all', array(
                'contain' => array(
                        'User',
                        'Organization',
                        'Branch',
                        'Board'
                        //'Organization.User'
                    ),
                'conditions' => array(
                    'Leaveholiday.board_id' => $board_id_array
                    ),
            ));
       // debug($leaveRequestList);
       // echo $board_id_array;
        $this->set('output', $leaveRequestList);

            $this->set(
                    array(
                        "_serialize" => array('output')
                    )
            );

    }

	public function userBranches($userId, $orgId)
	{
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {


            $this->Leaveholiday->create();

            $this->request->data['Leaveholiday']['organization_id'] = $orgId;

            // $this->request->data['Leaveholiday']['status'] = 1;

            if ($this->Leaveholiday->save($this->request->data)) {
                $output = ['status'=>1];
            } else {
                $output = ['status'=>0];
            }

            $this->set('output', $output);

            $this->set(
                    array(
                        "_serialize" => array('output')
                    )
            );
        }

        else
        {
            $this->loadModel('OrganizationUser');

            $this->OrganizationUser->Behaviors->load('Containable');

            $options = array(

                'conditions'=>array(
                    'OrganizationUser.organization_id'=>$orgId,
                    'AND'=>array('OrganizationUser.user_id'=>$userId)
                    ),
                'contain'=>'Branch'

                );

            $output = $this->OrganizationUser->find('all', $options);

            $this->set('output', $output);

            $this->set(
                array(
                        "_serialize"=>array('output')
                    )

                );


        }

        
	}

    public function requestHoliday($userId)
    {
        $this->loadModel('Board');
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {

            $org_id = $this->request->data['Leaveholiday']['organization_id'];
            $branch_id = $this->request->data['Leaveholiday']['branch_id'];
            
            $checkBoardId = $this->Board->find('first', array(
                            'conditions' => array('Board.branch_id' => $branch_id)
                                ));

            

            if (isset($checkBoardId) && !empty($checkBoardId)){

                $board_option = array(
                'conditions'=>array(
                        'Board.organization_id'=>$org_id,
                        'Board.user_id'=>$userId,
                        'Board.branch_id'=>$branch_id

                        // 'AND'=>array('Board.user_id'=>$userId),
                        // 'AND'=>array('Board.branch_id'=>$branch_id)
                    ), 
                'fields'=>array('id'));


                       $board = $this->Board->find('first', $board_option);
                        $board_id = $board['Board']['id'];

                        if(empty($this->request->data['Leaveholiday']['end_date']))
                            {
                                $this->request->data['Leaveholiday']['end_date'] = '2010-1-1';
                            }

                            $this->request->data['Leaveholiday']['board_id'] =$board_id;
                            $this->request->data['Leaveholiday']['approved_date'] = '2010-1-1';
                            $this->request->data['Leaveholiday']['approved_by'] = '0';
                            $this->request->data['Leaveholiday']['status'] = '0';



                            $this->Leaveholiday->create();

                            if ($this->Leaveholiday->save($this->request->data)) {
                                $output = array('status'=>'1');
                            } else {
                                $output = array('status'=>'0');
                            }

                            $this->set('output', $output);
                            // $this->set('output', $this->request->data);

                            $this->set(
                                    array(
                                        "_serialize" => array('output')
                                    )
                            );
                    }

                    else
                    {

                        $output = array('status'=>'0',

                                        'error'=>'Sorry, no any board assigned. To send the request there must be atleast one board in the branch.');
                        $this->set('output', $output);

                            $this->set(

                            array(
                                '_serialize'=>array('output')
                                )
                            );

                    }

            
        }

    }

    public function listHolidays($userId, $orgId, $branchId)
    {
           $this->Leaveholiday->recursive = 0;
            $limit = 20;
            $this->paginate = array('conditions'=>array(
                'Leaveholiday.user_id'=>$userId,
                'Leaveholiday.organization_id'=>$orgId,
                'Leaveholiday.branch_id'=>$branchId

                ), 'limit'=>$limit);
      
            $holidays = $this->Paginator->paginate();
            $page=$this->params['paging']['Leaveholiday']['pageCount'];
            $currentPage = $this->params['paging']['Leaveholiday']['page'];

            if (!empty($holidays)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "listHolidays",
                "status" => $status,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );

            $this->set('output', $output);
            $this->set('holidays', $holidays);

            $this->set(
                    array(
                        "_serialize" => array('holidays', 'holidays')
                    )
            );
    }

    public function branchEmployeesHolidays($orgId)
    {
           $this->Leaveholiday->recursive = 0;
            $limit = 20;
            $this->paginate = array('conditions'=>array(
                'Leaveholiday.organization_id'=>$orgId

                ), 'limit'=>$limit);
      
            $holidays = $this->Paginator->paginate();
            $page=$this->params['paging']['Leaveholiday']['pageCount'];
            $currentPage = $this->params['paging']['Leaveholiday']['page'];

            if (!empty($holidays)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "listHolidays",
                "status" => $status,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );

            $this->set('output', $output);
            $this->set('holidays', $holidays);

            $this->set(
                    array(
                        "_serialize" => array('holidays', 'holidays')
                    )
            );
    }

    public function approveHoliday($id)
    {
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
        {
            $this->Leaveholiday->id = $id;

            if($this->Leaveholiday->saveField('status', 1))
            {
                $output = array(
                    "status"=>'1');

                $this->set('output', $output);

                $this->set(
                    array(
                        '_serialize'=>array('output')
                        )
                    );
            }

            else
            {
                $output = array(
                    "status"=>'0');

                $this->set('output', $output);

                $this->set(
                    array(
                        '_serialize'=>array('output')
                        )
                    );
            }
            
        }

    }

    public function rejectHoliday($id)
    {
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
        {
            $this->Leaveholiday->id = $id;

            if($this->Leaveholiday->saveField('status', 0))
            {
                $output = array(
                    "status"=>'1');

                $this->set('output', $output);

                $this->set(
                    array(
                        '_serialize'=>array('output')
                        )
                    );
            }

            else
            {
                $output = array(
                    "status"=>'0');

                $this->set('output', $output);

                $this->set(
                    array(
                        '_serialize'=>array('output')
                        )
                    );
            }
            
        }

    }

	

}