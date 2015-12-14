<?php

class SexualAssaultProjectDirectory extends Page {

	private static $db = array(

	);
	private static $allowed_children = array(
		'SexualAssaultProject',
	);

	public function getCMSFields() {
		$f = parent::getCMSFields();



		$countyGridFieldConfig = GridFieldConfig_RecordEditor::create();
		$countyGridField       = new GridField('Counties', 'Counties', County::get(), $countyGridFieldConfig);
		$f->addFieldToTab("Root.Counties", $countyGridField);

		
		return $f;
	}
}
