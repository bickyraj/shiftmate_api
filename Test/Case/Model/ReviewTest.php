<?php
App::uses('Review', 'Model');

/**
 * Review Test Case
 *
 */
class ReviewTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.review',
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
		$this->Review = ClassRegistry::init('Review');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Review);

		parent::tearDown();
	}

/**
 * testSaveReview method
 *
 * @return void
 */
	public function testSaveReview() {
		$this->markTestIncomplete('testSaveReview not implemented.');
	}

/**
 * testMyReview method
 *
 * @return void
 */
	public function testMyReview() {
		$this->markTestIncomplete('testMyReview not implemented.');
	}

/**
 * testSentReview method
 *
 * @return void
 */
	public function testSentReview() {
		$this->markTestIncomplete('testSentReview not implemented.');
	}

/**
 * testSentAllReview method
 *
 * @return void
 */
	public function testSentAllReview() {
		$this->markTestIncomplete('testSentAllReview not implemented.');
	}

}
