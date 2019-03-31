<?php
App::uses('AppController', 'Controller');


class UserinductionsController extends AppController
{

	public $components = array('Paginator');

	public function add()
	{
			// if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put'))
			// {
				$this->Userinduction->create();
				if($this->Userinduction->save($this->request->data)){
				    $output=1;
				}else{
				    $output=0;
				}
                $this->set(array(
                    'output'=>$output,
                    "_serialize"=>array("output"),
                    "_jsonp"=>true
                ));
			//}
	}

	public function view($stat = null,$orgId=null, $page=1)
	{
		$limit = 20;
        $count = $this->Userinduction->find('count',array('conditions'=>array('Userinduction.status'=>$stat,"Userinduction.organization_id"=>$orgId)));
	   $userInduction= $this->Userinduction->find('all',array('conditions'=>array('Userinduction.status'=>$stat,"Userinduction.organization_id"=>$orgId),'limit'=>$limit,"page"=>$page));
		$this->set(array(
                'page'=>$page,
                "maxPage"=>ceil($count/$limit),
                'userinductions'=>$userInduction,
				'_serialize'=>array('userinductions','page','maxPage')
			));
	}
    
    public function viewUser($stat = null)
	{
	   $this->set("userinductions",$this->Userinduction->find('all',array('conditions'=>array('Userinduction.status'=>$stat))));
		$this->set(array(
				'_serialize'=>'userinductions'
			));
	}
	 public function editInductions($id = null)
    {
    	$this->Userinduction->id=$this->request->data['Userinduction']['id'];
    	if($this->Userinduction->save($this->request->data)){
    		$message="Edited successfully";
    	}else{
    		$message="Coundnot edit this time, try again latter";
    	}

    	$this->set(array(
    		'message'=>$message,
    		'_serialize'=>array('message')
    		));

    }


}