<?php
/**
 * OrganizationfunctionFixture
 *
 */
class OrganizationfunctionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'branch_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'function_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'note' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => '0=>public holiday, 1=> event'),
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
			'id' => '11',
			'organization_id' => '4',
			'branch_id' => '6',
			'function_date' => '2015-05-29',
			'note' => '                                                                        last saturday                                                               ',
			'status' => '0'
		),
		array(
			'id' => '12',
			'organization_id' => '4',
			'branch_id' => '6',
			'function_date' => '2015-05-30',
			'note' => 'public holiday',
			'status' => '0'
		),
		array(
			'id' => '20',
			'organization_id' => '4',
			'branch_id' => '6',
			'function_date' => '2015-06-26',
			'note' => 'Gathasthapana',
			'status' => '0'
		),
		array(
			'id' => '21',
			'organization_id' => '4',
			'branch_id' => '6',
			'function_date' => '2015-06-18',
			'note' => 'Annual Anniversary',
			'status' => '0'
		),
		array(
			'id' => '22',
			'organization_id' => '4',
			'branch_id' => '6',
			'function_date' => '2015-12-25',
			'note' => '                                    Merry Christmas                                ',
			'status' => '0'
		),
		array(
			'id' => '23',
			'organization_id' => '4',
			'branch_id' => '6',
			'function_date' => '2015-06-26',
			'note' => 'this is test',
			'status' => '0'
		),
		array(
			'id' => '24',
			'organization_id' => '4',
			'branch_id' => '6',
			'function_date' => '2015-06-27',
			'note' => 'hello',
			'status' => '0'
		),
		array(
			'id' => '25',
			'organization_id' => '4',
			'branch_id' => '6',
			'function_date' => '2015-06-27',
			'note' => 'test of 2015/06/26',
			'status' => '0'
		),
		array(
			'id' => '26',
			'organization_id' => '4',
			'branch_id' => '6',
			'function_date' => '2015-06-27',
			'note' => 'test of 2015/06/26',
			'status' => '0'
		),
	);

}
