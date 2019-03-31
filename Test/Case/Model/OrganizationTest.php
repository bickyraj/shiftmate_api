<?php
App::uses('Organization', 'Model');

/**
 * Organization Test Case
 *
 */
class OrganizationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.organization',
		'app.user',
		'app.city',
		'app.country',
		'app.branch',
		'app.board',
		'app.board_user',
		'app.boardmessage',
		'app.shift_user',
		'app.userleave',
		'app.organization_user',
		'app.organizationrole',
		'app.organizationfunction',
		'app.day',
		'app.useravailability',
		'app.group',
		'app.organization_useravailability',
		'app.organizationmessage',
		'app.shift'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Organization = ClassRegistry::init('Organization');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Organization);

		parent::tearDown();
	}

}
