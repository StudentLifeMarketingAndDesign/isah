<?php

class SexualAssaultProject extends Page {

	private static $db = array(
		'Address'                => 'Text',
		'Phone'                  => 'Text',
		'OutreachOffices'        => 'Text',
		'CrisisLines'            => 'HTMLText',
		'AdditionalServiceAreas' => 'HTMLText',
		'Website'                => 'Text',
		'Email'                  => 'Text',
	);

	private static $can_be_root = false;

	private static $has_many = array(
		'Counties' => 'County',
	);

	public function getCMSFields() {
		$f = parent::getCMSFields();

		$countyField = TagField::create('Counties', 'Counties', County::get(), $this->Counties())->setShouldLazyLoad(true);
		$f->addFieldToTab('Root.Main', $countyField, 'Content');

		return $f;
	}

}
