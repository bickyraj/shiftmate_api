<?php
/**
 * CityFixture
 *
 */
class CityFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'country_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'country_id' => '1',
			'title' => 'Kathmandu',
			'status' => '1'
		),
		array(
			'id' => '2',
			'country_id' => '1',
			'title' => 'Pokhara',
			'status' => '1'
		),
		array(
			'id' => '3',
			'country_id' => '2',
			'title' => 'Sydney',
			'status' => '1'
		),
		array(
			'id' => '4',
			'country_id' => '2',
			'title' => 'Perth',
			'status' => '1'
		),
		array(
			'id' => '5',
			'country_id' => '2',
			'title' => 'Canberra',
			'status' => '1'
		),
	);

}
