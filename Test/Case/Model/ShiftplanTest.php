<?php
App::uses('Shiftplan', 'Model');

/**
 * Shiftplan Test Case
 *
 */
class ShiftplanTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		'app.shiftplan_user',
		'app.userleave',
		'app.shiftnote',
		'app.shiftswap',
		'app.boardmessage',
		'app.group',
		'app.user_group',
		'app.organization_useravailability',
		'app.organization_user',
		'app.organizationrole',
		'app.organizationfunction',
		'app.organizationmessage',
		'app.noticeboard',
		'app.newsboard',
		'app.message',
		'app.branch_user',
		'app.shiftplangroup'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Shiftplan = ClassRegistry::init('Shiftplan');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Shiftplan);

		parent::tearDown();
	}

}
