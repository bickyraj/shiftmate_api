<?php
App::uses('Country', 'Model');

/**
 * Country Test Case
 *
 */
class CountryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.country',
		'app.branch',
		'app.organization',
		'app.user',
		'app.city',
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
		$this->Country = ClassRegistry::init('Country');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Country);

		parent::tearDown();
	}

}
