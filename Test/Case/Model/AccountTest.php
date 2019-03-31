<?php
App::uses('Account', 'Model');

/**
 * Account Test Case
 *
 */
class AccountTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.account',
		'app.organization',
		'app.user',
		'app.role',
		'app.city',
		'app.country',
		'app.branch',
		'app.branch_user',
		'app.board',
		'app.board_user',
		'app.leaveholiday',
		'app.shift_board',
		'app.shift',
		'app.shift_branch',
		'app.shift_user',
		'app.shiftplan_user',
		'app.shiftplan',
		'app.shiftplangroup',
		'app.group',
		'app.user_group',
		'app.employeeshiftexpense',
		'app.userleave',
		'app.permanentshift',
		'app.day',
		'app.useravailability',
		'app.shiftnote',
		'app.shiftswap',
		'app.shiftchecklist',
		'app.checklist',
		'app.boardmessage',
		'app.message',
		'app.organization_user',
		'app.organizationrole',
		'app.organizationfunction',
		'app.organization_useravailability',
		'app.organizationmessage',
		'app.noticeboard',
		'app.newsboard'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Account = ClassRegistry::init('Account');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Account);

		parent::tearDown();
	}

}
