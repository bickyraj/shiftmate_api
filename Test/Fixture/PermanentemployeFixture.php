<?php
/**
 * PermanentemployeFixture
 *
 */
class PermanentemployeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'organization_user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'day_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'starttime' => array('type' => 'time', 'null' => false, 'default' => null),
		'endtime' => array('type' => 'time', 'null' => false, 'default' => null),
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
			'id' => '1',
			'organization_user_id' => '14',
			'day_id' => '2',
			'starttime' => '03:40:00',
			'endtime' => '03:40:00',
			'status' => '0'
		),
		array(
			'id' => '2',
			'organization_user_id' => '14',
			'day_id' => '7',
			'starttime' => '03:40:00',
			'endtime' => '03:40:00',
			'status' => '0'
		),
		array(
			'id' => '3',
			'organization_user_id' => '14',
			'day_id' => '1',
			'starttime' => '04:00:00',
			'endtime' => '04:00:00',
			'status' => '0'
		),
		array(
			'id' => '4',
			'organization_user_id' => '14',
			'day_id' => '2',
			'starttime' => '04:00:00',
			'endtime' => '04:00:00',
			'status' => '0'
		),
		array(
			'id' => '5',
			'organization_user_id' => '14',
			'day_id' => '3',
			'starttime' => '02:35:00',
			'endtime' => '03:40:00',
			'status' => '0'
		),
		array(
			'id' => '6',
			'organization_user_id' => '14',
			'day_id' => '1',
			'starttime' => '05:15:00',
			'endtime' => '05:15:00',
			'status' => '0'
		),
		array(
			'id' => '7',
			'organization_user_id' => '14',
			'day_id' => '2',
			'starttime' => '05:15:00',
			'endtime' => '05:15:00',
			'status' => '0'
		),
		array(
			'id' => '8',
			'organization_user_id' => '14',
			'day_id' => '3',
			'starttime' => '05:15:00',
			'endtime' => '05:15:00',
			'status' => '0'
		),
		array(
			'id' => '9',
			'organization_user_id' => '14',
			'day_id' => '4',
			'starttime' => '05:15:00',
			'endtime' => '05:15:00',
			'status' => '0'
		),
		array(
			'id' => '10',
			'organization_user_id' => '14',
			'day_id' => '5',
			'starttime' => '05:15:00',
			'endtime' => '05:15:00',
			'status' => '0'
		),
	);

}
