<?php
App::uses('AppController', 'Controller');
/**
 * Vaccinations Controller
 *
 * @property Vaccination $Vaccination
 * @property PaginatorComponent $Paginator
 */
class VaccinationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function view($userId = null){
		$output = $this->Vaccination->view($userId);
		$this->set(array(
			'output'=>$output,
			'_serialize'=>'output'
			));
	}

}
