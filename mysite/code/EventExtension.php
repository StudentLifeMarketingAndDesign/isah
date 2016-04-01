<?php

class EventExtension extends DataExtension {

	private static $has_one = array(
		'Image' => 'Image'
	);

	private static $defaults = array('Content' => '');

	public function updateCMSFields(FieldList $fields) {
		$fields->push(new UploadField('Image','Image'));
		$fields->removeByName("BackgroundImage");
		$fields->removeByName("Recursion");
		
	}
}