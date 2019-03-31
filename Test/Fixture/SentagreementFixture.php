<?php
/**
 * SentagreementFixture
 *
 */
class SentagreementFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'jobagreement_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'date' => array('type' => 'date', 'null' => false, 'default' => null),
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
			'id' => '29',
			'jobagreement_id' => '12',
			'user_id' => '78',
			'organization_id' => '4',
			'date' => '2015-07-02'
		),
		array(
			'id' => '34',
			'jobagreement_id' => '12',
			'user_id' => '77',
			'organization_id' => '4',
			'date' => '2015-07-03'
		),
		array(
			'id' => '36',
			'jobagreement_id' => '7',
			'user_id' => '77',
			'organization_id' => '4',
			'date' => '2015-07-06'
		),
		array(
			'id' => '37',
			'jobagreement_id' => '7',
			'user_id' => '78',
			'organization_id' => '4',
			'date' => '2015-07-03'
		),
	);

}
