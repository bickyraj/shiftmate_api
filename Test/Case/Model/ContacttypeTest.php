<?php
App::uses('Contacttype', 'Model');

/**
 * Contacttype Test Case
 *
 */
class ContacttypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		'app.message',
		'app.contact'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Contacttype = ClassRegistry::init('Contacttype');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Contacttype);

		parent::tearDown();
	}

/**
 * testGetContactType method
 *
 * @return void
 */
	public function testGetContactType() {
		$this->markTestIncomplete('testGetContactType not implemented.');
	}

}
