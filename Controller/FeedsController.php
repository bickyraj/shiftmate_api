<?php
App::uses('AppController', 'Controller');


class FeedsController extends AppController
{

	public $components = array('Paginator');
	public function add()
	{

			if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
			{

				$this->Feed->create();
				$this->Feed->save($this->request->data);
			}
	}


	public function view($user_id, $page=null)
	{
			$limit = 20;
			$this->paginate = array(
				'conditions'=>array('Feed.user_id'=>$user_id),
				'page'=> $page,
				'limit'=>$limit
            );
      
            $feeds = $this->Paginator->paginate();

            /*debug($feeds);
            die();*/
            $page=$this->params['paging']['Feed']['pageCount'];
            $currentPage = $this->params['paging']['Feed']['page'];


           
		/*$this->set('feeds', $this->Feed->find('all',array('conditions'=>array('OR'=>array("Feed.user_id"=>$user_id,"Feed.staffto"=>$user_id)))));
		This one goes for 2 condition filter
		*/
		//$this->set('feeds', $this->Feed->findByStafffromOrStaffto($user_id,$user_id));
		
		$this->set('feeds',$feeds);
		$this->set('output',array(
				'currentPage'=>$currentPage,
				'totalPage'=>$page
			));

		$this->set(array(
				'_serialize'=>array('feeds','output')
			));

	}

	public function orgview($org_id = null,$pinned = null,$page = 1)
	{
	   $limit = 20;
        $count = $this->Feed->find('count',array('conditions'=>array('Feed.organization_id'=>$org_id,"Feed.pinned"=>$pinned)));
		$feed = $this->Feed->find('all',array('conditions'=>array('Feed.organization_id'=>$org_id,"Feed.pinned"=>$pinned),"page"=>$page,"limit"=>$limit));
        $max = ceil($count/$limit);
        $this->set(array(
                'feeds'=>$feed,
                "page"=>$page,
                "maxPage"=>$max,
				'_serialize'=>array('feeds','page',"maxPage")
			));

	}

	public function pinFeeds($feedId)
	{
			$this->Feed->id = $feedId;
		 	$pinStatus = $this->Feed->field('pinned');

            
        	
        	if($pinStatus == '0')
        	{
        		$this->Feed->saveField('pinned', '1');

        		$this->set(array('output'=>array('pinStatus'=>'1')));
        		$this->set(array('_serialize'=>array('output')));
        	}

        	else
        	{
        		$this->Feed->saveField('pinned', '0');

        		$this->set(array('output'=>array('pinStatus'=>'0')));
        		$this->set(array('_serialize'=>array('output')));
        	}
	}
	public function addWithData($userId = null)
	{
		$this->Feed->Behaviors->load('Containable');
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
		{
			$this->request->data['Feed']['user_id'] = $userId;
			$this->Feed->create();
			if($this->Feed->save($this->request->data))
			{
				$feedId = $this->Feed->getLastInsertId();
				$feedData = $this->Feed->find('first',array(
                        'conditions'=>array(
                                'Feed.id' => $feedId
                            ),
                        'contain' => array(
                        		'Organization'
                        	)
                    ));
				$output = 1;
			}
			else{
				$output = 0;
			}
		}
		$this->set('feedData', $feedData);
		$this->set('output', $output);
		$this->set(
                array(
                    "_serialize" => array('output','feedData'),
                    "_jsonp" => true
                )
       		 );

	}

	public function updateFeedPin($feedId = null , $feedAction = null)
	{
		
		$this->Feed->id = $feedId;
	 	$pinStatus = $this->Feed->field('pinned');
		if($this->Feed->saveField('pinned',$feedAction)){
			$feedData = $this->Feed->find('first',array(
					'conditions' => array(
							'Feed.id' => $feedId
						)
				));

			$folderImage = $this->webroot.'webroot/files/user/image/'.$feedData['User']['image_dir'].'/thumb2_'.$feedData['User']['image'];
		    $image = $feedData['User']['image'];
		    $gender = $feedData['User']['gender'];
		    $genImage = 'webroot/files/user/image/'.$feedData['User']['image_dir'].'/thumb2_'.$feedData['User']['image'];
		    $this->loadModel('User');
		    $image =$this->User->checkImage($folderImage,$image,$gender,$genImage);
		    $date = $feedData['Feed']['createddate'];
			$createdDate= DateTime::createFromFormat('Y-m-d H:i:s', $date);
         	$finalCreatedDate = $createdDate->format('M d,Y,H:i:s');
			$output = 1;
		}
		else{
			$output = 0;
		}
		$this->set('feedData', $feedData);
		$this->set('image', $image);
		$this->set('feedData', $feedData);
		$this->set('finalCreatedDate', $finalCreatedDate);
		$this->set(
                array(
                    "_serialize" => array('output','feedData','image','finalCreatedDate'),
                    "_jsonp" => true
                )
       		 );
	}

	public function updateFeed()
	{
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
		{
			if($this->Feed->save($this->request->data))
			{
				$output = 1;
			}else
			{
				$output = 0;
			}

			$this->set(
                array(
                	"output"=>$output,
                    "_serialize" => array('output'),
                    "_jsonp" => true
                )
       		 );
		}

	}


}