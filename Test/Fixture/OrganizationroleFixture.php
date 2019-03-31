<?php
/**
 * OrganizationroleFixture
 *
 */
class OrganizationroleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'id' => '14',
			'organization_id' => '4',
			'title' => 'manager',
			'status' => '1'
		),
		array(
			'id' => '15',
			'organization_id' => '4',
			'title' => 'designer',
			'status' => '1'
		),
		array(
			'id' => '16',
			'organization_id' => '4',
			'title' => 'developer',
			'status' => '1'
		),
		array(
			'id' => '17',
			'organization_id' => '5',
			'title' => 'Manager',
			'status' => '1'
		),
		array(
			'id' => '18',
			'organization_id' => '5',
			'title' => 'employee',
			'status' => '1'
		),
		array(
			'id' => '19',
			'organization_id' => '4',
			'title' => 'manager',
			'status' => '1'
		),
		array(
			'id' => '20',
			'organization_id' => '4',
			'title' => 'this is test',
			'status' => '1'
		),
		array(
			'id' => '21',
			'organization_id' => '4',
			'title' => 'test',
			'status' => '1'
		),
	);

}
