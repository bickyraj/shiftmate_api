<?php
App::uses('Leaverequest', 'Model');

/**
 * Leaverequest Test Case
 *
 */
class LeaverequestTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.leaverequest',
		'app.leavetype',
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
		'app.shiftplan_user',
		'app.shiftplan',
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
		$this->Leaverequest = ClassRegistry::init('Leaverequest');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Leaverequest);

		parent::tearDown();
	}

/**
 * testMyLeaveRequests method
 *
 * @return void
 */
	public function testMyLeaveRequests() {
		$this->markTestIncomplete('testMyLeaveRequests not implemented.');
	}

/**
 * testUserLeaveRequest method
 *
 * @return void
 */
	public function testUserLeaveRequest() {
		$this->markTestIncomplete('testUserLeaveRequest not implemented.');
	}

/**
 * testCountAcceptedLeave method
 *
 * @return void
 */
	public function testCountAcceptedLeave() {
		$this->markTestIncomplete('testCountAcceptedLeave not implemented.');
	}

/**
 * testDistinctLeaveUser method
 *
 * @return void
 */
	public function testDistinctLeaveUser() {
		$this->markTestIncomplete('testDistinctLeaveUser not implemented.');
	}

}
