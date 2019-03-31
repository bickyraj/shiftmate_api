<?php
App::uses('AppController', 'Controller');
/**
 * Shifts Controller
 *
 * @property Shift $Shift
 * @property PaginatorComponent $Paginator
 */
class ShiftsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
        
        public function myOrganizationShift($organization_id = NULL){
            $shifts = $this->Shift->myOrganizationShift($organization_id);
            $this->set('shifts', $shifts);
            $this->set(
              array(
                '_serialize'=>array('shifts'),
                '_jsonp'=>true
                )
              );
        }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Shift->recursive = 0;
		$this->set('shifts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Shift->exists($id)) {
			throw new NotFoundException(__('Invalid shift'));
		}
		$options = array('conditions' => array('Shift.' . $this->Shift->primaryKey => $id));
		$this->set('shift', $this->Shift->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Shift->create();
			if ($this->Shift->save($this->request->data)) {
				$this->Session->setFlash(__('The shift has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The shift could not be saved. Please, try again.'));
			}
		}
		$organizations = $this->Shift->Organization->find('list');
		$this->set(compact('organizations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Shift->exists($id)) {
			throw new NotFoundException(__('Invalid shift'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Shift->save($this->request->data)) {
				$this->Session->setFlash(__('The shift has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The shift could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Shift.' . $this->Shift->primaryKey => $id));
			$this->request->data = $this->Shift->find('first', $options);
		}
		$organizations = $this->Shift->Organization->find('list');
		$this->set(compact('organizations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Shift->id = $id;
		if (!$this->Shift->exists()) {
			throw new NotFoundException(__('Invalid shift'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Shift->delete()) {
			$this->Session->setFlash(__('The shift has been deleted.'));
		} else {
			$this->Session->setFlash(__('The shift could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
    public function listShifts($orgId = null) {
            $this->Shift->recursive = 2;
            $limit = 20;
            $this->paginate = array('conditions'=>array('organization_id'=>$orgId),'order' => 'Shift.starttime ASC','limit'=>$limit);
            $shifts = $this->Paginator->paginate();
            $page=$this->params['paging']['Shift']['pageCount'];
            $currentPage = $this->params['paging']['Shift']['page'];

           // debug($shifts);
            if (!empty($shifts)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "listShifts",
                "status" => $status,
                "pageCount" => $page,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );

            $this->set('output', $output);
            $this->set('shifts', $shifts);

            $this->set(
                    array(
                        "_serialize" => array('shifts', 'output'),
                        "_jsonp"=>true
                    )
            );
    	}
        
        
        public function createShift($orgId = null) {
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
		//debug($this->request->data);die();	
                    $this->Shift->create();
                        $this->request->data['Shift']['organization_id'] = $orgId;
                        $this->request->data['Shift']['status'] = 1;
                       // $this->request->data['ShiftBranch']['status'] = 1;
			if ($this->Shift->saveAll($this->request->data)) {
				$output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                      "action" => "createShifts",
                                       "status"=>1,
                                        "user"=>$this->Shift->Invalidfields(),//"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Shift Created")
                                      );
			} else {
				$output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                      "action" => "createShifts",
                                       "status"=>0,
                                       "user"=>$this->Shift->Invalidfields(),
                                       //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Fails Creating Shift. Please Try Again")
                                      );
			}
                        
                        $this->set('output',$output);
			$this->set(
                                    array(
                                        "_serialize" =>array('output')
                                    )
                            );
		}
		
	}
        
        public function editShift($id = null) {
		
		if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
			//debug($this->request->data);
                        
                        $shiftBranchesId = $this->Shift->ShiftBranch->find('list', array('conditions'=>array('shift_id'=>$id)));
                        $this->Shift->ShiftBranch->delete($shiftBranchesId);
                    if ($this->Shift->saveAll($this->request->data)) {
				$output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                      "action" => "editShift",
                                       "status"=>1,
                                        //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Shift Updated")
                                      );
			} else {
				$output= array( 
                                       "params" =>$this->request,
                                       "method"=>$this->method,
                                      "action" => "editShift",
                                       "status"=>0,
                                       //"user"=>$this->request->data,
                                       "error"=>array("validation"=>"Fails Updating Shift. Please Try Again")
                                      );
			}
                        $this->set('output',$output);
			$this->set(
                                    array(
                                        "_serialize" =>array('output')
                                    )
                            );
		} else {
			$options = array('conditions' => array('Shift.' . $this->Shift->primaryKey => $id));
			$shift = $this->Shift->find('first', $options);
                        $this->set('shift',$shift);
			$this->set(
                                    array(
                                        "_serialize" =>array('shift')
                                    )
                            );
		}
		
	}

  public function findShiftTime($shiftId = null){
    $time = $this->Shift->findShiftTime($shiftId);

    $this->set(array(
      'time'=>$time,
      '_serialize'=>'time',
      '_jsonp'=>true
      ));

  }
   public function notInBranch($org_id = null,$branch_id =null)
        {
          $this->Shift->recursive = -1;
          $this->loadModel('ShiftBranch');
          $shiftBranchIds = $this->ShiftBranch->shiftBranch_Ids($branch_id);

          if(isset($shiftBranchIds) && !empty($shiftBranchIds)){
          $remShifts = $this->Shift->find('all',array(
              'conditions' => array(
                  'Shift.status' => 1,
                  'Shift.organization_id' => $org_id,
                  'NOT' => array(
                      'Shift.id' => $shiftBranchIds
                    )
                )
            ));
            if(!empty($remShifts))
            {
              $output=['status'=>1];
            }
            else
            {
              $output=['status'=>0];
            }
          
        }
        else{
          $remShifts = $this->Shift->find('all',array(
              'conditions' => array(
                  'Shift.organization_id' => $org_id
                )
            ));
          $output=['status'=>1];
        }
        //debug($remShifts);
          $this->set('shift',$remShifts);
          $this->set('output',$output);
          $this->set(
                    array(
                        "_serialize" =>array('shift','output'),
                        "_jsonp" => true
                    )
            );

        }
    public function createShiftwithdata($orgId = null) {
     $this->Shift->recursive = -1;
      
      // if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
      //debug($this->request->data);die();
      $da = $this->request->data;  
            $this->Shift->create();
            $this->request->data['Shift']['organization_id'] = $orgId;
            $this->request->data['Shift']['status'] = 1;

            $starttime = explode(':', $this->request->data['Shift']['starttime']);
              if($starttime[0] < 10):
                  $starttime='0'.$starttime[0].':'.$starttime[1].':00';
              else:
                  $starttime=$this->request->data['Shift']['starttime'].':00';
              endif;

              $endtime = explode(':', $this->request->data['Shift']['endtime']);
              if($endtime[0] < 10):
                  $endtime='0'.$endtime[0].':'.$endtime[1].':00';
              else:
                  $endtime=$this->request->data['Shift']['endtime'].':00';
              endif;

              $this->request->data['Shift']['starttime']= $starttime;
              $this->request->data['Shift']['endtime']= $endtime;
            //$this->request->data['Shift']['starttime'] = $this->request->data['Shift']['starttime'].':00';
            //$this->request->data['Shift']['starttime'] = $this->request->data['Shift']['endtime'].':00';
            // $this->request->data['ShiftBranch']['status'] = 1;
            $rule = array('Shift.organization_id'=>$orgId,'Shift.title'=>$this->request->data['Shift']['title']);
            if($this->Shift->hasAny($rule)){
              $output= array( 
                       "params" =>$this->request,
                       "method"=>$this->method,
                      "action" => "createShifts",
                       "status"=>2,
                       "error"=>array("validation"=>"Shift already exist")
                      );

            } else {

              if ($this->Shift->saveAll($this->request->data)) {
                $shiftId = $this->Shift->getLastInsertId();
                $shift = $this->Shift->find('first',array(
                  'conditions' =>array(
                      'Shift.id' =>$shiftId
                    )
                ));
                $output= array( 
                                               "params" =>$this->request,
                                               "method"=>$this->method,
                                              "action" => "createShifts",
                                               "status"=>1,
                                               "shift" => $shift,
                                                //"user"=>$this->request->data,
                                               "error"=>array("validation"=>"Shift Created")
                                              );
              } else {
                $output= array( 
                                               "params" =>$this->request,
                                               "method"=>$this->method,
                                              "action" => "createShifts",
                                               "status"=>0,
                                               
                                               "error"=>array("validation"=>"Fails Creating Shift. Please Try Again")
                                              );
              }
          }                    
            $this->set('output',$output);
            $this->set(
                        array(
                          "da"=>$da,
                            "_serialize" =>array('output', 'da'),
                            "_jsonp" => true
                        )
                      );
      // }
      
    }
    public function editShiftData($orgId = null, $shiftId = null)
    {
      $this->loadModel('Branch');
      $branch = $this->Branch->orgBranchList($orgId);
      $this->loadModel('ShiftBranch');
      $shiftBranch = $this->ShiftBranch->shiftRelatedBranch($shiftId);
      $this->Shift->recursive = -1;
      $shift = $this->Shift->find('first',array(
          'conditions' => array(
              'Shift.id' => $shiftId
            )
        ));
      
      $this->loadModel('ShiftUser');
      $changeShift = $this->ShiftUser->changeShift($shiftId);
      
      $this->set('branch',$branch);
      $this->set('shiftBranch',$shiftBranch);
      $this->set('shift',$shift);
      $this->set('changeShift',$changeShift);

      $this->set(
                  array(
                      "_serialize" =>array('branch','shiftBranch','shift','changeShift'),
                      "_jsonp" => true
                  )
                );
    }
    public function editShiftwithData($orgId = null,$Shiftid = null) {
    
    if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
            //debug($this->request->data);
            // debug($this->request->data);
            // die();
            $shiftBranchesId = $this->Shift->ShiftBranch->find('list', array('conditions'=>array('shift_id'=>$Shiftid)));

            $this->Shift->ShiftBranch->delete($shiftBranchesId);
            $this->request->data['Shift']['organization_id'] = $orgId;
            $this->request->data['Shift']['status'] = 1;

            if(isset($this->request->data['Shift']['starttime'])){           
              $starttime = explode(':', $this->request->data['Shift']['starttime']);
              if($starttime[0] < 10):
                  $starttime='0'.$starttime[0].':'.$starttime[1].':00';
              else:
                  $starttime=$this->request->data['Shift']['starttime'].':00';
              endif;

              $endtime = explode(':', $this->request->data['Shift']['endtime']);
              if($endtime[0] < 10):
                  $endtime='0'.$endtime[0].':'.$endtime[1].':00';
              else:
                  $endtime=$this->request->data['Shift']['endtime'].':00';
              endif;

              $this->request->data['Shift']['starttime']= $starttime;
              $this->request->data['Shift']['endtime']= $endtime;
            }
            
            $this->request->data['Shift']['id'] = $Shiftid;

          $rule = array('Shift.organization_id'=>$orgId,'Shift.title'=>$this->request->data['Shift']['title'],'Shift.id !='=>$Shiftid);
          
          $count = $this->Shift->find('count',array(
                'conditions'=>$rule
            ));

        if($count > 0){
            $output = array( 
                     "params" =>$this->request,
                     "method"=>$this->method,
                    "action" => "editShift",
                     "status"=>2,
                      //"user"=>$this->request->data,
                     "error"=>array("validation"=>"Shift already exist.")
                          );
               
        } else { 
        
        if ($this->Shift->saveAll($this->request->data)) {    
        $output = array( 
                   "params" =>$this->request,
                   "method"=>$this->method,
                  "action" => "editShift",
                   "status"=>1,
                    //"user"=>$this->request->data,
                   "error"=>array("validation"=>"Shift Updated")
                  );
       } 
      else 
      {
        $output = array( 
                   "params" =>$this->request,
                   "method"=>$this->method,
                  "action" => "editShift",
                   "status"=>0,
                   //"user"=>$this->request->data,
                   "error"=>array("validation"=>$this->Shift->invalidfields())
                  );
       }

     }
        $this->set(
                array(
                    "output"=>$output,
                    "_serialize" =>array('output'),
                    "_jsonp"=>true
                )
        );
    } 
    // else {
    //   $options = array('conditions' => array('Shift.' . $this->Shift->primaryKey => $Shiftid));
    //   $shift = $this->Shift->find('first', $options);
    //                     $this->set('shift',$shift);
    //   $this->set(
    //                                 array(
    //                                     "_serialize" =>array('shift')
    //                                 )
    //                         );
    // }
    
  }
  public function createShiftbyBranch($branchId = null,$orgId = null)
  {

      if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) 
      {
          $starttime = explode(':', $this->request->data['Shift']['starttime']);
          if($starttime[0] < 10):
              $starttime='0'.$starttime[0].':'.$starttime[1].':00';
          else:
              $starttime=$this->request->data['Shift']['starttime'].':00';
          endif;

          $endtime = explode(':', $this->request->data['Shift']['endtime']);
          if($endtime[0] < 10):
              $endtime='0'.$endtime[0].':'.$endtime[1].':00';
          else:
              $endtime=$this->request->data['Shift']['endtime'].':00';
          endif;

          $this->request->data['Shift']['starttime']= $starttime;
          $this->request->data['Shift']['endtime']= $endtime;
          $this->request->data['Shift']['organization_id'] = $orgId;
          $this->request->data['Shift']['branch_id'] = $branchId;
          $this->request->data['Shift']['status'] = 2;
          $this->request->data['ShiftBranch'][0]['status'] = 1;
          $this->request->data['ShiftBranch'][0]['branch_id'] = $branchId;
          $this->Shift->create();
          if ($this->Shift->saveAll($this->request->data)) {
              $shiftId = $this->Shift->getLastInsertId();
              $shiftByBranch = $this->Shift->find('first',array(
                'conditions' =>array(
                    'Shift.id' =>$shiftId
                  )
              ));
              $startTime = $shiftByBranch['Shift']['starttime'];
             $endTime = $shiftByBranch['Shift']['endtime'];
             $sTime = new DateTime($startTime);
            $finalStime = $sTime->format('g:i A');

            $eTime = new DateTime($endTime);
            $finalEtime = $eTime->format('g:i A');
              $output = 1;
          }
          else{
            $output = 0;
          }
          $this->set('shiftByBranch',$shiftByBranch);
          $this->set('finalStime',$finalStime);
          $this->set('finalEtime',$finalEtime);
          $this->set('output',$output);
          $this->set(
                  array(
                      "_serialize" =>array('shiftByBranch','finalStime','finalEtime','output'),
                      "_jsonp" => true
                  )
                );
      }
  }
  public function shiftAddByBranchList($orgId = null,$branchId = null)
  {
      $this->Shift->recursive = -1;
      $shiftList = $this->Shift->find('all',array(
          'conditions' => array(
              'Shift.organization_id' => $orgId,
              'Shift.branch_id' => $branchId,
              'Shift.status' => 2
            ),
          'order' => array('Shift.starttime'=>'ASC')
        ));
      $this->set('shiftList',$shiftList);
      $this->set(
              array(
                  "_serialize" =>array('shiftList')
              )
            );
  }
  public function shifteditBybranch($branchId=null,$orgId = null,$shiftId = null){
      $this->loadModel('shiftBoard');
      $usedShift = $this->shiftBoard->shiftListByShiftId($shiftId);
      if(empty($usedShift))
      {
          if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) 
          {
              $this->request->data['Shift']['organization_id'] = $orgId;
              $this->request->data['Shift']['branch_id'] = $branchId;
              $this->request->data['Shift']['status'] = 2;

              if(isset($this->request->data['Shift']['starttime'])){  
                $starttime = explode(':', $this->request->data['Shift']['starttime']);
                if($starttime[0] < 10):
                    $starttime='0'.$starttime[0].':'.$starttime[1].':00';
                else:
                    $starttime=$this->request->data['Shift']['starttime'].':00';
                endif;

                $endtime = explode(':', $this->request->data['Shift']['endtime']);
                if($endtime[0] < 10):
                    $endtime='0'.$endtime[0].':'.$endtime[1].':00';
                else:
                    $endtime=$this->request->data['Shift']['endtime'].':00';
                endif;
                
                $this->request->data['Shift']['starttime']= $starttime;
                $this->request->data['Shift']['endtime']= $endtime;
              }

                $this->request->data['Shift']['id'] = $shiftId;
              if ($this->Shift->save($this->request->data)) {  
                  $output = 1;
              }
              else{
                $output = 0;
              }
          }     

      }
      else{
        $output = 3;
      }
      $this->set('output',$output);
      $this->set(
              array(
                  "_serialize" =>array('output')
              )
            );
  }

  public function deleteShift($shiftId = null)
  {

    $dToday =  date('Y-m-d');

    $this->Shift->Behaviors->load('Containable');

    $options = array('conditions'=>['Shift.id'=>$shiftId], 'contain'=>['ShiftUser'=>['conditions'=>['ShiftUser.shift_date <='=>$dToday]]], 'fields'=>['id']);

    $data = $this->Shift->find('first', $options);
    
    $status = 0;
    if(empty($data['ShiftUser']))
    {
      $this->Shift->id = $shiftId;

      if($this->Shift->delete())
      {
        $status = 1;
      }
    }

    $this->set(array(
        'data'=>$data,
        'status'=>$status,
        '_serialize'=>['data', 'status'],
        '_jsonp'=>true
      ));
  }

  public function check($shiftId){
    $this->loadModel('ShiftUser');
    $this->ShiftUser->changeShift($shiftId);
  }

  public function shiftListByOrg($userId){
    $output = $this->Shift->shiftListByOrg($userId);
    
    $this->set(array(
        'output'=>$output,
        '_serialize'=>'output'
      ));
  }

}
