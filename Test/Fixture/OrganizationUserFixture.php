<?php
/**
 * OrganizationUserFixture
 *
 */
class OrganizationUserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'branch_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'organizationrole_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'designation' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'hire_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'wage' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'max_weekly_hour' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'id' => '14',
			'organization_id' => '4',
			'user_id' => '77',
			'branch_id' => '6',
			'organizationrole_id' => '14',
			'designation' => 'developer',
			'hire_date' => '2015-05-28',
			'wage' => '50',
			'max_weekly_hour' => '60',
			'status' => '1'
		),
		array(
			'id' => '15',
			'organization_id' => '4',
			'user_id' => '78',
			'branch_id' => '6',
			'organizationrole_id' => '16',
			'designation' => 'developer',
			'hire_date' => '2015-05-28',
			'wage' => '40',
			'max_weekly_hour' => '50',
			'status' => '1'
		),
		array(
			'id' => '16',
			'organization_id' => '5',
			'user_id' => '76',
			'branch_id' => '7',
			'organizationrole_id' => '17',
			'designation' => 'developer ',
			'hire_date' => '2015-06-10',
			'wage' => '50',
			'max_weekly_hour' => '50',
			'status' => '1'
		),
		array(
			'id' => '17',
			'organization_id' => '5',
			'user_id' => '77',
			'branch_id' => '7',
			'organizationrole_id' => '18',
			'designation' => 'developer',
			'hire_date' => '2015-06-10',
			'wage' => '30',
			'max_weekly_hour' => '40',
			'status' => '0'
		),
	);

}
