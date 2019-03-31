<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 */


class NoticeboardsController extends AppController {

	/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');



		public function index() {
		$this->Shift->recursive = 0;
		$this->set('noticeboards', $this->Paginator->paginate());
	}




    public function add($orgId)
    {


    	if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {


            $this->Noticeboard->create();

            $this->request->data['Noticeboard']['organization_id'] = $orgId;

            // $this->request->data['Noticeboard']['status'] = 1;

            if ($this->Noticeboard->save($this->request->data)) {
                $output = ['status'=>1];
            } else {
                $output = ['status'=>0];
            }
        }

        $this->set('output', $output);

        $this->set(
                    array(
                        "_serialize" => array('output')
                    )
            );
    }


    public function listNoticeboards($orgId=null,$page=1)
    {

    	   $this->Noticeboard->recursive = 0;
            $limit = 15;
            $this->paginate = array('conditions'=>array('Noticeboard.organization_id'=>$orgId), 'limit'=>$limit,"page"=>$page);
      
            $notices = $this->Paginator->paginate();
            $page=$this->params['paging']['Noticeboard']['pageCount'];
            $currentPage = $this->params['paging']['Noticeboard']['page'];

            if (!empty($notices)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "listNoticeboards",
                "pageCount" => $page,
                "status" => $status,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );

            $this->set('output', $output);
            $this->set('notices', $notices);

            $this->set(
                    array(
                        "_serialize" => array('notices', 'output')
                    )
            );
    }

    public function viewNoticeboards($id = null)
    {
        $options = array('conditions' => array('Noticeboard.' .$this->Noticeboard->primaryKey => $id));
        $notice = $this->Noticeboard->find('first', $options);
        $this->set('notice', $notice);
        $this->set(
                array(
                    "_serialize" => array('notice'),
                    "_jsonp"=>true
                )
        );

    }



    public function editNoticeboards($id = null)
    {

    	

    	if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) 
    	{

        	if ($this->Noticeboard->save($this->request->data)) {
                $output = array(
                    "params" => $this->request,
                    "method" => $this->method,
                    "action" => "editNoticeboards",
                    "status" => 1,
                    //"user"=>$this->request->data,
                    "error" => array("validation" => "Notice Updated.")
                );
            } else {
                $output = array(
                    "params" => $this->request,
                    "method" => $this->method,
                    "action" => "editNoticeboards",
                    "status" => 0,
                    //"user"=>$this->request->data,
                    "error" => array("validation" => "Notice Update Fail. Please Try Again")
                );
            }

            $this->set('output', $output);
            $this->set(
                    array(
                        "_serialize" => array('output'),
                        "_jsonp"=>true
                    )
            );
        } else {
            $options = array(
                'conditions' => array('Noticeboard.' . $this->Noticeboard->primaryKey => $id));
            $notice = $this->Noticeboard->find('first', $options);
            $this->set('notice', $notice);
            $this->set(
                    array(
                            "_serialize" => array('notice'),
                            "_jsonp"=>true
                        )
            );
        }

    }

    public function getOrganizationNotice($orgId)
    {
        $this->Noticeboard->recursive = -1;

        $conditions = array('Noticeboard.organization_id' => $orgId);
        if($this->Noticeboard->hasAny($conditions))
        {
            $options = array(
                            'conditions' => array('Noticeboard.organization_id' => $orgId),
                            'limit'=>3,
                            'order'=>'Noticeboard.notice_date DESC'

                        );
            $count = $this->Noticeboard->find('count', $options);
            $notices = $this->Noticeboard->find('all', $options);

            $this->set('output', $count);
            $this->set('notices', $notices);
        }

        else
        {
            $count = 0;
             $this->set('output', $count);
        }

        $this->set(array(
                '_serialize'=> ['output', 'notices']));

    }

    

    public function addnoticewithdata($orgId = null)
    {
        $this->Noticeboard->recursive = -1;
        
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {


            $this->Noticeboard->create();

            $this->request->data['Noticeboard']['organization_id'] = $orgId;

            // $this->request->data['Noticeboard']['status'] = 1;

            if ($this->Noticeboard->save($this->request->data)) {
                $noticeBoardid = $this->Noticeboard->getLastInsertId();
                $noticeBoard = $this->Noticeboard->find('first',array(
                    'conditions' => array(
                            'Noticeboard.id' => $noticeBoardid,
                            'Noticeboard.organization_id' => $orgId
                        )
                ));
                $startTime = new DateTime($noticeBoard['Noticeboard']['notice_date']);
                $newNoticeTime = $startTime->format('jS F Y \, g:i A');

                $output = ['status'=>1];
            } else {
                $output = ['status'=>0];
            }
        }
        $this->set('newNoticeTime', $newNoticeTime);
        $this->set('noticeBoard', $noticeBoard);
        $this->set('output', $output);

        $this->set(
                    array(
                        "_serialize" => array('output','noticeBoard','newNoticeTime'),
                        "_jsonp"=>true
                    )
            );     
    }
    public function addNoticeByUser($userId = null)
    {
        //$this->Noticeboard->recursive = -1;
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Noticeboard']['user_id'] = $userId;
            $this->Noticeboard->create();
            if ($this->Noticeboard->save($this->request->data)) 
            {
                $noticeBoardId = $this->Noticeboard->getLastInsertId();
                $nbData = $this->Noticeboard->find('first',array(
                        'conditions'=>array(
                                'Noticeboard.id' => $noticeBoardId
                            )
                    ));
                
                $output = 1;
            }
            else
            {
                $output = 0;
            }
            $this->set('nbData', $nbData);
            $this->set('output', $output);

            $this->set(
                        array(
                            "_serialize" => array('output','nbData'),
                            "_jsonp" => true
                        )
                ); 
        }   
    }
    public function editNoticeBoardData($userId = null,$noticeBoardId = null)
    {
        $this->loadModel('User');
        $branchManager=$this->User->loginUserRelationToOther_model($userId);
        $noticeBoard = $this->Noticeboard->find('first',array(
                'conditions' => array(
                    'Noticeboard.id' => $noticeBoardId
                    )
            ));
        $this->set('branchManager', $branchManager);
        $this->set('noticeBoard', $noticeBoard);
        //debug();
        $this->set(
                    array(
                        "_serialize" => array('branchManager','noticeBoard'),
                        "_jsonp" => true
                    )
            );   
    }
    public function editNoticeBoard($noticeId = null)
    {
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) 
        {
                $this->Noticeboard->id = $noticeId; 
                if ($this->Noticeboard->save($this->request->data)) {
                  $output = 1;
                 }
                 else{
                  $output = 0;
                 }
               $this->set('output',$output);
              $this->set(
                array(
                  "_serialize" =>array('output'),
                  "_jsonp"=>true
                )
              );
        }
    }
}