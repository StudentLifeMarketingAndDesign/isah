<?php

class SexualAssaultProjectDirectory extends Page {

	private static $db = array(

	);
	private static $allowed_children = array(
		'SexualAssaultProject',
	);

	private static $singular_name = 'ProjectDirectory';

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$countyGridFieldConfig = GridFieldConfig_RecordEditor::create();
		$countyGridField       = new GridField('Counties', 'Counties', County::get(), $countyGridFieldConfig);
		$fields->addFieldToTab("Root.Counties", $countyGridField);

		return $fields;
	}

}

class SexualAssaultProjectDirectory_Controller extends Page_Controller {

	private static $allowed_actions = array(
		'CountyForm',
		'load',
	);

	private static $url_handlers = array(
		'load/$Name' => 'load',
	);

	public function load() {
		$countyName = $this->getRequest()->param('Name');

		if (is_numeric($countyName)) {
			$county = County::get_by_id('County', $countyName);
		} else {
			$county = County::get()->filter(array(
					'Title:PartialMatch' => $countyName,
				))->First();
		}

		$data = new ArrayData(array('County' => $county));

		return $this->customise($data)->renderWith('CountyRequest');
	}

	public function CountyForm() {

		$fields = new FieldList(
			DropdownField::create('County', 'County', SexualAssaultProject::get('County')->map('ID', 'Title'))->setEmptyString('(Select one)'
			));

		$actions = new FieldList(
			//FormAction::create("getCountyInfo")->setTitle("Submit")
		);

		$required = new RequiredFields('County');

		$form = new Form($this, 'CountyForm', $fields, $actions, $required);

		return $form;
	}

	public function getCountyInfo($data, Form $form) {
		$County = $data['County'];

		$form->sessionMessage('Hello '.$data['County'], 'success');

		return $this->redirectBack();
	}

}
