<?php
App::uses('AppModel', 'Model');
/**
 * ShiftUser Model
 *
 * @property Board $Board
 * @property Shift $Shift
 * @property User $User
 */
class Permanentshift extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	
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
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Day' => array(
			'className' => 'Day',
			'foreignKey' => 'day_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        public function myPermanentShifts($user_id = NULL){
            $this->Behaviors->load('Containable');
            $myPermanentShifts = $this->find('all', array(
                'contain'=>array(
                    'Shift',
                    'Shift.Organization' => array('fields'=>'Organization.title'),
                    'Day',
                    'Board'
                    ),
                'conditions'=>array(
                    'Permanentshift.user_id'=>$user_id,
                    'Permanentshift.status' => 1
                    )
            ));
            return $myPermanentShifts;
        }
        
        public function myPermanentShiftsRange($user_id = NULL, $start_date, $end_date){
            $this->Behaviors->load('Containable');
            $myPermanentShifts = $this->find('all', array(
                'contain'=>array(
                    'Shift',
                    'Shift.Organization' => array('fields'=>'Organization.title'),
                    'Day',
                    'Board',
                    'User',
                    'User.OrganizationUser'
                    )/*,
                'conditions'=>array(
                    'OR' => array(array(
                        'Permanentshift.start_date <=' => $start_date,
                        'Permanentshift.end_date >=' => $start_date,
                        'Permanentshift.end_date <' => $end_date
                    )),
                    'Permanentshift.user_id'=>$user_id,
                    
                    'Permanentshift.status' => 1
                    )*/
            ));
                       
            return $myPermanentShifts;
        }
}
