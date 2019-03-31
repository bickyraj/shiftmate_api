<?php
App::uses('Organizationmessage', 'Model');

/**
 * Organizationmessage Test Case
 *
 */
class OrganizationmessageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.organizationmessage',
		'app.organization',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Organizationmessage = ClassRegistry::init('Organizationmessage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Organizationmessage);

		parent::tearDown();
	}

}
