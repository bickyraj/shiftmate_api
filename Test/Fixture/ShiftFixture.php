<?php
/**
 * ShiftFixture
 *
 */
class ShiftFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'starttime' => array('type' => 'time', 'null' => false, 'default' => null),
		'endtime' => array('type' => 'time', 'null' => false, 'default' => null),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'organization_id' => '4',
			'title' => 'Morning Shift',
			'starttime' => '06:00:00',
			'endtime' => '10:00:00',
			'status' => '1'
		),
		array(
			'id' => '2',
			'organization_id' => '4',
			'title' => 'Day Shift',
			'starttime' => '10:00:00',
			'endtime' => '14:00:00',
			'status' => '1'
		),
		array(
			'id' => '3',
			'organization_id' => '5',
			'title' => 'Evening Shift',
			'starttime' => '14:00:00',
			'endtime' => '18:00:00',
			'status' => '1'
		),
		array(
			'id' => '4',
			'organization_id' => '4',
			'title' => 'Night Shift',
			'starttime' => '18:00:00',
			'endtime' => '22:00:00',
			'status' => '1'
		),
		array(
			'id' => '5',
			'organization_id' => '5',
			'title' => 'Morning Shift',
			'starttime' => '05:00:00',
			'endtime' => '11:00:00',
			'status' => '1'
		),
		array(
			'id' => '6',
			'organization_id' => '5',
			'title' => 'Day Shift',
			'starttime' => '11:00:00',
			'endtime' => '17:00:00',
			'status' => '1'
		),
		array(
			'id' => '7',
			'organization_id' => '5',
			'title' => 'Night Shift',
			'starttime' => '17:00:00',
			'endtime' => '23:00:00',
			'status' => '1'
		),
	);

}
