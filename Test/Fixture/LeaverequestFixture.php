<?php
/**
 * LeaverequestFixture
 *
 */
class LeaverequestFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'leavetype_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'startdate' => array('type' => 'date', 'null' => false, 'default' => null),
		'enddate' => array('type' => 'date', 'null' => false, 'default' => null),
		'detail' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'image' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'board_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'branch_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'requestdate' => array('type' => 'timestamp', 'null' => false),
		'image_dir' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'image_type' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'image_size' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'user_id' => '62',
			'leavetype_id' => '1',
			'startdate' => '0000-00-00',
			'enddate' => '2015-06-22',
			'detail' => 'i can\'t come',
			'image' => 'default.jpg',
			'status' => '0',
			'organization_id' => '1',
			'board_id' => '1',
			'branch_id' => '1',
			'requestdate' => '2015-06-22 17:13:01',
			'image_dir' => '',
			'image_type' => '',
			'image_size' => '0'
		),
		array(
			'id' => '2',
			'user_id' => '0',
			'leavetype_id' => '0',
			'startdate' => '0000-00-00',
			'enddate' => '0000-00-00',
			'detail' => '',
			'image' => 'default.jpg',
			'status' => '0',
			'organization_id' => '0',
			'board_id' => '0',
			'branch_id' => '0',
			'requestdate' => '2015-06-23 11:12:05',
			'image_dir' => '',
			'image_type' => '',
			'image_size' => '0'
		),
		array(
			'id' => '3',
			'user_id' => '0',
			'leavetype_id' => '0',
			'startdate' => '0000-00-00',
			'enddate' => '0000-00-00',
			'detail' => '',
			'image' => 'default.jpg',
			'status' => '0',
			'organization_id' => '0',
			'board_id' => '0',
			'branch_id' => '0',
			'requestdate' => '2015-06-23 11:15:41',
			'image_dir' => '',
			'image_type' => '',
			'image_size' => '0'
		),
		array(
			'id' => '4',
			'user_id' => '77',
			'leavetype_id' => '1',
			'startdate' => '0000-00-00',
			'enddate' => '0000-00-00',
			'detail' => 'bla bla happens',
			'image' => 'default.jpg',
			'status' => '1',
			'organization_id' => '4',
			'board_id' => '10',
			'branch_id' => '6',
			'requestdate' => '2015-06-23 16:10:12',
			'image_dir' => '',
			'image_type' => '',
			'image_size' => '0'
		),
		array(
			'id' => '5',
			'user_id' => '77',
			'leavetype_id' => '1',
			'startdate' => '2015-06-02',
			'enddate' => '2015-06-02',
			'detail' => 'bla bla happens so i can\'t come',
			'image' => 'default.jpg',
			'status' => '0',
			'organization_id' => '4',
			'board_id' => '10',
			'branch_id' => '6',
			'requestdate' => '2015-06-23 16:14:47',
			'image_dir' => '',
			'image_type' => '',
			'image_size' => '0'
		),
		array(
			'id' => '6',
			'user_id' => '77',
			'leavetype_id' => '1',
			'startdate' => '2015-06-26',
			'enddate' => '2015-06-26',
			'detail' => 'i am not feeling well today',
			'image' => 'default.jpg',
			'status' => '0',
			'organization_id' => '4',
			'board_id' => '10',
			'branch_id' => '6',
			'requestdate' => '2015-06-23 16:23:02',
			'image_dir' => '',
			'image_type' => '',
			'image_size' => '0'
		),
		array(
			'id' => '7',
			'user_id' => '77',
			'leavetype_id' => '1',
			'startdate' => '2015-06-26',
			'enddate' => '2015-06-26',
			'detail' => 'i am not feeling well today',
			'image' => 'default.jpg',
			'status' => '0',
			'organization_id' => '4',
			'board_id' => '10',
			'branch_id' => '6',
			'requestdate' => '2015-06-23 16:24:14',
			'image_dir' => '',
			'image_type' => '',
			'image_size' => '0'
		),
		array(
			'id' => '8',
			'user_id' => '77',
			'leavetype_id' => '1',
			'startdate' => '2015-06-26',
			'enddate' => '2015-06-26',
			'detail' => 'i am not feeling well today',
			'image' => 'default.jpg',
			'status' => '0',
			'organization_id' => '4',
			'board_id' => '10',
			'branch_id' => '6',
			'requestdate' => '2015-06-23 16:39:50',
			'image_dir' => '',
			'image_type' => '',
			'image_size' => '0'
		),
		array(
			'id' => '9',
			'user_id' => '77',
			'leavetype_id' => '1',
			'startdate' => '2015-06-26',
			'enddate' => '2015-06-26',
			'detail' => 'i am not feeling well today',
			'image' => 'default.jpg',
			'status' => '0',
			'organization_id' => '4',
			'board_id' => '10',
			'branch_id' => '6',
			'requestdate' => '2015-06-23 16:40:09',
			'image_dir' => '',
			'image_type' => '',
			'image_size' => '0'
		),
		array(
			'id' => '10',
			'user_id' => '77',
			'leavetype_id' => '1',
			'startdate' => '2015-06-26',
			'enddate' => '2015-06-26',
			'detail' => 'i am not feeling well today',
			'image' => 'default.jpg',
			'status' => '0',
			'organization_id' => '4',
			'board_id' => '10',
			'branch_id' => '6',
			'requestdate' => '2015-06-23 11:27:56',
			'image_dir' => '',
			'image_type' => '',
			'image_size' => '0'
		),
	);

}
