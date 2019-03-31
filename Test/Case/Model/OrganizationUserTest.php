<?php
App::uses('OrganizationUser', 'Model');

/**
 * OrganizationUser Test Case
 *
 */
class OrganizationUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.organization_user',
		'app.organization',
		'app.user',
		'app.branch',
		'app.city',
		'app.country',
		'app.board',
		'app.board_user',
		'app.boardmessage',
		'app.shift_user',
		'app.userleave',
		'app.organizationfunction',
		'app.organizationrole'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->OrganizationUser = ClassRegistry::init('OrganizationUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->OrganizationUser);

		parent::tearDown();
	}

}
