<?php
App::uses('ShiftBoard', 'Model');

/**
 * ShiftBoard Test Case
 *
 */
class ShiftBoardTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.shift_board',
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
		'app.boardmessage',
		'app.shift_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ShiftBoard = ClassRegistry::init('ShiftBoard');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ShiftBoard);

		parent::tearDown();
	}

}
