<?php
App::uses('Organizationfunction', 'Model');

/**
 * Organizationfunction Test Case
 *
 */
class OrganizationfunctionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.organizationfunction',
		'app.organization',
		'app.branch',
		'app.user',
		'app.city',
		'app.country',
		'app.board',
		'app.board_user',
		'app.boardmessage',
		'app.shift_user',
		'app.userleave',
		'app.organization_user',
		'app.organizationrole'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Organizationfunction = ClassRegistry::init('Organizationfunction');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Organizationfunction);

		parent::tearDown();
	}

}
