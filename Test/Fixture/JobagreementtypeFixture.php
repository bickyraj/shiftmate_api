<?php
/**
 * JobagreementtypeFixture
 *
 */
class JobagreementtypeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'date' => array('type' => 'date', 'null' => false, 'default' => null),
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
			'type' => 'first15',
			'date' => '2015-07-03',
			'status' => '0'
		),
		array(
			'id' => '2',
			'type' => 'second',
			'date' => '2015-06-12',
			'status' => '0'
		),
		array(
			'id' => '3',
			'type' => 'type3',
			'date' => '0000-00-00',
			'status' => '0'
		),
		array(
			'id' => '5',
			'type' => 'type4',
			'date' => '0000-00-00',
			'status' => '0'
		),
		array(
			'id' => '6',
			'type' => 'type5',
			'date' => '0000-00-00',
			'status' => '0'
		),
		array(
			'id' => '7',
			'type' => 'type5',
			'date' => '0000-00-00',
			'status' => '0'
		),
		array(
			'id' => '8',
			'type' => 'new ',
			'date' => '0000-00-00',
			'status' => '0'
		),
		array(
			'id' => '9',
			'type' => 'new ',
			'date' => '0000-00-00',
			'status' => '0'
		),
		array(
			'id' => '10',
			'type' => 'new ',
			'date' => '0000-00-00',
			'status' => '0'
		),
		array(
			'id' => '11',
			'type' => 'new',
			'date' => '2015-07-02',
			'status' => '0'
		),
	);

}
