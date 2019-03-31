<?php
/**
 * FeedFixture
 *
 */
class FeedFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'title' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'purpose' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'board_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'branch_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'createddate' => array('type' => 'timestamp', 'null' => false),
		'pinned' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false),
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
			'id' => '5',
			'user_id' => '62',
			'title' => 'Lorem ipsum dolor sit amet',
			'purpose' => 'Hello',
			'organization_id' => '5',
			'board_id' => '1',
			'branch_id' => '1',
			'createddate' => '2015-06-25 15:48:27',
			'pinned' => '0',
			'status' => '1'
		),
		array(
			'id' => '8',
			'user_id' => '62',
			'title' => 'Carles Puyol',
			'purpose' => 'yo bro whats up?Coriander bitterleaf epazote radicchio shallot winter purslane collard. Caulie dandelion maize lentil collard greens radish arugula sweet pepper water spinach kombu courgette lettuce. Celery coriander bitterleaf epazote radicchio shallot winter purslane collard greens spring onion squash lentil. Artichoke salad bamboo shoot black-eyed pea brussels sprout garlic kohlrabi. ',
			'organization_id' => '4',
			'board_id' => '1',
			'branch_id' => '1',
			'createddate' => '2015-06-28 18:09:06',
			'pinned' => '1',
			'status' => '1'
		),
		array(
			'id' => '9',
			'user_id' => '76',
			'title' => 'New User Registered',
			'purpose' => '!!this is the urgency plz be alert!!
Coriander bitterleaf epazote radicchio shallot winter purslane collard. Caulie dandelion maize lentil collard greens radish arugula sweet pepper water spinach kombu courgette lettuce. Celery coriander bitterleaf epazote radicchio shallot winter purslane collard greens spring onion squash lentil. Artichoke salad bamboo shoot black-eyed pea brussels sprout garlic kohlrabi. ',
			'organization_id' => '4',
			'board_id' => '1',
			'branch_id' => '1',
			'createddate' => '2015-06-28 18:09:17',
			'pinned' => '1',
			'status' => '1'
		),
		array(
			'id' => '14',
			'user_id' => '62',
			'title' => 'New User Registered',
			'purpose' => 'Thanks for the earth quake fundraising.
Coriander bitterleaf epazote radicchio shallot winter purslane collard. Caulie dandelion maize lentil collard greens radish arugula sweet pepper water spinach kombu courgette lettuce. Celery coriander bitterleaf epazote radicchio shallot winter purslane collard greens spring onion squash lentil. Artichoke salad bamboo shoot black-eyed pea brussels sprout garlic kohlrabi. ',
			'organization_id' => '4',
			'board_id' => '1',
			'branch_id' => '1',
			'createddate' => '2015-06-28 18:09:12',
			'pinned' => '0',
			'status' => '1'
		),
		array(
			'id' => '15',
			'user_id' => '77',
			'title' => 'The graphical control',
			'purpose' => 'this is the people we got',
			'organization_id' => '5',
			'board_id' => '0',
			'branch_id' => '0',
			'createddate' => '2015-06-25 15:54:38',
			'pinned' => '0',
			'status' => '1'
		),
		array(
			'id' => '17',
			'user_id' => '62',
			'title' => 'New User Registered',
			'purpose' => 'This is the main thing we are going to implement.',
			'organization_id' => '5',
			'board_id' => '0',
			'branch_id' => '0',
			'createddate' => '2015-06-28 16:09:48',
			'pinned' => '1',
			'status' => '1'
		),
		array(
			'id' => '18',
			'user_id' => '77',
			'title' => 'Hansel and Grete',
			'purpose' => 'This is the official team.Coriander bitterleaf epazote radicchio shallot winter purslane collard. Caulie dandelion maize lentil collard greens radish arugula sweet pepper water spinach kombu courgette lettuce. Celery coriander bitterleaf epazote radicchio shallot winter purslane collard greens spring onion squash lentil. Artichoke salad bamboo shoot black-eyed pea brussels sprout garlic kohlrabi. ',
			'organization_id' => '4',
			'board_id' => '0',
			'branch_id' => '0',
			'createddate' => '2015-06-28 16:39:45',
			'pinned' => '0',
			'status' => '0'
		),
		array(
			'id' => '19',
			'user_id' => '62',
			'title' => 'The graphical control',
			'purpose' => 'He should get the ballon \'d or awards ',
			'organization_id' => '5',
			'board_id' => '0',
			'branch_id' => '0',
			'createddate' => '2015-06-28 16:09:48',
			'pinned' => '1',
			'status' => '1'
		),
		array(
			'id' => '20',
			'user_id' => '77',
			'title' => 'Hansel and Grete',
			'purpose' => 'This is the official team.
Coriander bitterleaf epazote radicchio shallot winter purslane collard. Caulie dandelion maize lentil collard greens radish arugula sweet pepper water spinach kombu courgette lettuce. Celery coriander bitterleaf epazote radicchio shallot winter purslane collard greens spring onion squash lentil. Artichoke salad bamboo shoot black-eyed pea brussels sprout garlic kohlrabi. ',
			'organization_id' => '4',
			'board_id' => '0',
			'branch_id' => '0',
			'createddate' => '2015-06-28 16:36:12',
			'pinned' => '1',
			'status' => '0'
		),
		array(
			'id' => '26',
			'user_id' => '77',
			'title' => 'New User Registered',
			'purpose' => 'sadjfhakjsdhfkas',
			'organization_id' => '5',
			'board_id' => '0',
			'branch_id' => '0',
			'createddate' => '2015-06-28 16:09:52',
			'pinned' => '1',
			'status' => '1'
		),
	);

}
