<?php
App::uses('Useravailability', 'Model');

/**
 * Useravailability Test Case
 *
 */
class UseravailabilityTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.useravailability',
		'app.user',
		'app.day',
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
		$this->Useravailability = ClassRegistry::init('Useravailability');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Useravailability);

		parent::tearDown();
	}

}
