<?php
/**
 * LeaveholidayFixture
 *
 */
class LeaveholidayFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'branch_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'board_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'start_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'end_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'note' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'requested_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'approved_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'approved_by' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => 'user_id'),
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
			'id' => '30',
			'organization_id' => '4',
			'user_id' => '78',
			'branch_id' => '6',
			'board_id' => '10',
			'start_date' => '2015-06-12',
			'end_date' => '2010-01-01',
			'note' => 'sick leave',
			'requested_date' => '2015-06-11',
			'approved_date' => '2010-01-01',
			'approved_by' => '0',
			'status' => '1'
		),
		array(
			'id' => '43',
			'organization_id' => '4',
			'user_id' => '77',
			'branch_id' => '6',
			'board_id' => '10',
			'start_date' => '2015-06-02',
			'end_date' => '2010-01-01',
			'note' => 'Sick',
			'requested_date' => '2015-06-24',
			'approved_date' => '2010-01-01',
			'approved_by' => '0',
			'status' => '1'
		),
		array(
			'id' => '49',
			'organization_id' => '4',
			'user_id' => '77',
			'branch_id' => '6',
			'board_id' => '10',
			'start_date' => '2015-06-01',
			'end_date' => '2010-01-01',
			'note' => 'zxcvzxcvzxcvxzcvxzcv',
			'requested_date' => '2015-06-25',
			'approved_date' => '2010-01-01',
			'approved_by' => '0',
			'status' => '1'
		),
		array(
			'id' => '50',
			'organization_id' => '4',
			'user_id' => '77',
			'branch_id' => '6',
			'board_id' => '10',
			'start_date' => '2015-06-02',
			'end_date' => '2010-01-01',
			'note' => 'asdfasdfsadf',
			'requested_date' => '2015-06-25',
			'approved_date' => '2010-01-01',
			'approved_by' => '0',
			'status' => '0'
		),
		array(
			'id' => '51',
			'organization_id' => '4',
			'user_id' => '77',
			'branch_id' => '6',
			'board_id' => '10',
			'start_date' => '2015-06-02',
			'end_date' => '2010-01-01',
			'note' => 'I have a headache.',
			'requested_date' => '2015-06-28',
			'approved_date' => '2010-01-01',
			'approved_by' => '0',
			'status' => '0'
		),
		array(
			'id' => '52',
			'organization_id' => '4',
			'user_id' => '77',
			'branch_id' => '6',
			'board_id' => '10',
			'start_date' => '0000-00-00',
			'end_date' => '2010-01-01',
			'note' => 'hjjhg',
			'requested_date' => '2015-06-28',
			'approved_date' => '2010-01-01',
			'approved_by' => '0',
			'status' => '0'
		),
		array(
			'id' => '53',
			'organization_id' => '4',
			'user_id' => '77',
			'branch_id' => '6',
			'board_id' => '10',
			'start_date' => '2015-06-08',
			'end_date' => '2010-01-01',
			'note' => 'This is me.',
			'requested_date' => '2015-06-28',
			'approved_date' => '2010-01-01',
			'approved_by' => '0',
			'status' => '0'
		),
		array(
			'id' => '54',
			'organization_id' => '4',
			'user_id' => '77',
			'branch_id' => '6',
			'board_id' => '10',
			'start_date' => '2015-06-30',
			'end_date' => '2010-01-01',
			'note' => 'test',
			'requested_date' => '2015-06-29',
			'approved_date' => '2010-01-01',
			'approved_by' => '0',
			'status' => '0'
		),
	);

}
