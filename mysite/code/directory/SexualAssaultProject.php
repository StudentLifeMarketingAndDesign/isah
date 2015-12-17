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
	private static $icon        = "cms/images/treeicons/home-file.png";
	private static $has_many    = array(
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
		$countyField = TagField::create('Counties', 'Serves the following counties:', County::get(), $this->Counties())->setShouldLazyLoad(true);
		$countyField->setCanCreate(false);
		$f->addFieldToTab('Root.Main', $countyField);

		$f->addFieldToTab('Root.Main', new TextField('Phone', 'Primary phone number'));
		$f->addFieldToTab('Root.Main', new TextField('Email', 'Primary email address'));
		$f->addFieldToTab('Root.Main', new TextField('Website', 'Website link (please include http:// or https:// in the link)'));
		$f->addFieldToTab('Root.Main', new TextField('LocalCrisisLine', 'Local crisis line'));
		$f->addFieldToTab('Root.Main', new TextField('SpanishLine', 'Spanish line'));
		$f->addFieldToTab('Root.Main', new TextField('RegionalHotline', 'Regional hotline'));
		$f->addFieldToTab('Root.Main', new TextField('TwentyFourHourCrisisLine', '24 hour crisis line'));
		$f->addFieldToTab('Root.Main', new TextField('Fax', 'Fax number'));

		$f->addFieldToTab('Root.Main', new TextareaField('Address', 'Address'));
		$f->addFieldToTab('Root.Main', new TextareaField('CrisisLines', 'Crisis line(s)'));
		$f->addFieldToTab('Root.Main', new TextareaField('ServicesOffered', 'Services offered'));
		$f->addFieldToTab('Root.Main', new TextareaField('OutreachOffices', 'Outreach offices'));

		return $f;
	}

}
