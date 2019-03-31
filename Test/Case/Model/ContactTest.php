<?php
App::uses('Contact', 'Model');

/**
 * Contact Test Case
 *
 */
class ContactTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.contact',
		'app.contacttype',
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
		'app.userleave',
		'app.permanentshift',
		'app.day',
		'app.useravailability',
		'app.shiftnote',
		'app.shiftswap',
		'app.boardmessage',
		'app.organization_user',
		'app.organizationrole',
		'app.organizationfunction',
		'app.organization_useravailability',
		'app.organizationmessage',
		'app.user_group',
		'app.group',
		'app.noticeboard',
		'app.newsboard',
		'app.message'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Contact = ClassRegistry::init('Contact');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Contact);

		parent::tearDown();
	}

/**
 * testGetContactList method
 *
 * @return void
 */
	public function testGetContactList() {
		$this->markTestIncomplete('testGetContactList not implemented.');
	}

}
