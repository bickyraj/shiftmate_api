<?php

App::uses('AppController', 'Controller');

/**
 * Organizations Controller
 *
 * @property Organization $Organization
 * @property PaginatorComponent $Paginator
 */
class OrganizationsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');
    
    public function test($user_id){
        $userDetail['organization_id'] = $this->Organization->getOrgId($user_id);
         debug($userDetail);
        
    }
 
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Organization->recursive = 0;
        $this->set('organizations', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Organization->exists($id)) {
            throw new NotFoundException(__('Invalid organization'));
        }
        $options = array('conditions' => array('Organization.' . $this->Organization->primaryKey => $id));
        $this->set('organization', $this->Organization->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Organization->create();
            if ($this->Organization->save($this->request->data)) {
                $this->Session->setFlash(__('The organization has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The organization could not be saved. Please, try again.'));
            }
        }
        $users = $this->Organization->User->find('list');
        $cities = $this->Organization->City->find('list');
        $countries = $this->Organization->Country->find('list');
        $days = $this->Organization->Day->find('list');
        $this->set(compact('users', 'cities', 'countries', 'days'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Organization->exists($id)) {
            throw new NotFoundException(__('Invalid organization'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Organization->save($this->request->data)) {
                $this->Session->setFlash(__('The organization has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The organization could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Organization.' . $this->Organization->primaryKey => $id));
            $this->request->data = $this->Organization->find('first', $options);
        }
        $users = $this->Organization->User->find('list');
        $cities = $this->Organization->City->find('list');
        $countries = $this->Organization->Country->find('list');
        $days = $this->Organization->Day->find('list');
        $this->set(compact('users', 'cities', 'countries', 'days'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Organization->id = $id;
        if (!$this->Organization->exists()) {
            throw new NotFoundException(__('Invalid organization'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Organization->delete()) {
            $this->Session->setFlash(__('The organization has been deleted.'));
        } else {
            $this->Session->setFlash(__('The organization could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function orgList() {
        $this->Organization->recursive = 0;
        $organizations = $this->Paginator->paginate();

        if (!empty($users)) {
            $status = 1;
        } else {
            $status = 0;
        }
        $output = array(
            "params" => $this->request,
            "method" => $this->method,
            "action" => "orgList",
            "status" => $status,
            "error" => array("validation" => "")
        );

        $this->set('output', $output);
        $this->set('organizations', $organizations);

        $this->set(
                array(
                    "_serialize" => array('organizations', 'output')
                )
        );
    }

    public function orgView($id = null) {
        $this->Organization->Behaviors->load('Containable');
        if (!$this->Organization->exists($id)) {
            throw new NotFoundException(__('Invalid organization'));
        }
        $options = array('conditions' => array('Organization.' . $this->Organization->primaryKey => $id), 'contain' => array('User', 'Country', 'City', 'Day'));
        $organization = $this->Organization->find('first', $options);

        if (!empty($organization)) {
            $status = 1;
        } else {
            $status = 0;
        }
        $output = array(
            "params" => $this->request,
            "method" => $this->method,
            "action" => "orgList",
            "status" => $status,
            "error" => array("validation" => "")
        );

        $this->set('output', $output);
        $this->set('organization', $organization);

        $this->set(
                array(
                    "_serialize" => array('organization', 'output')
                )
        );
    }

    public function changePassword($orgId) {
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
            $this->Organization->User->recursive = -1;
            $userId = $this->Organization->find('list', array('fields' => array('Organization.user_id'), 'conditions' => array('Organization.id' => $orgId)));
            $userId = current($userId);
            $user = $this->Organization->User->findById($userId);

            $oldPassword = $this->request->data['User']['old_password'];
            $confirmPassword = $this->request->data['User']['confirm_password'];
            $password = $this->request->data['User']['password'];
            $existingPassword = $user['User']['password'];

            //$passwordHasher = new SimplePasswordHasher();
           //$oldPassword = $passwordHasher->hash($oldPassword);
           $oldPassword = $this->Organization->User->passwordHash($oldPassword);
           
            if ($password == $confirmPassword) { 
                if ($oldPassword == $existingPassword) {
                    $this->Organization->User->id = $user['User']['id'];
                    if ($this->Organization->User->saveField('password', $password)) {
                        $output = array(
                           // "params" => $this->request,
                            //"method" => $this->method,
                            "action" => "changePassword",
                            "status" => 1,
                            "error" => array("validation" => "Password changed successfully.")
                        );
                        $this->set('output', $output);
                        $this->set(
                                array(
                                    "_serialize" => array('output')
                                )
                        );
                    } else {
                        $output = array(
                            //"params" => $this->request,
                            //"method" => $this->method,
                            "action" => "changePassword",
                            "status" => 0,
                            "error" => array("validation" => "Fail to Change Password. Please Try Again.")
                        );
                        $this->set('output', $output);
                        $this->set(
                                array(
                                    "_serialize" => array('output')
                                )
                        );
                    }
                } else {
                    $output = array(
                        //"params" => $this->request,
                        //"method" => $this->method,
                        "action" => "changePassword",
                        "status" => 0,
                        "error" => array("validation" => "Old Password do not match. Please Try Again.")
                    );
                    $this->set('output', $output);
                    $this->set(
                            array(
                                "_serialize" => array('output')
                            )
                    );
                }
            } else {
                $output = array(
                    //"params" => $this->request,
                    //"method" => $this->method,
                    "action" => "changePassword",
                    "status" => 0,
                    "error" => array("validation" => "Password Confirmation fails. Please Try Again.")
                );
                $this->set('output', $output);
                $this->set(
                        array(
                            "_serialize" => array('output')
                        )
                );
            }
        }
    }
    
    public function getUserIdFromOrgId($orgId = null){
        $userId = $this->Organization->find('list', array(
            'fields'=>array(
                'Organization.user_id'
                ),
            'conditions'=>array(
                'Organization.id'=>$orgId
                )
            )
                );
        
        $userId = current($userId);
       // debug($userId);die();
        if (!empty($userId)) {
            $status = 1;
        } else {
            $status = 0;
        }
        $output = array(
            "params" => $this->request,
            "method" => $this->method,
            "action" => "getUserIdFromOrgId",
            "status" => $status,
            "error" => array("validation" => "")
        );

        $this->set('output', $output);
        $this->set('userId', $userId);

        $this->set(
                array(
                    "_serialize" => array('userId', 'output')
                )
        );
    }
    
    
    public function getOrgIdFromUserId($userId = null){
        $orgId = $this->Organization->find('list', array('fields'=>array('Organization.id'), 'conditions'=>array('Organization.user_id'=>$userId)));
        $orgId = current($orgId);
        
        if (!empty($orgId)) {
            $status = 1;
        } else {
            $status = 0;
        }
        $output = array(
            "params" => $this->request,
            "method" => $this->method,
            "action" => "getOrgIdFromUserId",
            "status" => $status,
            "error" => array("validation" => "")
        );

        $this->set('output', $output);
        $this->set('orgId', $orgId);

        $this->set(
                array(
                    "_serialize" => array('orgId', 'output')
                )
        );
    }


    public function organizationProfile($orgId = null)
    {
        $options = array('conditions'=>array('Organization.id'=>$orgId));

        $output = $this->Organization->find('first', $options);
        $this->set('output', $output);
        $this->set(
            array("_serialize" => array('output', 'output'))
            );
    }

    public function orgEdit($id = null) {
            
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {

          
            if ($this->Organization->save($this->request->data)) {
                $output = array(
                    "params" => $this->request,
                    "method" => $this->method,
                    "action" => "orgEdit",
                    "status" => 1,
                    //"user"=>$this->request->data,
                    "error" => array("validation" => "Organization Updated")
                );
            } 
            else {
                $output = array(
                    "params" => $this->request,
                    "method" => $this->method,
                    "action" => "orgEdit",
                    "status" => 0,
                    //"user"=>$this->request->data,
                    "error" => array("validation" => "Organization Update Fails. Please Try Again")
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
            $output = '';
            $options = array('conditions' => array('Organization.id'=> $id));
            $organizations = $this->Organization->find('first', $options);

            $this->set('organizations', $organizations);
            $this->set(
                    array(
                        "_serialize" => array('organizations')
                    )
            );
        }
    }
        /*
        By rabi
        */
    public function userInfoInBranch($org_id = null)
    {
        $this->Organization->Behaviors->load('Containable');
        $organizationUserInfo = $this->Organization->find('first',array(
                'conditions' => array(
                        'Organization.id' => $org_id
                    ),
                'contain' => ['OrganizationUser']
            ));
        $this->set('organizationUserInfo',$organizationUserInfo);
        $this->set(
                array(
                        "_serialize" => array('organizationUserInfo')
                    )
            );
    }
    
}
