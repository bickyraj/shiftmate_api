<?php
App::uses('AppModel', 'Model');
/**
 * ShiftBoard Model
 *
 * @property Board $Board
 * @property Shift $Shift
 */
class ShiftBoard extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'board_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'shift_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Board' => array(
			'className' => 'Board',
			'foreignKey' => 'board_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Shift' => array(
			'className' => 'Shift',
			'foreignKey' => 'shift_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    
    /**
     * ShiftBoard::openShift()
     * 
     * @param int $org_id
     * @return
     */
    public function openShift($org_id){
        $this->Behaviors->load('Containable');
        return $this->find('all',array(
            'contain'=>array('Board',
                'Board.Organization',
                'Shift',
                'Shift.ShiftUser.User',
                'Shift.ShiftUser'=>array('conditions'=>array('shift_date'=>date('Y-m-d')))
            ),
            'conditions'=>array('Board.organization_id'=>$org_id,
                'ShiftBoard.shift_type'=>1,
                'ShiftBoard.start_date <='=>date('Y-m-d'),
                'ShiftBoard.end_date >='=>date('Y-m-d')
            )
        ));
        //return $this->find('all',array('contain'=>array('Board','Board.Organization','Shift','Shift.ShiftUser','Shift.ShiftUser.User'),'conditions'=>array('Board.organization_id'=>$org_id,'ShiftBoard.shift_type'=>1)));
    }
    
    /**
     * ShiftBoard::closedShift()
     * 
     * @param mixed $org_id
     * @param mixed $board_id
     * @return
     */
    public function closedShift($org_id,$board_id){
        $this->Behaviors->load('Containable');
        $results =  $this->find('all',array(
            'contain'=>array('Board',
                'Board.Organization',
                'Shift',
                'Shift.ShiftUser.User',
                'Shift.ShiftUser'=>array('conditions'=>array('shift_date'=>date('Y-m-d')))
            )
            ,
            'conditions'=>array('Board.id'=>$board_id,'Board.organization_id'=>$org_id,'ShiftBoard.shift_type'=>0)
        ));
        //debug($results);
        return $results;
        //return $this->find('all',array('contain'=>array('Board','Board.Organization','Shift','Shift.ShiftUser','Shift.ShiftUser.User'),'conditions'=>array('Board.id'=>$board_id,'Board.organization_id'=>$org_id,'ShiftBoard.shift_type'=>0)));
    }
    public function shiftListByShiftId($shiftId = null)
    {
        $this->recursive = -1;
        $shiftList = $this->find('all',array(
                'conditions' => array(
                        'ShiftBoard.shift_id' => $shiftId
                    )
            ));
        return $shiftList;
    }
}
