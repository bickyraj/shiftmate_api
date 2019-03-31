<?php
/**
 * UserInductionFixture
 *
 */
class UserInductionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'induction_task' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'id' => '1',
			'organization_id' => '5',
			'induction_task' => 'hello',
			'created_date' => '2015-07-06',
			'status' => '1'
		),
		array(
			'id' => '2',
			'organization_id' => '5',
			'induction_task' => 'Using javascript, how can we auto insert the current DATE and TIME into a form input field.

I\'m building a "Problems" form to keep track of user submitted complaints about a certain service. I\'m collecting as much info as possible. I want to save the staff here from having to manually enter the date and time each time they open the form',
			'created_date' => '2015-07-06',
			'status' => '0'
		),
		array(
			'id' => '3',
			'organization_id' => '4',
			'induction_task' => 'hello helo',
			'created_date' => '2015-07-06',
			'status' => '2'
		),
		array(
			'id' => '4',
			'organization_id' => '5',
			'induction_task' => '
Sending date and time form fields to MySQL with PHP',
			'created_date' => '2015-07-06',
			'status' => '1'
		),
		array(
			'id' => '5',
			'organization_id' => '5',
			'induction_task' => 'Not to make toilets dirty .',
			'created_date' => '2015-07-06',
			'status' => '2'
		),
		array(
			'id' => '6',
			'organization_id' => '5',
			'induction_task' => 'dgfasdfasdf',
			'created_date' => '2015-07-06',
			'status' => '1'
		),
		array(
			'id' => '7',
			'organization_id' => '4',
			'induction_task' => 'dfsdfas',
			'created_date' => '2015-07-06',
			'status' => '0'
		),
		array(
			'id' => '8',
			'organization_id' => '4',
			'induction_task' => 'asdfasdfasdfasdf',
			'created_date' => '2015-07-06',
			'status' => '2'
		),
		array(
			'id' => '9',
			'organization_id' => '5',
			'induction_task' => 'sdfasdfasdf',
			'created_date' => '2015-07-06',
			'status' => '1'
		),
		array(
			'id' => '10',
			'organization_id' => '4',
			'induction_task' => 'sdfasdfasd',
			'created_date' => '2015-07-06',
			'status' => '1'
		),
	);

}
