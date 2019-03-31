<?php
App::uses('Organizationrole', 'Model');

/**
 * Organizationrole Test Case
 *
 */
class OrganizationroleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.organizationrole',
		'app.organization',
		'app.organization_user',
		'app.user',
		'app.branch',
		'app.city',
		'app.country',
		'app.board',
		'app.board_user',
		'app.boardmessage',
		'app.shift_user',
		'app.userleave',
		'app.organizationfunction'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Organizationrole = ClassRegistry::init('Organizationrole');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Organizationrole);

		parent::tearDown();
	}

}
