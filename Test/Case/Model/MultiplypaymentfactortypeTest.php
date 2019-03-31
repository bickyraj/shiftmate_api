<?php
App::uses('Multiplypaymentfactortype', 'Model');

/**
 * Multiplypaymentfactortype Test Case
 *
 */
class MultiplypaymentfactortypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.multiplypaymentfactortype',
		'app.multiply_payment_factor'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Multiplypaymentfactortype = ClassRegistry::init('Multiplypaymentfactortype');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Multiplypaymentfactortype);

		parent::tearDown();
	}

}
