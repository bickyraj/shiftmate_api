<?php
App::uses('User', 'Model');

/**
 * User Test Case
 *
 */
class UserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user',
		'app.roles',
		'app.city',
		'app.country',
		'app.branch',
		'app.organization',
		'app.day',
		'app.useravailability',
		'app.board',
		'app.board_user',
		'app.boardmessage',
		'app.shift_user',
		'app.shift',
		'app.shift_board',
		'app.userleave',
		'app.group',
		'app.organization_useravailability',
		'app.organization_user',
		'app.organizationrole',
		'app.organizationfunction',
		'app.organizationmessage',
		'app.user_group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->User = ClassRegistry::init('User');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->User);

		parent::tearDown();
	}

}
