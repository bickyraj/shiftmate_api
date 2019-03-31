<?php
/**
 * ContactFixture
 *
 */
class ContactFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'contacttype_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'branch_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'fname' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'lname' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'phone' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 15, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'id' => '2',
			'contacttype_id' => '1',
			'organization_id' => '4',
			'branch_id' => '6',
			'fname' => 'ajay',
			'lname' => 'maharjan',
			'email' => 'ajay1@gmail.com',
			'phone' => '9800000021',
			'status' => '0'
		),
		array(
			'id' => '3',
			'contacttype_id' => '4',
			'organization_id' => '4',
			'branch_id' => '6',
			'fname' => 'raju',
			'lname' => 'lama',
			'email' => 'raj@gmail.com',
			'phone' => '9800000002',
			'status' => '0'
		),
		array(
			'id' => '5',
			'contacttype_id' => '2',
			'organization_id' => '4',
			'branch_id' => '6',
			'fname' => 'mithun',
			'lname' => 'kunwar',
			'email' => 'mitk@yahoo.com',
			'phone' => '980000000445',
			'status' => '0'
		),
		array(
			'id' => '6',
			'contacttype_id' => '1',
			'organization_id' => '4',
			'branch_id' => '6',
			'fname' => 'ramesh',
			'lname' => 'babu',
			'email' => 'ramu@yahoo.com',
			'phone' => '9800000005',
			'status' => '0'
		),
		array(
			'id' => '7',
			'contacttype_id' => '2',
			'organization_id' => '4',
			'branch_id' => '8',
			'fname' => 'ram',
			'lname' => 'lakhan',
			'email' => 'lakh@hotmail.com',
			'phone' => '9800000006',
			'status' => '0'
		),
		array(
			'id' => '8',
			'contacttype_id' => '5',
			'organization_id' => '4',
			'branch_id' => '6',
			'fname' => 'Hari',
			'lname' => 'Shrestha',
			'email' => 'hari@gmail.com',
			'phone' => '123123123',
			'status' => '0'
		),
	);

}
