<?php
/**
 * ShiftUserFixture
 *
 */
class ShiftUserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'board_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'shift_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'shift_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'check_status' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => '1=check in, 2= check out'),
		'earlytime' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'latetime' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'latestatus' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => '1=late'),
		'check_in_time' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'check_out_time' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'date', 'null' => false, 'default' => null),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => '0=> Open shift, 1=>manager assigned, 2=>employee request for shift, 3=>shift confirmed'),
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
	);

}
