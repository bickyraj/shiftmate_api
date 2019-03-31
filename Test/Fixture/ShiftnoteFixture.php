<?php
/**
 * ShiftnoteFixture
 *
 */
class ShiftnoteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'board_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'shift_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'start_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'end_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'notes' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'timestamp', 'null' => false),
		'image' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'image_dir' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'image_size' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'image_type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '19',
			'board_id' => '10',
			'shift_id' => '7',
			'start_date' => '2015-07-06',
			'end_date' => '2015-07-06',
			'notes' => 'new shift today',
			'status' => '0',
			'created' => '2015-07-07 17:22:33',
			'image' => '10-best-laptops_8z9p.640.jpg',
			'image_dir' => '19',
			'image_size' => '29882',
			'image_type' => 'image/jpeg'
		),
	);

}
