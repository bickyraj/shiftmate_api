<?php
App::uses('UserGroup', 'Model');

/**
 * UserGroup Test Case
 *
 */
class UserGroupTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_group',
		'app.user',
		'app.group',
		'app.organization',
		'app.city',
		'app.country',
		'app.branch',
		'app.board',
		'app.board_user',
		'app.boardmessage',
		'app.shift_user',
		'app.shift',
		'app.shift_board',
		'app.userleave',
		'app.organization_user',
		'app.organizationrole',
		'app.organizationfunction',
		'app.day',
		'app.useravailability',
		'app.organization_useravailability',
		'app.organizationmessage'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserGroup = ClassRegistry::init('UserGroup');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserGroup);

		parent::tearDown();
	}

}
