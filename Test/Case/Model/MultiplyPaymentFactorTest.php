<?php
App::uses('MultiplyPaymentFactor', 'Model');

/**
 * MultiplyPaymentFactor Test Case
 *
 */
class MultiplyPaymentFactorTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.multiply_payment_factor',
		'app.organization',
		'app.user',
		'app.role',
		'app.city',
		'app.country',
		'app.branch',
		'app.branch_user',
		'app.board',
		'app.board_user',
		'app.shift_board',
		'app.shift',
		'app.shift_branch',
		'app.shift_user',
		'app.userleave',
		'app.permanentshift',
		'app.day',
		'app.useravailability',
		'app.boardmessage',
		'app.organization_user',
		'app.organizationrole',
		'app.organizationfunction',
		'app.organization_useravailability',
		'app.organizationmessage',
		'app.user_group',
		'app.group',
		'app.multiplypaymentfactortype'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MultiplyPaymentFactor = ClassRegistry::init('MultiplyPaymentFactor');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MultiplyPaymentFactor);

		parent::tearDown();
	}

}
