<?php
/**
 * ShiftBranchFixture
 *
 */
class ShiftBranchFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'shift_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'branch_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'status' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false),
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
			'id' => '29',
			'shift_id' => '14',
			'branch_id' => '6',
			'status' => '1'
		),
		array(
			'id' => '30',
			'shift_id' => '15',
			'branch_id' => '7',
			'status' => '1'
		),
		array(
			'id' => '31',
			'shift_id' => '16',
			'branch_id' => '6',
			'status' => '1'
		),
		array(
			'id' => '32',
			'shift_id' => '7',
			'branch_id' => '6',
			'status' => '1'
		),
		array(
			'id' => '33',
			'shift_id' => '17',
			'branch_id' => '6',
			'status' => '1'
		),
	);

}
