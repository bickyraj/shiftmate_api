<?php
/**
 * MessageFixture
 *
 */
class MessageFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'from' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => 'user_id'),
		'to' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => 'user_id'),
		'content' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'date_time' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'viewdate' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => '0=> deleted message, 1 => send message, 2=> viewed message, 3=> delete by sender, 4=> deleted by receiver'),
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
			'id' => '3',
			'parent_id' => '0',
			'organization_id' => '6',
			'from' => '78',
			'to' => '77',
			'content' => 'hi ajay',
			'date_time' => '2015-06-30 15:21:52',
			'viewdate' => '0000-00-00 00:00:00',
			'status' => '1'
		),
		array(
			'id' => '4',
			'parent_id' => '0',
			'organization_id' => '0',
			'from' => '77',
			'to' => '78',
			'content' => 'Hello shyam k xa??',
			'date_time' => '2015-06-30 16:55:53',
			'viewdate' => '0000-00-00 00:00:00',
			'status' => '1'
		),
		array(
			'id' => '5',
			'parent_id' => '0',
			'organization_id' => '0',
			'from' => '77',
			'to' => '78',
			'content' => 'hello k xa<br>',
			'date_time' => '2015-06-30 16:59:42',
			'viewdate' => '0000-00-00 00:00:00',
			'status' => '1'
		),
		array(
			'id' => '6',
			'parent_id' => '0',
			'organization_id' => '0',
			'from' => '78',
			'to' => '77',
			'content' => 'hello ajay where arre yo',
			'date_time' => '2015-06-30 18:47:40',
			'viewdate' => '0000-00-00 00:00:00',
			'status' => '1'
		),
		array(
			'id' => '7',
			'parent_id' => '0',
			'organization_id' => '0',
			'from' => '77',
			'to' => '78',
			'content' => 'Hello k xa bro',
			'date_time' => '2015-07-01 07:11:53',
			'viewdate' => '0000-00-00 00:00:00',
			'status' => '1'
		),
		array(
			'id' => '8',
			'parent_id' => '0',
			'organization_id' => '0',
			'from' => '77',
			'to' => '78',
			'content' => 'image done',
			'date_time' => '2015-07-01 08:54:12',
			'viewdate' => '0000-00-00 00:00:00',
			'status' => '1'
		),
		array(
			'id' => '9',
			'parent_id' => '0',
			'organization_id' => '0',
			'from' => '77',
			'to' => '78',
			'content' => 'What are you doning<br>',
			'date_time' => '2015-07-01 09:01:59',
			'viewdate' => '0000-00-00 00:00:00',
			'status' => '1'
		),
		array(
			'id' => '10',
			'parent_id' => '0',
			'organization_id' => '0',
			'from' => '77',
			'to' => '78',
			'content' => 'hello',
			'date_time' => '2015-07-01 13:19:43',
			'viewdate' => '0000-00-00 00:00:00',
			'status' => '1'
		),
		array(
			'id' => '11',
			'parent_id' => '0',
			'organization_id' => '0',
			'from' => '62',
			'to' => '78',
			'content' => 'hello',
			'date_time' => '2015-07-02 18:52:32',
			'viewdate' => '0000-00-00 00:00:00',
			'status' => '1'
		),
		array(
			'id' => '12',
			'parent_id' => '0',
			'organization_id' => '4',
			'from' => '62',
			'to' => '78',
			'content' => 'hello<br><br>',
			'date_time' => '2015-07-02 18:52:58',
			'viewdate' => '0000-00-00 00:00:00',
			'status' => '1'
		),
	);

}
