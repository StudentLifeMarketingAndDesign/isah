<?php

class SexualAssaultResource extends DataObject {

	private static $db = array(
		'Title'           => 'Varchar(155)',
		'Address'         => 'HTMLText',
		'Phone'           => 'Text',
		'Email'           => 'Text',
		'Website'         => 'Text',
		'Content'         => 'HTMLText',
		'ServicesOffered' => 'HTMLText',

	);

	private static $has_one = array(
		'County' => 'County',
	);

	private static $singular_name = 'Resource';

	private static $many_many = array(
		'Categories' => 'SexualAssaultResourceCategory',
	);

	public function getCMSFields() {
		$f = parent::getCMSFields();

		$catField = TagField::create('Counties', 'Counties', County::get(), $this->Counties())->setShouldLazyLoad(true);
		//$f->addFieldToTab('Root.Main', $catField, 'Content');

		return $f;
	}

}
