<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 */


class ShiftnotesController extends AppController {

	/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');



		public function index() {
		$this->Shift->recursive = 0;
		$this->set('leaveholidays', $this->Paginator->paginate());
	}

	public function addNotes()
    {


    	if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {

            $conditions = array(
                                    'Shiftnote.board_id'=>$this->request->data['Shiftnote']['board_id'],
                                    'Shiftnote.shift_id'=>$this->request->data['Shiftnote']['shift_id']
                                );

            if (!$this->Shiftnote->hasAny($conditions))
            {

                $this->Shiftnote->create();

                $this->request->data['Shiftnote']['status'] = 1;

                $data = array();

                if ($this->Shiftnote->save($this->request->data)) {

                    $id = $this->Shiftnote->id;

                    $options = array('conditions'=>['Shiftnote.id'=>$id]);

                    $data = $this->Shiftnote->find('first', $options);
                    $output = ['status'=>1,'data'=>$data, 'messageStatus'=>0];

                } else {
                    $output = ['status'=>0, 'data'=>$data, 'messageStatus'=>0];
                }
            }else
            {
                $output = ['status'=>0, 'messageStatus'=>1, 'message'=>'The notes has been added to this shift.'];
            }

        }
        $this->set(
                    array(
                        "output"=>$output,
                        "_serialize" => array('output'),
                        "_jsonp" => true
                    )
            );

    }

    public function editNotes($shiftId = null)
    {


        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) 
        {
                $this->request->data['Shiftnote']['status'] = 0;

                if($this->request->data['Shiftnote']['image']['name'] == "")
                {
                    unset($this->request->data['Shiftnote']['image']);
                }

                    if ($this->Shiftnote->save($this->request->data)) {

                        $options = array('conditions'=>['Shiftnote.id'=>$this->request->data['Shiftnote']['id']]);

                        $data = $this->Shiftnote->find('first', $options);
                        
                        $output = array(
                            "params" => $this->request,
                            "method" => $this->method,
                            "action" => "editNotes",
                            "status" => 1,
                            "data"=>$data,
                            //"user"=>$this->request->data,
                            "error" => array("validation" => "Notes Updated.")
                        );
                    } else {
                        $output = array(
                            "params" => $this->request,
                            "method" => $this->method,
                            "action" => "editNotes",
                            "status" => 0,
                            //"user"=>$this->request->data,
                            "error" => array("validation" => "Notes Update Fail. Please Try Again")
                        );
                    }

                    $this->set('output', $output);
                    $this->set(
                            array(
                                "_serialize" => array('output'),
                                "_jsonp"=>true
                            )
                    );

                }

            
            
            
                

    }

    public function viewNote($shiftId)
    {
       $options = array(
                        'conditions' => array('Shiftnote.' . $this->Shiftnote->primaryKey => $shiftId));
                    $shiftnote = $this->Shiftnote->find('first', $options);
                    $this->set('shiftnote', $shiftnote);
                    $this->set(
                            array(
                                    "_serialize" => array('shiftnote')
                                )
                    ); 
    }

    public function viewShiftnotes($shiftId)
    {
        $this->Shiftnote->Behaviors->load('Containable');

        $options = array(
            'conditions' => array('Shiftnote.shift_id' => $shiftId),
            'contain'=>false
            );

        $notes = $this->Shiftnote->find('first', $options);

        $status = 0;

        if(isset($notes) && !empty($notes))
        {
            $status = 1;
        }

        $this->set(array(
            'status'=>$status,
            'notes'=>$notes,
            '_serialize'=>['status', 'notes'],
            '_jsonp'=>true
            ));
    }

    public function listNotes($boardId)
    {


    	$this->Shiftnote->recursive = 0;
            $limit = 20;
            $this->paginate = array('conditions'=>array('Shiftnote.board_id'=>$boardId), 'limit'=>$limit);
      
            $shiftNotes = $this->Paginator->paginate();
            $page=$this->params['paging']['Shiftnote']['pageCount'];
            $currentPage = $this->params['paging']['Shiftnote']['page'];

            if (!empty($shiftNotes)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $output = array(
                "params" => $this->request,
                "method" => $this->method,
                "action" => "listNotes",
                "status" => $status,
                "currentPage" => $currentPage,
                "error" => array("validation" => "")
            );

            $this->set('output', $output);
            $this->set('shiftNotes', $shiftNotes);

            $this->set(
                    array(
                        "_serialize" => array('shiftNotes', 'output')
                    )
            );
    }

}