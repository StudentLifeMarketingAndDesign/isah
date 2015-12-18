<?php

class IsahProjectDirectory extends Page {

	private static $db = array(

	);
	private static $allowed_children = array(
		'IsahProject',
	);
	private static $defaults = array(
		'Content' => '',
	);
	private static $singular_name = 'Directory';
	private static $icon          = 'cms/images/treeicons/book-openfolder.gif';
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName('Content');
		//$fields->removeByName('BackgroundImage');
		$fields->removeByName('Metadata');

		$countyGridFieldConfig = GridFieldConfig_RecordEditor::create();
		$countyGridFieldConfig->getComponentByType('GridFieldPaginator')->setItemsPerPage(100);

		$countyGridField = new GridField('Counties', 'Counties', County::get(), $countyGridFieldConfig);
		$fields->addFieldToTab("Root.Main", $countyGridField);

		return $fields;
	}

}

class IsahProjectDirectory_Controller extends Page_Controller {

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
			DropdownField::create('County', 'County', IsahProject::get('County')->map('ID', 'Title'))->setEmptyString('(Select one)'
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
