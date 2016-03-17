<?php

class EventExtension extends DataExtension {
	private static $defaults = array('Content' => '');
	public function updateCMSFields(FieldList $fields) {
		$fields->removeByName("Recursion");
	}
}