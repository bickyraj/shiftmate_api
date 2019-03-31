<?php
App::uses('Branch', 'Model');

/**
 * Branch Test Case
 *
 */
class BranchTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.branch',
		'app.organization',
		'app.user',
		'app.city',
		'app.country',
		'app.board',
		'app.board_user',
		'app.boardmessage',
		'app.shift_user',
		'app.userleave',
		'app.organization_user',
		'app.organizationfunction'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Branch = ClassRegistry::init('Branch');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Branch);

		parent::tearDown();
	}

}
