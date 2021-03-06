<?php
/**
 * OrganizationFixture
 *
 */
class OrganizationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'logo' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'address' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'phone' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'fax' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'website' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'city_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'country_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'lat' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'long' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'day_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => 'start_week_on'),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'logo_dir' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'logo_type' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'logo_size' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'user_id' => '62',
			'title' => 'OnePlatinum',
			'logo' => '13.jpg',
			'address' => 'pulchowk',
			'email' => 'oneplatinum@gmail.com',
			'phone' => '9841414141',
			'fax' => '12345',
			'website' => 'oneplatinum.com.np',
			'city_id' => '1',
			'country_id' => '1',
			'lat' => '0',
			'long' => '1',
			'day_id' => '3',
			'status' => '1',
			'logo_dir' => '4',
			'logo_type' => 'image/jpeg',
			'logo_size' => '6146'
		),
		array(
			'id' => '5',
			'user_id' => '63',
			'title' => 'NTC',
			'logo' => '6.jpg',
			'address' => 'Sundhara',
			'email' => 'ntc@gmail.com',
			'phone' => '014444444',
			'fax' => '12345',
			'website' => 'ntc.com.np',
			'city_id' => '1',
			'country_id' => '1',
			'lat' => '0',
			'long' => '1',
			'day_id' => '1',
			'status' => '1',
			'logo_dir' => '5',
			'logo_type' => 'image/jpeg',
			'logo_size' => '6758'
		),
		array(
			'id' => '6',
			'user_id' => '64',
			'title' => 'WebHause',
			'logo' => '8.jpg',
			'address' => 'jamal',
			'email' => 'webhause@gmail.com',
			'phone' => '014567891',
			'fax' => '12345',
			'website' => 'webhause.com.np',
			'city_id' => '1',
			'country_id' => '1',
			'lat' => '0',
			'long' => '1',
			'day_id' => '1',
			'status' => '1',
			'logo_dir' => '6',
			'logo_type' => 'image/jpeg',
			'logo_size' => '5454'
		),
		array(
			'id' => '7',
			'user_id' => '77',
			'title' => '',
			'logo' => '',
			'address' => '',
			'email' => '',
			'phone' => '',
			'fax' => '',
			'website' => '',
			'city_id' => '0',
			'country_id' => '0',
			'lat' => '',
			'long' => '',
			'day_id' => '0',
			'status' => '0',
			'logo_dir' => '',
			'logo_type' => '',
			'logo_size' => ''
		),
		array(
			'id' => '8',
			'user_id' => '77',
			'title' => '',
			'logo' => '',
			'address' => '',
			'email' => '',
			'phone' => '',
			'fax' => '',
			'website' => '',
			'city_id' => '0',
			'country_id' => '0',
			'lat' => '',
			'long' => '',
			'day_id' => '0',
			'status' => '0',
			'logo_dir' => '',
			'logo_type' => '',
			'logo_size' => ''
		),
		array(
			'id' => '9',
			'user_id' => '77',
			'title' => '',
			'logo' => '',
			'address' => '',
			'email' => '',
			'phone' => '',
			'fax' => '',
			'website' => '',
			'city_id' => '0',
			'country_id' => '0',
			'lat' => '',
			'long' => '',
			'day_id' => '0',
			'status' => '0',
			'logo_dir' => '',
			'logo_type' => '',
			'logo_size' => ''
		),
		array(
			'id' => '10',
			'user_id' => '77',
			'title' => '',
			'logo' => '',
			'address' => '',
			'email' => '',
			'phone' => '',
			'fax' => '',
			'website' => '',
			'city_id' => '0',
			'country_id' => '0',
			'lat' => '',
			'long' => '',
			'day_id' => '0',
			'status' => '0',
			'logo_dir' => '',
			'logo_type' => '',
			'logo_size' => ''
		),
		array(
			'id' => '11',
			'user_id' => '77',
			'title' => '',
			'logo' => '',
			'address' => '',
			'email' => '',
			'phone' => '',
			'fax' => '',
			'website' => '',
			'city_id' => '0',
			'country_id' => '0',
			'lat' => '',
			'long' => '',
			'day_id' => '0',
			'status' => '0',
			'logo_dir' => '',
			'logo_type' => '',
			'logo_size' => ''
		),
		array(
			'id' => '12',
			'user_id' => '77',
			'title' => '',
			'logo' => '',
			'address' => '',
			'email' => '',
			'phone' => '',
			'fax' => '',
			'website' => '',
			'city_id' => '0',
			'country_id' => '0',
			'lat' => '',
			'long' => '',
			'day_id' => '0',
			'status' => '0',
			'logo_dir' => '',
			'logo_type' => '',
			'logo_size' => ''
		),
		array(
			'id' => '13',
			'user_id' => '77',
			'title' => '',
			'logo' => '',
			'address' => '',
			'email' => '',
			'phone' => '',
			'fax' => '',
			'website' => '',
			'city_id' => '0',
			'country_id' => '0',
			'lat' => '',
			'long' => '',
			'day_id' => '0',
			'status' => '0',
			'logo_dir' => '',
			'logo_type' => '',
			'logo_size' => ''
		),
	);

}
