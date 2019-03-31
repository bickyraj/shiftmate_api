<?php
App::uses('Board', 'Model');

/**
 * Board Test Case
 *
 */
class BoardTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.board',
		'app.organization',
		'app.user',
		'app.branch',
		'app.board_user',
		'app.boardmessage',
		'app.shift_user',
		'app.userleave'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Board = ClassRegistry::init('Board');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Board);

		parent::tearDown();
	}

}
