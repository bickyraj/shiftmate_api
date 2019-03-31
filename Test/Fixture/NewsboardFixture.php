<?php
/**
 * NewsboardFixture
 *
 */
class NewsboardFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'description' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'news_date' => array('type' => 'timestamp', 'null' => false),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '2',
			'organization_id' => '4',
			'title' => 'News Test',
			'description' => 'this is new test news. ',
			'news_date' => '2015-06-03 11:26:23',
			'status' => '0'
		),
		array(
			'id' => '3',
			'organization_id' => '4',
			'title' => 'this is new edited news',
			'description' => '                                         Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cr                                ',
			'news_date' => '2015-06-03 11:27:36',
			'status' => '0'
		),
		array(
			'id' => '4',
			'organization_id' => '4',
			'title' => 'One Platinum annoucing new internships',
			'description' => '                                        This is to notify that our organization is ready to intake new programmers as well as designers.                                ',
			'news_date' => '2015-06-03 11:45:30',
			'status' => '0'
		),
		array(
			'id' => '5',
			'organization_id' => '5',
			'title' => 'test',
			'description' => 'this is test news',
			'news_date' => '2015-06-10 17:28:51',
			'status' => '0'
		),
		array(
			'id' => '6',
			'organization_id' => '4',
			'title' => 'New News are Available',
			'description' => '                                        this is just a test news1.                                ',
			'news_date' => '2015-06-24 19:10:26',
			'status' => '0'
		),
	);

}
