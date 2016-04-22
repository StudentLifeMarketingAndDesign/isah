<?php

class EventExtension extends DataExtension {

	private static $db = array(
		'LocationLink' => 'Text',
		'FacebookEventLink' => 'Text',
	);
	private static $has_one = array(
		'Image' => 'Image',

	);

	private static $defaults = array('Content' => '');

	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab('Root.Main', new UploadField('Image', 'Image'), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('LocationLink', 'Location Link (make sure to include http:// in the link)'), 'Image');
		$fields->addFieldToTab('Root.Main', new TextField('FacebookEventLink', 'Facebook Event Link (make sure to include http:// in the link)'), 'Image');
		$fields->removeByName("BackgroundImage");
		$fields->removeByName("Recursion");

	}
}