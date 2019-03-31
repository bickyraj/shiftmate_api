<?php
/**
 * MultiplypaymentfactortypeFixture
 *
 */
class MultiplypaymentfactortypeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'id' => '3',
			'organization_id' => '4',
			'title' => 'sunday'
		),
		array(
			'id' => '4',
			'organization_id' => '4',
			'title' => 'monday'
		),
		array(
			'id' => '5',
			'organization_id' => '4',
			'title' => 'tuesday'
		),
		array(
			'id' => '6',
			'organization_id' => '4',
			'title' => 'shift'
		),
		array(
			'id' => '7',
			'organization_id' => '4',
			'title' => 'this is test'
		),
		array(
			'id' => '8',
			'organization_id' => '4',
			'title' => 'test123'
		),
	);

}
