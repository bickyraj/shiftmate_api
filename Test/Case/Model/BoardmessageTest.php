<?php
App::uses('Boardmessage', 'Model');

/**
 * Boardmessage Test Case
 *
 */
class BoardmessageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.boardmessage',
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
		$this->Boardmessage = ClassRegistry::init('Boardmessage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Boardmessage);

		parent::tearDown();
	}

}
