<?php
/**
 * NoticeboardFixture
 *
 */
class NoticeboardFixture extends CakeTestFixture {

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
		'notice_date' => array('type' => 'timestamp', 'null' => false),
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
			'id' => '8',
			'organization_id' => '4',
			'title' => 'Public Holiday',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis tincidunt consectetur elit sed faucibus. Fusce id tincidunt sem, sed dictum sapien. Nam eleifend consequat ultricies. Suspendisse ut pulvinar purus. Donec vitae neque nec tellus lacinia laoreet. Praesent non consequat mauris. Sed laoreet malesuada lacinia. Integer iaculis magna et massa sollicitudin tempor. Morbi quis ante in eros vestibulum lacinia. Etiam gravida ante eget tortor ornare, et porta enim feugiat. Duis gravida purus commodo consectetur pretium. Cras lobortis magna elementum magna dapibus rutrum.',
			'notice_date' => '2015-05-28 17:10:10',
			'status' => '0'
		),
		array(
			'id' => '9',
			'organization_id' => '4',
			'title' => 'Holiday Announcement',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis tincidunt consectetur elit sed faucibus. Fusce id tincidunt sem, sed dictum sapien. Nam eleifend consequat ultricies. Suspendisse ut pulvinar purus. Donec vitae neque nec tellus lacinia laoreet. Praesent non consequat mauris. Sed laoreet malesuada lacinia. Integer iaculis magna et massa sollicitudin tempor. Morbi quis ante in eros vestibulum lacinia. Etiam gravida ante eget tortor ornare, et porta enim feugiat. Duis gravida purus commodo consectetur pretium. Cras lobortis magna elementum magna dapibus rutrum.',
			'notice_date' => '2015-06-02 11:35:00',
			'status' => '0'
		),
		array(
			'id' => '10',
			'organization_id' => '4',
			'title' => 'This is new notice',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis tincidunt consectetur elit sed faucibus. Fusce id tincidunt sem, sed dictum sapien. Nam eleifend consequat ultricies. Suspendisse ut pulvinar purus. Donec vitae neque nec tellus lacinia laoreet. Praesent non consequat mauris. Sed laoreet malesuada lacinia. Integer iaculis magna et massa sollicitudin tempor. Morbi quis ante in eros vestibulum lacinia. Etiam gravida ante eget tortor ornare, et porta enim feugiat. Duis gravida purus commodo consectetur pretium. Cras lobortis magna elementum magna dapibus rutrum.',
			'notice_date' => '2015-06-02 12:09:42',
			'status' => '0'
		),
		array(
			'id' => '11',
			'organization_id' => '4',
			'title' => 'Bicky',
			'description' => 'hello bicky',
			'notice_date' => '2015-06-02 17:07:48',
			'status' => '0'
		),
		array(
			'id' => '12',
			'organization_id' => '4',
			'title' => 'Mahesh Notice',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis tincidunt consectetur elit sed faucibus. Fusce id tincidunt sem, sed dictum sapien. Nam eleifend consequat ultricies. Suspendisse ut pulvinar purus. Donec vitae neque nec tellus lacinia laoreet. Praesent non consequat mauris. Sed laoreet malesuada lacinia. Integer iaculis magna et massa sollicitudin tempor. Morbi quis ante in eros vestibulum lacinia. Etiam gravida ante eget tortor ornare, et porta enim feugiat. Duis gravida purus commodo consectetur pretium. Cras lobortis magna elementum magna dapibus rutrum.',
			'notice_date' => '2015-06-02 17:12:03',
			'status' => '0'
		),
		array(
			'id' => '13',
			'organization_id' => '4',
			'title' => 'New Notice',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis tincidunt consectetur elit sed faucibus. Fusce id tincidunt sem, sed dictum sapien. Nam eleifend consequat ultricies. Suspendisse ut pulvinar purus. Donec vitae neque nec tellus lacinia laoreet. Praesent non consequat mauris. Sed laoreet malesuada lacinia. Integer iaculis magna et massa sollicitudin tempor. Morbi quis ante in eros vestibulum lacinia. Etiam gravida ante eget tortor ornare, et porta enim feugiat. Duis gravida purus commodo consectetur pretium. Cras lobortis magna elementum magna dapibus rutrum.',
			'notice_date' => '2015-06-02 17:25:38',
			'status' => '0'
		),
		array(
			'id' => '14',
			'organization_id' => '4',
			'title' => 'Pocket Butler work related',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis tincidunt consectetur elit sed faucibus. Fusce id tincidunt sem, sed dictum sapien. Nam eleifend consequat ultricies. Suspendisse ut pulvinar purus. Donec vitae neque nec tellus lacinia laoreet. Praesent non consequat mauris. Sed laoreet malesuada lacinia. Integer iaculis magna et massa sollicitudin tempor. Morbi quis ante in eros vestibulum lacinia. Etiam gravida ante eget tortor ornare, et porta enim feugiat. Duis gravida purus commodo consectetur pretium. Cras lobortis magna elementum magna dapibus rutrum.',
			'notice_date' => '2015-06-03 12:28:41',
			'status' => '0'
		),
		array(
			'id' => '15',
			'organization_id' => '5',
			'title' => 'test',
			'description' => 'this is test',
			'notice_date' => '2015-06-10 17:28:11',
			'status' => '0'
		),
		array(
			'id' => '16',
			'organization_id' => '4',
			'title' => 'rocky',
			'description' => '                                        bicky                                    ',
			'notice_date' => '2015-06-24 18:36:52',
			'status' => '0'
		),
	);

}
