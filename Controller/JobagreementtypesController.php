<?php
App::uses('AppController','Controller');

class JobagreementtypesController extends AppController{
	public function listJobAgreementType($page = null,$orgId = null) {
	

		$types = $this->Jobagreementtype->listJobAgreementType($page,$orgId);
		$this->set(array(
			'types'=>$types,
			'_serialize'=>'types'
			));
		//debug($types);
	}


	public function addJobAgreementCategory(){
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Jobagreementtype']['date'] = date('Y-m-d');
			
			$date1 = new DateTime($this->request->data['Jobagreementtype']['date']);
			$category = $this->request->data['Jobagreementtype']['type'];

	    	$date = $date1->format('jS F Y');

			$this->Jobagreementtype->create();
			$rule = array('Jobagreementtype.type'=>$category,'Jobagreementtype.organization_id'=>$this->request->data['Jobagreementtype']['organization_id']);

			if($this->Jobagreementtype->hasAny($rule)){
				$output['status'] = 2;
			}

			elseif($this->Jobagreementtype->save($this->request->data)){
					$output['status'] = 1;
					$output['date'] = $date;
					$output['category'] = $category;
					$output['id'] = $this->Jobagreementtype->id;
			} else {
					$output['status'] = 0;
			}
		}

		$this->set(array(
			'output' => $output,
			'_serialize' => array('output')
			));
	}



	public function editJobAgreementCategory(){
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Jobagreementtype']['date'] = date('Y-m-d');
			$id = $this->request->data['Jobagreementtype']['id'];
			$type = $this->request->data['Jobagreementtype']['type'];

			$rule = array('Jobagreementtype.type'=>$type,'Jobagreementtype.organization_id'=>$this->request->data['Jobagreementtype']['organization_id']);

			$this->Jobagreementtype->id = $id;
			if($this->Jobagreementtype->hasAny($rule)){

				//error
				$output['status'] = 2;
			} else {
			if($this->Jobagreementtype->save($this->request->data)){
				$output['id'] = $id;
				$output['status'] = 1;
				$output['category'] = $type;
			} else {
				$output = 0;
			}
			}
		}

		$this->set(array(
			'output' => $output,
			'_serialize' => array('output')
			));
	}

	public function jobAgreementTypeById($id){
		$result = $this->Jobagreementtype->jobAgreementTypeById($id);
		$output['id'] = $result['Jobagreementtype']['id'];
		$output['category'] = $result['Jobagreementtype']['type'];
		$this->set(array(
			'output' => $output,
			'_serialize' => array('output')
		));
	}	


	public function categoryOfOrg($orgId = null) {
	
		$types = $this->Jobagreementtype->find('all',array(
				'recursive'=>1,
				'conditions'=>array('Jobagreementtype.organization_id'=>$orgId)
			));
		
		$this->set(array(
			'types'=>$types,
			'_serialize'=>'types',
			'_jsonp'=>true
			));
		//debug($types);
	}

	public function deleteJobAgreementType()
	{
		$status = 0;
		if($this->Jobagreementtype->delete($this->request->data['typeId']))
		{
			$status = 1;
		}

		$this->set(array(
			'status'=>$status,
			'_serialize'=>'status',
			'_jsonp'=>true
			));
	}

}