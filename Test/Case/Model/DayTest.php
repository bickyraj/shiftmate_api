<?php
App::uses('Day', 'Model');

/**
 * Day Test Case
 *
 */
class DayTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.day',
		'app.organization',
		'app.useravailability'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Day = ClassRegistry::init('Day');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Day);

		parent::tearDown();
	}

}
