<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 */


class NewsboardsController extends AppController {

	/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');



		public function index() {
		$this->Shift->recursive = 0;
		$this->set('newsboards', $this->Paginator->paginate());
	}




    public function add($orgId)
    {


    	if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {


            $this->Newsboard->create();

            $this->request->data['Newsboard']['organization_id'] = $orgId;

            // $this->request->data['Newsboard']['status'] = 1;

            if ($this->Newsboard->save($this->request->data)) {
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


    public function listNewsboards($orgId = null,$page =1)
    {

    	       $this->Newsboard->recursive = 0;
            $limit = 15;
            $this->paginate = array('conditions'=>array('organization_id'=>$orgId), 'limit'=>$limit,"page"=>$page);
      
            $news = $this->Paginator->paginate();
            $page=$this->params['paging']['Newsboard']['pageCount'];
            $currentPage = $this->params['paging']['Newsboard']['page'];

            if (!empty($news)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "listNewsboards",
                "status" => $status,
                "pageCount"=>$page,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );

            $this->set('output', $output);
            $this->set('news', $news);

            $this->set(
                    array(
                        "_serialize" => array('news', 'output')
                    )
            );
    }

    public function viewNewsboards($id = null)
    {
        $options = array('conditions' => array('Newsboard.' .$this->Newsboard->primaryKey => $id));
        $news = $this->Newsboard->find('first', $options);
        $this->set('news', $news);
        $this->set(
                array(
                    "_serialize" => array('news')
                )
        );

    }


    public function editNewsboards($id = null)
    {
    	if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) 
    	{
            $this->Newsboard->id = $id;
        	if ($this->Newsboard->save($this->request->data)) {
                $output = 1;
            } else {
                $output = 0;
            }

            $this->set('output', $output);
            $this->set(
                    array(
                        "_serialize" => array('output')
                    )
            );
        }

    }

    public function addnewswithdata($orgId = null)
    {
        $this->Newsboard->recursive = -1;  
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {


            $this->Newsboard->create();

            $this->request->data['Newsboard']['organization_id'] = $orgId;

            if ($this->Newsboard->save($this->request->data)) {
                $newsBoardId = $this->Newsboard->getLastInsertId();
                $newsData = $this->Newsboard->find('first',array(
                        'conditions' =>array(
                                'Newsboard.id' => $newsBoardId
                            )
                   ));
                $startTime = new DateTime($newsData['Newsboard']['news_date']);
                $newNewsTime = $startTime->format('jS F Y \, g:i A');

                $output = 1;
                 
            } else {
                $output = 0;
            }
        }
        $this->set('newsData', $newsData);
        $this->set('newNewsTime', $newNewsTime);
        $this->set('output', $output);

        $this->set(
                    array(
                        "_serialize" => array('newsData','newNewsTime','output'),
                        "_jsonp"=>true
                    )
            );
    }
    public function editnewsData($newsId = null)
    {
        $this->Newsboard->recursive = -1;
        $newsEditData = $this->Newsboard->find('first',array(
                'conditions' =>array(
                        'Newsboard.id' => $newsId
                    )
            ));
        $this->set('newsEditData', $newsEditData);

        $this->set(
                    array(
                        "_serialize" => array('newsEditData','newsEditData'),
                        "_jsonp"=>true
                    )
            );
    }


}