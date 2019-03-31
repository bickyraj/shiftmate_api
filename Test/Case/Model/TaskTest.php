<?php
App::uses('Task', 'Model');

/**
 * Task Test Case
 *
 */
class TaskTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.task',
		'app.user',
		
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Task = ClassRegistry::init('Task');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Task);

		parent::tearDown();
	}

/**
 * testListTask method
 *
 * @return void
 */
		public function testListTask() {

		$result = $this->Task->listTask(77);
		
		// debug($result);
		//  die();

		$expected = array(
	(int) 0 => array(
		'Task' => array(
			'id' => '1',
			'user_id' => '77',
			'task' => '<p>new task</p>
',
			'taskdate' => '0000-00-00 00:00:00',
			'created' => '2015-07-06 12:04:30',
			'status' => '0'
		),
		'User' => array(
			'id' => '77',
			'role_id' => '5',
			'fname' => 'ajay',
			'lname' => 'maharjan',
			'username' => 'ajay',
			'password' => '63cecedb70c5f0cda531d26f69bd36c0ca5bdbbc',
			'email' => 'ajay@gmail.com',
			'dob' => '2015-05-28',
			'address' => 'lubu',
			'phone' => '12345678',
			'city_id' => '1',
			'state' => 'kathmandu',
			'zipcode' => '12345',
			'country_id' => '1',
			'lastlogin' => '0000-00-00 00:00:00',
			'access_token' => 'CAT5ZQT7J77',
			'refresh_token' => 'afdc804480f590824566023b579992fd',
			'token_expiry_date' => '2015-07-20 11:43:10',
			'organizationid' => '0',
			'status' => '1',
			'image' => 'strawberry.jpg',
			'image_dir' => '77',
			'image_size' => '11216',
			'image_type' => 'image/jpeg'
		)
	)
);

	// debug($expected);
	// die();
	$this->assertEqual($result,$expected);
	
	}

}
