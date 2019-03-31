<?php
/**
 * OrganizationmessageFixture
 *
 */
class OrganizationmessageFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => 'from'),
		'content' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'date_time' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'parent_id' => '0',
			'organization_id' => '4',
			'user_id' => '77',
			'content' => 'hello',
			'date_time' => '2015-06-23 10:01:49',
			'status' => '1'
		),
		array(
			'id' => '2',
			'parent_id' => '0',
			'organization_id' => '4',
			'user_id' => '77',
			'content' => 'Bicky how are you doing.',
			'date_time' => '2015-06-25 11:29:13',
			'status' => '1'
		),
		array(
			'id' => '3',
			'parent_id' => '0',
			'organization_id' => '4',
			'user_id' => '78',
			'content' => 'Hello bicky',
			'date_time' => '2015-06-25 13:58:36',
			'status' => '1'
		),
		array(
			'id' => '4',
			'parent_id' => '0',
			'organization_id' => '0',
			'user_id' => '77',
			'content' => '',
			'date_time' => '2015-06-29 12:49:36',
			'status' => '1'
		),
		array(
			'id' => '5',
			'parent_id' => '0',
			'organization_id' => '0',
			'user_id' => '77',
			'content' => '',
			'date_time' => '2015-06-29 18:46:01',
			'status' => '1'
		),
		array(
			'id' => '6',
			'parent_id' => '0',
			'organization_id' => '0',
			'user_id' => '77',
			'content' => '',
			'date_time' => '2015-06-30 11:56:08',
			'status' => '1'
		),
		array(
			'id' => '7',
			'parent_id' => '0',
			'organization_id' => '0',
			'user_id' => '77',
			'content' => '',
			'date_time' => '2015-06-30 11:56:23',
			'status' => '1'
		),
		array(
			'id' => '8',
			'parent_id' => '0',
			'organization_id' => '0',
			'user_id' => '77',
			'content' => '',
			'date_time' => '2015-06-30 12:02:58',
			'status' => '1'
		),
		array(
			'id' => '9',
			'parent_id' => '0',
			'organization_id' => '0',
			'user_id' => '77',
			'content' => '',
			'date_time' => '2015-06-30 12:03:11',
			'status' => '1'
		),
		array(
			'id' => '10',
			'parent_id' => '0',
			'organization_id' => '0',
			'user_id' => '77',
			'content' => '',
			'date_time' => '2015-06-30 12:08:21',
			'status' => '1'
		),
	);

}
