<?php

class SexualAssaultResource extends DataObject {

	private static $db = array(
		'Title'   => 'Varchar(155)',
		'Address' => 'HTMLText',
		'Phone'   => 'Text',

	);

	private static $has_one = array(
		'County' => 'County',
	);

	private static $many_many = array(
		'Categories' => 'SexualAssaultResourceCategory',
	);

}
