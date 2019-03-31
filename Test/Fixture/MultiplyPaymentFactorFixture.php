<?php
/**
 * MultiplyPaymentFactorFixture
 *
 */
class MultiplyPaymentFactorFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'branch_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'shift_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'multiplypaymentfactortype_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'multiply_factor' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '11,2', 'unsigned' => false),
		'implement_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'end_date' => array('type' => 'date', 'null' => false, 'default' => null),
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
			'id' => '18',
			'organization_id' => '4',
			'branch_id' => '6',
			'shift_id' => '0',
			'multiplypaymentfactortype_id' => '3',
			'multiply_factor' => '10.00',
			'implement_date' => '2015-05-28',
			'end_date' => '2015-05-31',
			'status' => '1'
		),
		array(
			'id' => '19',
			'organization_id' => '4',
			'branch_id' => '6',
			'shift_id' => '0',
			'multiplypaymentfactortype_id' => '6',
			'multiply_factor' => '2.00',
			'implement_date' => '2015-12-12',
			'end_date' => '2016-12-12',
			'status' => '1'
		),
		array(
			'id' => '20',
			'organization_id' => '4',
			'branch_id' => '6',
			'shift_id' => '0',
			'multiplypaymentfactortype_id' => '4',
			'multiply_factor' => '23.00',
			'implement_date' => '2015-06-01',
			'end_date' => '2015-06-30',
			'status' => '1'
		),
		array(
			'id' => '21',
			'organization_id' => '4',
			'branch_id' => '6',
			'shift_id' => '14',
			'multiplypaymentfactortype_id' => '6',
			'multiply_factor' => '34.00',
			'implement_date' => '2015-06-15',
			'end_date' => '2015-06-29',
			'status' => '1'
		),
		array(
			'id' => '22',
			'organization_id' => '4',
			'branch_id' => '6',
			'shift_id' => '7',
			'multiplypaymentfactortype_id' => '6',
			'multiply_factor' => '3434.00',
			'implement_date' => '2015-06-15',
			'end_date' => '2015-06-17',
			'status' => '1'
		),
		array(
			'id' => '23',
			'organization_id' => '4',
			'branch_id' => '6',
			'shift_id' => '14',
			'multiplypaymentfactortype_id' => '6',
			'multiply_factor' => '34.00',
			'implement_date' => '2015-06-08',
			'end_date' => '2015-06-18',
			'status' => '1'
		),
		array(
			'id' => '24',
			'organization_id' => '4',
			'branch_id' => '6',
			'shift_id' => '0',
			'multiplypaymentfactortype_id' => '3',
			'multiply_factor' => '12.00',
			'implement_date' => '2015-06-08',
			'end_date' => '2015-06-17',
			'status' => '1'
		),
		array(
			'id' => '25',
			'organization_id' => '4',
			'branch_id' => '6',
			'shift_id' => '0',
			'multiplypaymentfactortype_id' => '4',
			'multiply_factor' => '232.00',
			'implement_date' => '2015-06-15',
			'end_date' => '2015-06-24',
			'status' => '1'
		),
		array(
			'id' => '26',
			'organization_id' => '4',
			'branch_id' => '6',
			'shift_id' => '0',
			'multiplypaymentfactortype_id' => '3',
			'multiply_factor' => '10.00',
			'implement_date' => '2015-06-26',
			'end_date' => '2015-06-30',
			'status' => '1'
		),
	);

}
