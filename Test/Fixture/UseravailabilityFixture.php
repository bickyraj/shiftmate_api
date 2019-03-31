<?php
/**
 * UseravailabilityFixture
 *
 */
class UseravailabilityFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'day_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'starttime' => array('type' => 'time', 'null' => false, 'default' => null),
		'endtime' => array('type' => 'time', 'null' => false, 'default' => null),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'date' => array('type' => 'date', 'null' => false, 'default' => null, 'comment' => 'date is only for temporary user'),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => '0=>available, 1=> available in time selected, 2=> not available'),
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
			'id' => '90',
			'user_id' => '77',
			'day_id' => '5',
			'starttime' => '00:00:00',
			'endtime' => '00:00:00',
			'organization_id' => '0',
			'date' => '0000-00-00',
			'status' => '0'
		),
		array(
			'id' => '91',
			'user_id' => '77',
			'day_id' => '6',
			'starttime' => '00:00:00',
			'endtime' => '00:00:00',
			'organization_id' => '4',
			'date' => '0000-00-00',
			'status' => '0'
		),
		array(
			'id' => '137',
			'user_id' => '77',
			'day_id' => '4',
			'starttime' => '00:00:00',
			'endtime' => '00:00:00',
			'organization_id' => '0',
			'date' => '0000-00-00',
			'status' => '2'
		),
		array(
			'id' => '140',
			'user_id' => '77',
			'day_id' => '3',
			'starttime' => '00:00:00',
			'endtime' => '00:00:00',
			'organization_id' => '0',
			'date' => '0000-00-00',
			'status' => '0'
		),
		array(
			'id' => '272',
			'user_id' => '77',
			'day_id' => '7',
			'starttime' => '00:00:00',
			'endtime' => '00:00:00',
			'organization_id' => '0',
			'date' => '0000-00-00',
			'status' => '0'
		),
		array(
			'id' => '283',
			'user_id' => '77',
			'day_id' => '2',
			'starttime' => '00:00:00',
			'endtime' => '00:00:00',
			'organization_id' => '0',
			'date' => '0000-00-00',
			'status' => '0'
		),
		array(
			'id' => '289',
			'user_id' => '77',
			'day_id' => '5',
			'starttime' => '00:00:00',
			'endtime' => '00:00:00',
			'organization_id' => '0',
			'date' => '0000-00-00',
			'status' => '0'
		),
		array(
			'id' => '290',
			'user_id' => '77',
			'day_id' => '1',
			'starttime' => '00:00:00',
			'endtime' => '00:00:00',
			'organization_id' => '0',
			'date' => '0000-00-00',
			'status' => '0'
		),
	);

}
