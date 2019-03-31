<?php
App::uses('Userleave', 'Model');

/**
 * Userleave Test Case
 *
 */
class UserleaveTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.userleave',
		'app.user',
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
		'app.organization_user',
		'app.organizationrole',
		'app.organizationfunction',
		'app.day',
		'app.useravailability',
		'app.group',
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
		$this->Userleave = ClassRegistry::init('Userleave');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Userleave);

		parent::tearDown();
	}

}
