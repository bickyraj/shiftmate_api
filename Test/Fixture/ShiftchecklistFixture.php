<?php
/**
 * ShiftchecklistFixture
 *
 */
class ShiftchecklistFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'board_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'shift_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'start_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'end_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'everyday' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'date', 'null' => false, 'default' => null),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '15',
			'board_id' => '10',
			'shift_id' => '14',
			'start_date' => '2015-06-30',
			'end_date' => '2015-07-31',
			'everyday' => '0',
			'created' => '2015-07-10',
			'status' => '0'
		),
		array(
			'id' => '16',
			'board_id' => '10',
			'shift_id' => '14',
			'start_date' => '2015-07-30',
			'end_date' => '2015-07-31',
			'everyday' => '0',
			'created' => '2015-07-10',
			'status' => '0'
		),
		array(
			'id' => '17',
			'board_id' => '10',
			'shift_id' => '14',
			'start_date' => '2015-07-01',
			'end_date' => '2015-07-16',
			'everyday' => '0',
			'created' => '2015-07-10',
			'status' => '0'
		),
		array(
			'id' => '18',
			'board_id' => '10',
			'shift_id' => '14',
			'start_date' => '2015-07-23',
			'end_date' => '2015-07-30',
			'everyday' => '0',
			'created' => '2015-07-10',
			'status' => '0'
		),
		array(
			'id' => '19',
			'board_id' => '10',
			'shift_id' => '14',
			'start_date' => '2015-07-08',
			'end_date' => '2015-07-24',
			'everyday' => '0',
			'created' => '2015-07-10',
			'status' => '0'
		),
		array(
			'id' => '20',
			'board_id' => '10',
			'shift_id' => '7',
			'start_date' => '2015-07-07',
			'end_date' => '2015-07-07',
			'everyday' => '0',
			'created' => '2015-07-12',
			'status' => '0'
		),
		array(
			'id' => '21',
			'board_id' => '10',
			'shift_id' => '7',
			'start_date' => '2015-07-08',
			'end_date' => '2015-07-24',
			'everyday' => '0',
			'created' => '2015-07-12',
			'status' => '0'
		),
		array(
			'id' => '22',
			'board_id' => '10',
			'shift_id' => '7',
			'start_date' => '2015-07-07',
			'end_date' => '2015-07-17',
			'everyday' => '0',
			'created' => '2015-07-12',
			'status' => '0'
		),
		array(
			'id' => '23',
			'board_id' => '10',
			'shift_id' => '7',
			'start_date' => '2015-07-02',
			'end_date' => '2015-07-31',
			'everyday' => '0',
			'created' => '2015-07-12',
			'status' => '0'
		),
	);

}
