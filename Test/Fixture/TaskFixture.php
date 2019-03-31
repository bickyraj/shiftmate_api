<?php
/**
 * TaskFixture
 *
 */
class TaskFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'task' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'taskdate' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => '0=>\'Not Done\',1=>\'Done\''),
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
			'user_id' => '77',
			'task' => '<p>new task</p>
',
			'taskdate' => '0000-00-00 00:00:00',
			'created' => '2015-07-06 12:04:30',
			'status' => '0'
		),

		array(
			'id' => '7',
			'user_id' => '0',
			'task' => '<p>adasd</p>
',
			'taskdate' => '0000-00-00 00:00:00',
			'created' => '2015-07-07 07:55:55',
			'status' => '1'
		),
		array(
			'id' => '8',
			'user_id' => '0',
			'task' => '<p>asdasdasd</p>
',
			'taskdate' => '0000-00-00 00:00:00',
			'created' => '2015-07-07 07:57:20',
			'status' => '1'
		),

		array(
			'id' => '11',
			'user_id' => '0',
			'task' => '<p>I need to do task</p>
',
			'taskdate' => '0000-00-00 00:00:00',
			'created' => '2015-07-07 08:37:10',
			'status' => '1'
		),
	);

}
