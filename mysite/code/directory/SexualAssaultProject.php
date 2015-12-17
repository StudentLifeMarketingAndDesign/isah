<?php

class SexualAssaultProject extends Page {

	private static $db = array(
		'Address'                  => 'Text',
		'Phone'                    => 'Text',
		'RegionalHotline'          => 'Text',
		'LocalCrisisLine'          => 'Text',
		'TwentyFourHourCrisisLine' => 'Text',
		'SpanishLine'              => 'Text',
		'Fax'                      => 'Text',
		'OutreachOffices'          => 'Text',
		'CrisisLines'              => 'HTMLText',
		'ServicesOffered'          => 'HTMLText',
		'AdditionalServiceAreas'   => 'HTMLText',
		'Website'                  => 'Text',
		'Email'                    => 'Text',
	);

	private static $can_be_root = false;

	private static $has_many = array(
		'Counties' => 'County',
	);

	private static $defaults = array(
		'Content' => '',
	);

	private static $singular_name = 'Project';

	public function getCMSFields() {
		$f = parent::getCMSFields();

		$f->removeByName('Content');
		$f->removeByName('Metadata');
		$f->removeByName('BackgroundImage');

		$f->addFieldToTab('Root.Main', new TextField('Phone', 'Primary Phone Number'));
		$f->addFieldToTab('Root.Main', new TextField('Email', 'Primary Email Address'));
		$f->addFieldToTab('Root.Main', new TextField('Website', 'Website link (please include http:// or https:// in the link)'));
		$f->addFieldToTab('Root.Main', new TextField('LocalCrisisLine', 'Local Crisis Line'));
		$f->addFieldToTab('Root.Main', new TextField('SpanishLine', 'Spanish Line'));
		$f->addFieldToTab('Root.Main', new TextField('RegionalHotline', 'Regional Hotline'));
		$f->addFieldToTab('Root.Main', new TextField('TwentyFourHourCrisisLine', '24 Hour Crisis Line'));
		$f->addFieldToTab('Root.Main', new TextField('Fax', 'Fax number'));

		$f->addFieldToTab('Root.Main', new TextareaField('Address', 'Address'));
		$f->addFieldToTab('Root.Main', new TextareaField('CrisisLines', 'Crisis Line(s)'));
		$f->addFieldToTab('Root.Main', new TextareaField('ServicesOffered', 'Services Offered'));
		$f->addFieldToTab('Root.Main', new TextareaField('OutreachOffices', 'Outreach Offices'));

		$countyField = TagField::create('Counties', 'Counties', County::get(), $this->Counties())->setShouldLazyLoad(true);
		$f->addFieldToTab('Root.Main', $countyField, 'Content');

		return $f;
	}

}
