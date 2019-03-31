<?php
App::uses('ShiftUser', 'Model');

/**
 * ShiftUser Test Case
 *
 */
class ShiftUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.shift_user',
		'app.board',
		'app.organization',
		'app.user',
		'app.city',
		'app.country',
		'app.branch',
		'app.organization_user',
		'app.organizationrole',
		'app.organizationfunction',
		'app.day',
		'app.useravailability',
		'app.group',
		'app.organization_useravailability',
		'app.organizationmessage',
		'app.shift',
		'app.userleave',
		'app.board_user',
		'app.boardmessage'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ShiftUser = ClassRegistry::init('ShiftUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ShiftUser);

		parent::tearDown();
	}

}
