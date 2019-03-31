<?php
/**
 * BoardUserFixture
 *
 */
class BoardUserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'board_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'id' => '4',
			'board_id' => '10',
			'user_id' => '77',
			'status' => '1'
		),
		array(
			'id' => '5',
			'board_id' => '11',
			'user_id' => '78',
			'status' => '1'
		),
		array(
			'id' => '6',
			'board_id' => '10',
			'user_id' => '78',
			'status' => '1'
		),
	);

}
