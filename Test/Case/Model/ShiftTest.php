<?php
App::uses('Shift', 'Model');

/**
 * Shift Test Case
 *
 */
class ShiftTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.shift',
		'app.organization',
		'app.user',
		'app.city',
		'app.country',
		'app.branch',
		'app.board',
		'app.board_user',
		'app.boardmessage',
		'app.shift_user',
		'app.userleave',
		'app.organization_user',
		'app.organizationrole',
		'app.organizationfunction',
		'app.day',
		'app.useravailability',
		'app.group',
		'app.organization_useravailability',
		'app.organizationmessage',
		'app.shift_board'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Shift = ClassRegistry::init('Shift');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Shift);

		parent::tearDown();
	}

}
