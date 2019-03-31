<?php
App::uses('AppController', 'Controller');

class TasksController extends AppController{
   
    public function addTask($user_id=null)
        {
    	   if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {

             //  $this->request->data['Task']['taskdate'] = $date2;
               //$this->request->data['Task']['user_id'] = $user_id;
               $this->request->data['Task']['status'] = 0;

                $this->Task->create();
      
                if ($this->Task->save($this->request->data)) {
                    $output['status'] = 1;
                } else {
                    $output['status'] = 0;
                }
            }

            $this->set('output', $output);

            $this->set(
                        array(
                            "_serialize" => array('output')
                        )
                );
            }

            public function listTask($user_id = null,$page =1){
    
                $tasks = $this->Task->listTask($user_id,$page);
                  $this->set(array(
                    'tasks' => $tasks,
                    '_serialize' => array('tasks')
                ));

            }

            public function completeTask($id){
                //if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {  
                   $this->Task->id = $id;
                   $this->request->data['Task']['status'] = 1;
                   if($this->Task->save($this->request->data)){
                        //success
                        $output = '1';
                   } else{
                        //fails
                        $output = '2';
                   }
               $this->set(array(
                    'status'=>$output,
                    '_serialize'=>'status',
                    'jsonp'=>'true'

                ));
            } 
            /*By rabi*/
            public function taskCount($user_id = null)
            {
              $today = date("Y-m-d h:i:s");
              $this->Task->recursive = -1;
              $taskCount=$this->Task->find('count',array(
                  'conditions' => array(
                      'Task.user_id'=>$user_id,
                      'Task.taskdate >='=>$today
                    ),

                ));
              $this->set('taskCount',$taskCount);
              $this->set(
                        array(
                            "_serialize" => array('taskCount')
                        )
                );
            }  
}
?>