<?php
App::uses('AppModel', 'Model');
/**
 * Shiftnote Model
 */
class Shiftnote extends AppModel {

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
		'start_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'end_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'notes' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
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

		'created' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => false,
				'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),

		'image' => array(
                    'thumbnailSizes' => array(
                    'xvga' => '1024x768',
                    'vga' => '640x480',
                    'thumb' => '240x150'),

                    'rule' => 'isFileUpload',
                    'message' => 'File was missing from submission'
        )
	);

		public $actsAs = array(
        'Upload.Upload' => array(
            'image' => array(
                'fields' => array(
				                    'dir' => 'image_dir',
				                    'type' => 'image_type',
				                    'size' => 'image_size',
				                ),
                'thumbnailSizes' => array(
                    'thumb2' => '264x164'
                ),
                'x' =>  'x',
                'y'	=>	'y',
                'srcW' =>	'srcW',
                'srcH' =>	'srcH'
            )
        )
    );


public $belongsTo = array(
		'Shift' => array(
			'className' => 'Shift',
			'foreignKey' => 'shift_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Board' => array(
			'className' => 'Board',
			'foreignKey' => 'board_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

}