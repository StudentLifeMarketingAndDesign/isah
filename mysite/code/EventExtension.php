<?php

use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;

class EventExtension extends DataExtension {

	private static $db = array(
		'LocationLink' => 'Text',
		'FacebookEventLink' => 'Text',
	);
	private static $has_one = array(
		'Image' => Image::class,

	);

	private static $defaults = array('Content' => '');

	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab('Root.Main', new UploadField(Image::class, Image::class), 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('LocationLink', 'Location Link (make sure to include http:// in the link)'), Image::class);
		$fields->addFieldToTab('Root.Main', new TextField('FacebookEventLink', 'Facebook Event Link (make sure to include http:// in the link)'), Image::class);
		$fields->removeByName("BackgroundImage");
		$fields->removeByName("Recursion");

	}
}