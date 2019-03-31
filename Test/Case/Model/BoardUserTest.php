<?php
App::uses('BoardUser', 'Model');

/**
 * BoardUser Test Case
 *
 */
class BoardUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.board_user',
		'app.board',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BoardUser = ClassRegistry::init('BoardUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BoardUser);

		parent::tearDown();
	}

}
