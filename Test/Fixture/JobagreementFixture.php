<?php
/**
 * JobagreementFixture
 *
 */
class JobagreementFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'jobagreementtype_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'content' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'date' => array('type' => 'date', 'null' => false, 'default' => null),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '7',
			'organization_id' => '4',
			'jobagreementtype_id' => '1',
			'content' => '<p><span style="font-size:14px"><u><strong>About Job</strong></u></span></p><ul>	<li>Job Type : Full Time</li>	<li>Job Level : Mid Level</li>	<li>Contract : 4 years</li></ul><p><span style="font-size:14px"><u><strong>Facilities</strong></u></span></p><ul>	<li>Salary : 600 USD per month</li>	<li>Salary - Review : In every 6 month</li>	<li>Bonus : Depend&#39;s on profit&nbsp;</li>	<li>Medical Plan : No</li>	<li>Retirement Plan : No</li>	<li>Leave : As Mentioned in Company&#39;s Calender</li></ul><p><span style="font-size:14px"><strong><u>Duties</u></strong></span></p><p>Working Hour : 10&nbsp;am to 5 pm</p><p>&nbsp;</p>',
			'title' => '',
			'date' => '2015-06-29',
			'status' => '0'
		),
		array(
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
		array(
			'id' => '10',
			'organization_id' => '4',
			'jobagreementtype_id' => '6',
			'content' => '<p>rtwregrewterwt</p>
',
			'title' => '',
			'date' => '2015-07-02',
			'status' => '0'
		),
		array(
			'id' => '11',
			'organization_id' => '4',
			'jobagreementtype_id' => '2',
			'content' => '<p>asasas</p>
',
			'title' => 'essee',
			'date' => '2015-07-02',
			'status' => '0'
		),
		array(
			'id' => '12',
			'organization_id' => '4',
			'jobagreementtype_id' => '7',
			'content' => '<p>this is new job.</p>
',
			'title' => 'php programmer',
			'date' => '2015-07-02',
			'status' => '0'
		),
		array(
			'id' => '13',
			'organization_id' => '4',
			'jobagreementtype_id' => '3',
			'content' => '<p>eae</p>
',
			'title' => 'aee',
			'date' => '2015-07-03',
			'status' => '0'
		),
		array(
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
	);

}
