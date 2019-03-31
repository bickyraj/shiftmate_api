<?php
/**
 * ReviewFixture
 *
 */
class ReviewFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'reviewby' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'board_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'branch_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'details' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'reviewdate' => array('type' => 'timestamp', 'null' => false),
		'reviewtype' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
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
			'id' => '1',
			'user_id' => '77',
			'reviewby' => '62',
			'organization_id' => '4',
			'board_id' => '11',
			'branch_id' => '6',
			'details' => '<p>well done mate</p>
',
			'reviewdate' => '0000-00-00 00:00:00',
			'reviewtype' => 'Review',
			'status' => '0'
		),
		array(
			'id' => '2',
			'user_id' => '77',
			'reviewby' => '62',
			'organization_id' => '4',
			'board_id' => '0',
			'branch_id' => '8',
			'details' => '<p>happy for your work</p>
',
			'reviewdate' => '0000-00-00 00:00:00',
			'reviewtype' => 'Review',
			'status' => '0'
		),
		array(
			'id' => '3',
			'user_id' => '77',
			'reviewby' => '62',
			'organization_id' => '4',
			'board_id' => '10',
			'branch_id' => '6',
			'details' => '<p>work hard</p>
',
			'reviewdate' => '2015-06-29 12:16:57',
			'reviewtype' => 'Review',
			'status' => '0'
		),
		array(
			'id' => '4',
			'user_id' => '77',
			'reviewby' => '62',
			'organization_id' => '4',
			'board_id' => '11',
			'branch_id' => '6',
			'details' => '<p>pakhlas</p>
',
			'reviewdate' => '2015-06-29 12:54:56',
			'reviewtype' => 'Review',
			'status' => '0'
		),
		array(
			'id' => '5',
			'user_id' => '78',
			'reviewby' => '62',
			'organization_id' => '4',
			'board_id' => '10',
			'branch_id' => '6',
			'details' => '<p>good</p>
',
			'reviewdate' => '2015-06-29 13:02:49',
			'reviewtype' => 'written_warning',
			'status' => '0'
		),
		array(
			'id' => '6',
			'user_id' => '77',
			'reviewby' => '62',
			'organization_id' => '4',
			'board_id' => '11',
			'branch_id' => '6',
			'details' => '<ul>
	<li>
	<div class="message">Bob Nilson at 20:09 Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</div>
	</li>
	<li><img alt="" class="avatar" src="http://localhost:8080/onePlatinum/Backups/shiftmate/keentheme/theme/assets/admin/layout/img/avatar2.jpg" />
	<div class="message">Lisa Wong at 20:11 Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</div>
	</li>
</ul>
',
			'reviewdate' => '2015-06-29 16:44:15',
			'reviewtype' => 'verbal_warning',
			'status' => '0'
		),
		array(
			'id' => '7',
			'user_id' => '77',
			'reviewby' => '62',
			'organization_id' => '4',
			'board_id' => '10',
			'branch_id' => '6',
			'details' => '<p>Aug 5, 2013 - how to <em>send form values</em> to <em>php</em> using AJAX <em>without reloading</em> page ... need to <em>send</em> a <em>form input values</em> to that <em>PHP</em> script how do I do that? .... }).done(function(msg) { alert( &quot;Done: &quot; + msg ); //display message <em>box</em> with replay });&nbsp;...</p>
',
			'reviewdate' => '2015-06-30 16:29:33',
			'reviewtype' => 'Review',
			'status' => '0'
		),
		array(
			'id' => '8',
			'user_id' => '77',
			'reviewby' => '62',
			'organization_id' => '4',
			'board_id' => '10',
			'branch_id' => '6',
			'details' => '<p>you are late</p>
',
			'reviewdate' => '2015-07-02 10:35:38',
			'reviewtype' => 'verbal_warning',
			'status' => '0'
		),
	);

}
