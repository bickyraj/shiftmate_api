<?php
App::uses('ShiftplanUser', 'Model');

/**
 * ShiftplanUser Test Case
 *
 */
class ShiftplanUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.shiftplan_user',
		'app.shiftplan',
		'app.user',
		'app.role',
		'app.city',
		'app.country',
		'app.branch',
		'app.organization',
		'app.day',
		'app.useravailability',
		'app.permanentshift',
		'app.board',
		'app.board_user',
		'app.leaveholiday',
		'app.shift_board',
		'app.shift',
		'app.shift_branch',
		'app.shift_user',
		'app.userleave',
		'app.shiftnote',
		'app.shiftswap',
		'app.boardmessage',
		'app.group',
		'app.organization_useravailability',
		'app.organization_user',
		'app.organizationrole',
		'app.organizationfunction',
		'app.organizationmessage',
		'app.noticeboard',
		'app.newsboard',
		'app.message',
		'app.branch_user',
		'app.user_group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ShiftplanUser = ClassRegistry::init('ShiftplanUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ShiftplanUser);

		parent::tearDown();
	}

/**
 * testGetClosedPlans method
 *
 * @return void
 */
	public function testGetClosedPlans() {
		$this->markTestIncomplete('testGetClosedPlans not implemented.');
	}

/**
 * testGetAClosedPlan method
 *
 * @return void
 */
	public function testGetAClosedPlan() {
		$this->markTestIncomplete('testGetAClosedPlan not implemented.');
	}

}
