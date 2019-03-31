<?php
/**
 * ShiftBoardFixture
 *
 */
class ShiftBoardFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'board_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'shift_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'board_id' => '10',
			'shift_id' => '7',
			'status' => '1'
		),
		array(
			'id' => '2',
			'board_id' => '10',
			'shift_id' => '14',
			'status' => '1'
		),
	);

}
