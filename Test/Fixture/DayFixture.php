<?php
/**
 * DayFixture
 *
 */
class DayFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'title' => 'Sunday'
		),
		array(
			'id' => '2',
			'title' => 'Monday'
		),
		array(
			'id' => '3',
			'title' => 'Tuesday'
		),
		array(
			'id' => '4',
			'title' => 'Wednesday'
		),
		array(
			'id' => '5',
			'title' => 'Thursday'
		),
		array(
			'id' => '6',
			'title' => 'Friday'
		),
		array(
			'id' => '7',
			'title' => 'Saturday'
		),
	);

}
