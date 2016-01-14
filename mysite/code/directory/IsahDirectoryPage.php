<?php

class IsahDirectoryPage extends Page {

	private static $db = array(

	);
	private static $can_be_root = false;

	private static $defaults = array(
		'Content' => '',
	);

	private static $singular_name = 'Other Directory Resource';

	public function getCMSFields() {
		$f = parent::getCMSFields();

		return $f;
	}

}
