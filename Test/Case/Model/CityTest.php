<?php
App::uses('City', 'Model');

/**
 * City Test Case
 *
 */
class CityTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.city',
		'app.country',
		'app.branch',
		'app.organization',
		'app.user',
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
		$this->City = ClassRegistry::init('City');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->City);

		parent::tearDown();
	}

}
