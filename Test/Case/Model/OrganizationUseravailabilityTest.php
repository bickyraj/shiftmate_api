<?php
App::uses('OrganizationUseravailability', 'Model');

/**
 * OrganizationUseravailability Test Case
 *
 */
class OrganizationUseravailabilityTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.organization_useravailability',
		'app.organization',
		'app.user',
		'app.useravailability'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->OrganizationUseravailability = ClassRegistry::init('OrganizationUseravailability');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->OrganizationUseravailability);

		parent::tearDown();
	}

}
