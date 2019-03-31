<?php
/**
 * AccountFixture
 *
 */
class AccountFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'account';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'shift_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'date' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'workingminutes' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'paymentfactor' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '11,2', 'unsigned' => false),
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
			'id' => 1,
			'organization_id' => 1,
			'user_id' => 1,
			'shift_id' => 1,
			'date' => '2015-11-19 10:35:24',
			'workingminutes' => 1,
			'paymentfactor' => 1
		),
	);

}
