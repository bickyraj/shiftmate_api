<?php
/**
 * ShiftplanUserFixture
 *
 */
class ShiftplanUserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'shiftplan_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'shift_user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'createddate' => array('type' => 'timestamp', 'null' => false),
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
			'id' => '1',
			'shiftplan_id' => '2',
			'shift_user_id' => '36',
			'createddate' => '2015-07-10 13:14:46'
		),
		array(
			'id' => '2',
			'shiftplan_id' => '0',
			'shift_user_id' => '37',
			'createddate' => '2015-07-10 13:14:46'
		),
		array(
			'id' => '3',
			'shiftplan_id' => '0',
			'shift_user_id' => '38',
			'createddate' => '2015-07-10 16:23:15'
		),
		array(
			'id' => '4',
			'shiftplan_id' => '0',
			'shift_user_id' => '39',
			'createddate' => '2015-07-10 16:32:32'
		),
		array(
			'id' => '5',
			'shiftplan_id' => '0',
			'shift_user_id' => '40',
			'createddate' => '2015-07-10 16:38:51'
		),
		array(
			'id' => '6',
			'shiftplan_id' => '2',
			'shift_user_id' => '41',
			'createddate' => '2015-07-10 16:49:19'
		),
		array(
			'id' => '7',
			'shiftplan_id' => '2',
			'shift_user_id' => '42',
			'createddate' => '2015-07-10 16:49:19'
		),
		array(
			'id' => '8',
			'shiftplan_id' => '2',
			'shift_user_id' => '43',
			'createddate' => '2015-07-12 11:49:16'
		),
		array(
			'id' => '9',
			'shiftplan_id' => '2',
			'shift_user_id' => '44',
			'createddate' => '2015-07-12 11:49:16'
		),
	);

}
