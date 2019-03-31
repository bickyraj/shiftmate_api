<?php
App::uses('Leavetype', 'Model');

/**
 * Leavetype Test Case
 *
 */
class LeavetypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.leavetype',
		'app.leaverequest',
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
		$this->Leavetype = ClassRegistry::init('Leavetype');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Leavetype);

		parent::tearDown();
	}

/**
 * testGetTypes method
 *
 * @return void
 */
	public function testGetTypes() {
		$this->markTestIncomplete('testGetTypes not implemented.');
	}

}
