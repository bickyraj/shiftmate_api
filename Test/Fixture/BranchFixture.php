<?php
/**
 * BranchFixture
 *
 */
class BranchFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'phone' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'fax' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'address' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'city_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'country_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'lat' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'long' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'id' => '6',
			'organization_id' => '4',
			'user_id' => '62',
			'title' => 'One Platinum(Kathmandu Branch)',
			'phone' => '014444444555',
			'fax' => '12345',
			'email' => 'oneplatinum@gmail.com',
			'address' => 'pulchowk',
			'city_id' => '1',
			'country_id' => '1',
			'lat' => '000',
			'long' => '000',
			'status' => '1'
		),
		array(
			'id' => '7',
			'organization_id' => '5',
			'user_id' => '63',
			'title' => 'NTC(Kathmandu Branch )',
			'phone' => '014444444',
			'fax' => '12345',
			'email' => 'ntc@gmail.com',
			'address' => 'sundhara',
			'city_id' => '1',
			'country_id' => '1',
			'lat' => '000',
			'long' => '000',
			'status' => '1'
		),
	);

}
