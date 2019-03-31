<?php
/**
 * ChecklistFixture
 *
 */
class ChecklistFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'shiftchecklist_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'checklistdetail' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'id' => '172',
			'shiftchecklist_id' => '21',
			'checklistdetail' => 'asdasa',
			'status' => '0'
		),
		array(
			'id' => '173',
			'shiftchecklist_id' => '21',
			'checklistdetail' => 'asdssasas',
			'status' => '0'
		),
		array(
			'id' => '174',
			'shiftchecklist_id' => '21',
			'checklistdetail' => 'asdasasdsd',
			'status' => '0'
		),
		array(
			'id' => '175',
			'shiftchecklist_id' => '21',
			'checklistdetail' => 'asdasasassdsd',
			'status' => '0'
		),
		array(
			'id' => '176',
			'shiftchecklist_id' => '22',
			'checklistdetail' => 'a',
			'status' => '0'
		),
		array(
			'id' => '177',
			'shiftchecklist_id' => '22',
			'checklistdetail' => 'c',
			'status' => '0'
		),
		array(
			'id' => '178',
			'shiftchecklist_id' => '23',
			'checklistdetail' => '123123',
			'status' => '0'
		),
		array(
			'id' => '179',
			'shiftchecklist_id' => '23',
			'checklistdetail' => 'b',
			'status' => '0'
		),
		array(
			'id' => '180',
			'shiftchecklist_id' => '23',
			'checklistdetail' => 'c',
			'status' => '0'
		),
		array(
			'id' => '181',
			'shiftchecklist_id' => '23',
			'checklistdetail' => 'd',
			'status' => '0'
		),
	);

}
