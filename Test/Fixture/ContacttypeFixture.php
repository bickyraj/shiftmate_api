<?php
/**
 * ContacttypeFixture
 *
 */
class ContacttypeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'branch_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
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
			'branch_id' => '6',
			'title' => 'Electrician',
			'status' => '0'
		),
		array(
			'id' => '2',
			'organization_id' => '4',
			'branch_id' => '6',
			'title' => 'Plumber',
			'status' => '0'
		),
		array(
			'id' => '4',
			'organization_id' => '4',
			'branch_id' => '6',
			'title' => 'Carpenter',
			'status' => '0'
		),
		array(
			'id' => '5',
			'organization_id' => '4',
			'branch_id' => '6',
			'title' => 'Mechanics',
			'status' => '0'
		),
	);

}
