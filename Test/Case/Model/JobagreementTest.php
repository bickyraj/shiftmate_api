<?php
App::uses('Jobagreement', 'Model');

/**
 * Jobagreement Test Case
 *
 */
class JobagreementTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.jobagreement',
		'app.organization',
		'app.user',
		'app.role',
		'app.jobagreementtype'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Jobagreement = ClassRegistry::init('Jobagreement');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Jobagreement);

		parent::tearDown();
	}

/**
 * testJobAgreementList method
 *
 * @return void
 */
	public function testJobAgreementList() {
		
		$result = $this->Jobagreement->jobAgreementList(4,1);

		// debug($result);
		// die();

		$expected = array(
	'page' => (int) 1,
	'agreements' => array(
		(int) 0 => array(
			'Jobagreement' => array(
				'id' => '7',
				'organization_id' => '4',
				'jobagreementtype_id' => '1',
				'content' => '<p><span style="font-size:14px"><u><strong>About Job</strong></u></span></p><ul>	<li>Job Type : Full Time</li>	<li>Job Level : Mid Level</li>	<li>Contract : 4 years</li></ul><p><span style="font-size:14px"><u><strong>Facilities</strong></u></span></p><ul>	<li>Salary : 600 USD per month</li>	<li>Salary - Review : In every 6 month</li>	<li>Bonus : Depend&#39;s on profit&nbsp;</li>	<li>Medical Plan : No</li>	<li>Retirement Plan : No</li>	<li>Leave : As Mentioned in Company&#39;s Calender</li></ul><p><span style="font-size:14px"><strong><u>Duties</u></strong></span></p><p>Working Hour : 10&nbsp;am to 5 pm</p><p>&nbsp;</p>',
				'title' => '',
				'date' => '2015-06-29',
				'status' => '0'
			),
			'Organization' => array(
				'id' => '4',
				'user_id' => '62',
				'title' => 'OnePlatinum',
				'logo' => '13.jpg',
				'address' => 'pulchowk',
				'email' => 'oneplatinum@gmail.com',
				'phone' => '9841414141',
				'fax' => '12345',
				'website' => 'oneplatinum.com.np',
				'city_id' => '1',
				'country_id' => '1',
				'lat' => '0',
				'long' => '1',
				'day_id' => '3',
				'status' => '1',
				'logo_dir' => '4',
				'logo_type' => 'image/jpeg',
				'logo_size' => '6146'
			),
			'Jobagreementtype' => array(
				'id' => '1',
				'type' => 'first15',
				'date' => '2015-07-03',
				'status' => '0'
			)
		),
		(int) 1 => array(
			'Jobagreement' => array(
				'id' => '9',
				'organization_id' => '4',
				'jobagreementtype_id' => '2',
				'content' => '<p><span style="font-size:14px"><u><strong>About Job</strong></u></span></p>

<ul>
	<li>Job Type : Full Time</li>
	<li>Job Level : Mid Level</li>
	<li>Contract : 4 years</li>
</ul>

<p><span style="font-size:14px"><u><strong>Facilities</strong></u></span></p>

<ul>
	<li>Salary : 500 USD per month</li>
	<li>Salary - Review : In every 6 month</li>
	<li>Bonus : Depend&#39;s on profit&nbsp;</li>
	<li>Medical Plan : No</li>
	<li>Retirement Plan : No</li>
	<li>Leave : As Mentioned in Company&#39;s Calender</li>
</ul>

<p><span style="font-size:14px"><strong><u>Duties</u></strong></span></p>

<p>Working Hour : 10&nbsp;am to 5 pm</p>

<p>&nbsp;</p>
',
				'title' => '',
				'date' => '2015-06-11',
				'status' => '0'
			),
			'Organization' => array(
				'id' => '4',
				'user_id' => '62',
				'title' => 'OnePlatinum',
				'logo' => '13.jpg',
				'address' => 'pulchowk',
				'email' => 'oneplatinum@gmail.com',
				'phone' => '9841414141',
				'fax' => '12345',
				'website' => 'oneplatinum.com.np',
				'city_id' => '1',
				'country_id' => '1',
				'lat' => '0',
				'long' => '1',
				'day_id' => '3',
				'status' => '1',
				'logo_dir' => '4',
				'logo_type' => 'image/jpeg',
				'logo_size' => '6146'
			),
			'Jobagreementtype' => array(
				'id' => '2',
				'type' => 'second',
				'date' => '2015-06-12',
				'status' => '0'
			)
		),
		(int) 2 => array(
			'Jobagreement' => array(
				'id' => '10',
				'organization_id' => '4',
				'jobagreementtype_id' => '6',
				'content' => '<p>rtwregrewterwt</p>
',
				'title' => '',
				'date' => '2015-07-02',
				'status' => '0'
			),
			'Organization' => array(
				'id' => '4',
				'user_id' => '62',
				'title' => 'OnePlatinum',
				'logo' => '13.jpg',
				'address' => 'pulchowk',
				'email' => 'oneplatinum@gmail.com',
				'phone' => '9841414141',
				'fax' => '12345',
				'website' => 'oneplatinum.com.np',
				'city_id' => '1',
				'country_id' => '1',
				'lat' => '0',
				'long' => '1',
				'day_id' => '3',
				'status' => '1',
				'logo_dir' => '4',
				'logo_type' => 'image/jpeg',
				'logo_size' => '6146'
			),
			'Jobagreementtype' => array(
				'id' => '6',
				'type' => 'type5',
				'date' => '0000-00-00',
				'status' => '0'
			)
		),
		(int) 3 => array(
			'Jobagreement' => array(
				'id' => '11',
				'organization_id' => '4',
				'jobagreementtype_id' => '2',
				'content' => '<p>asasas</p>
',
				'title' => 'essee',
				'date' => '2015-07-02',
				'status' => '0'
			),
			'Organization' => array(
				'id' => '4',
				'user_id' => '62',
				'title' => 'OnePlatinum',
				'logo' => '13.jpg',
				'address' => 'pulchowk',
				'email' => 'oneplatinum@gmail.com',
				'phone' => '9841414141',
				'fax' => '12345',
				'website' => 'oneplatinum.com.np',
				'city_id' => '1',
				'country_id' => '1',
				'lat' => '0',
				'long' => '1',
				'day_id' => '3',
				'status' => '1',
				'logo_dir' => '4',
				'logo_type' => 'image/jpeg',
				'logo_size' => '6146'
			),
			'Jobagreementtype' => array(
				'id' => '2',
				'type' => 'second',
				'date' => '2015-06-12',
				'status' => '0'
			)
		),
		(int) 4 => array(
			'Jobagreement' => array(
				'id' => '12',
				'organization_id' => '4',
				'jobagreementtype_id' => '7',
				'content' => '<p>this is new job.</p>
',
				'title' => 'php programmer',
				'date' => '2015-07-02',
				'status' => '0'
			),
			'Organization' => array(
				'id' => '4',
				'user_id' => '62',
				'title' => 'OnePlatinum',
				'logo' => '13.jpg',
				'address' => 'pulchowk',
				'email' => 'oneplatinum@gmail.com',
				'phone' => '9841414141',
				'fax' => '12345',
				'website' => 'oneplatinum.com.np',
				'city_id' => '1',
				'country_id' => '1',
				'lat' => '0',
				'long' => '1',
				'day_id' => '3',
				'status' => '1',
				'logo_dir' => '4',
				'logo_type' => 'image/jpeg',
				'logo_size' => '6146'
			),
			'Jobagreementtype' => array(
				'id' => '7',
				'type' => 'type5',
				'date' => '0000-00-00',
				'status' => '0'
			)
		),
		(int) 5 => array(
			'Jobagreement' => array(
				'id' => '13',
				'organization_id' => '4',
				'jobagreementtype_id' => '3',
				'content' => '<p>eae</p>
',
				'title' => 'aee',
				'date' => '2015-07-03',
				'status' => '0'
			),
			'Organization' => array(
				'id' => '4',
				'user_id' => '62',
				'title' => 'OnePlatinum',
				'logo' => '13.jpg',
				'address' => 'pulchowk',
				'email' => 'oneplatinum@gmail.com',
				'phone' => '9841414141',
				'fax' => '12345',
				'website' => 'oneplatinum.com.np',
				'city_id' => '1',
				'country_id' => '1',
				'lat' => '0',
				'long' => '1',
				'day_id' => '3',
				'status' => '1',
				'logo_dir' => '4',
				'logo_type' => 'image/jpeg',
				'logo_size' => '6146'
			),
			'Jobagreementtype' => array(
				'id' => '3',
				'type' => 'type3',
				'date' => '0000-00-00',
				'status' => '0'
			)
		),
		(int) 6 => array(
			'Jobagreement' => array(
				'id' => '14',
				'organization_id' => '4',
				'jobagreementtype_id' => '2',
				'content' => '<p><u><strong>qualification:</strong></u></p>

<ul>
	<li>&nbsp;php</li>
	<li>sql</li>
	<li>html 5 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</li>
</ul>

<p>&nbsp;</p>

<p>&nbsp;</p>
',
				'title' => 'Designer',
				'date' => '2015-07-07',
				'status' => '0'
			),
			'Organization' => array(
				'id' => '4',
				'user_id' => '62',
				'title' => 'OnePlatinum',
				'logo' => '13.jpg',
				'address' => 'pulchowk',
				'email' => 'oneplatinum@gmail.com',
				'phone' => '9841414141',
				'fax' => '12345',
				'website' => 'oneplatinum.com.np',
				'city_id' => '1',
				'country_id' => '1',
				'lat' => '0',
				'long' => '1',
				'day_id' => '3',
				'status' => '1',
				'logo_dir' => '4',
				'logo_type' => 'image/jpeg',
				'logo_size' => '6146'
			),
			'Jobagreementtype' => array(
				'id' => '2',
				'type' => 'second',
				'date' => '2015-06-12',
				'status' => '0'
			)
		)
	),
	'count' => (int) 7,
	'limit' => (int) 10
);
		$this->assertEqual($result,$expected);
	}

/**
 * testJobAgreementById method
 *
 * @return void
 */
	public function testJobAgreementById() {
		$this->markTestIncomplete('testJobAgreementById not implemented.');
	}

}
