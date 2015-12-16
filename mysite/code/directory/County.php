<?php

class County extends DataObject {

	private static $db = array(
		'Title'      => 'Varchar(155)',
		'Region'     => 'Int',
		'URLSegment' => 'Text',
	);

	private static $extensions = array(
		'SexualAssaultProjectDirectoryURLSegmentExtension',
	);

	private static $has_one = array(
		'Project' => 'SexualAssaultProject',
	);

	private static $has_many = array(
		'Resources' => 'SexualAssaultResource',
	);

	private static $summary_fields = array(
		'Title', 'Region', 'URLSegment',
	);

}