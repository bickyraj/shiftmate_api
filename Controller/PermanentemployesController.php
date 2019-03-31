<?php
App::uses('AppController', 'Controller');
/**
 * Permanentemployes Controller
 *
 * @property Permanentemploye $Permanentemploye
 * @property PaginatorComponent $Paginator
 */
class PermanentemployesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');


/**
 * getPerm method
 *
 * @param string $userid
 * @return void
 */
	public function getPerm($userid) {
		$options = array('conditions' => array('Permanentemploye.organization_user_id'=>$userid),'order'=>array('Permanentemploye.day_id ASC','Permanentemploye.starttime ASC'));
		$datas = $this->Permanentemploye->find('all', $options);
       
       	$output = array();
        foreach($datas as $k=>$d){
        	$output[$d['Day']['title']][$k] = $d['Permanentemploye']['starttime'].' to '.$d['Permanentemploye']['endtime'];
        }
   
        $this->set(array(
            'getPerm'=>$output,
            '_serialize'=>array('getPerm')
        ));
	}

/**
 * saveEmploye method
 *
 * @return void
 */
	public function saveEmploye() {
			$this->Permanentemploye->create();
			$organization_user_id = $this->request->data['Permanentemploye']['organization_user_id'];
			$day_id = $this->request->data['Permanentemploye']['day_id'];
			$starttime = $this->request->data['Permanentemploye']['starttime'];
			$endtime = $this->request->data['Permanentemploye']['endtime'];

			if($this->Permanentemploye->hasAny(['organization_user_id'=>$organization_user_id,'day_id'=>$day_id,'starttime'=>$starttime,'endtime'=>$endtime])){

			} else {
				if ($this->Permanentemploye->save($this->request->data)) {
				$this->Session->setFlash(__('The permanentemploye has been saved.'));
				return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The permanentemploye could not be saved. Please, try again.'));
				}
			}
			

		$organizationUsers = $this->Permanentemploye->OrganizationUser->find('list');
		$days = $this->Permanentemploye->Day->find('list');
	//	$this->set(compact('organizationUsers', 'days'));
        $this->set(array(
            'organizationUsers'=>$organizationUsers,
            'days'=>$days,
            '_serialize'=>array('organizationUsers','days')
        ));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Permanentemploye->exists($id)) {
			throw new NotFoundException(__('Invalid permanentemploye'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Permanentemploye->save($this->request->data)) {
				$this->Session->setFlash(__('The permanentemploye has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The permanentemploye could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Permanentemploye.' . $this->Permanentemploye->primaryKey => $id));
			$this->request->data = $this->Permanentemploye->find('first', $options);
		}
		$organizationUsers = $this->Permanentemploye->OrganizationUser->find('list');
		$days = $this->Permanentemploye->Day->find('list');
		$this->set(compact('organizationUsers', 'days'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Permanentemploye->id = $id;
		if (!$this->Permanentemploye->exists()) {
			throw new NotFoundException(__('Invalid permanentemploye'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Permanentemploye->delete()) {
			$this->Session->setFlash(__('The permanentemploye has been deleted.'));
		} else {
			$this->Session->setFlash(__('The permanentemploye could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
