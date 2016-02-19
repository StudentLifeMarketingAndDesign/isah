<?php

class IsahProjectDirectory extends Page {

	private static $db = array(

	);
	private static $allowed_children = array(
		'IsahProject',
		'IsahDirectoryPage',
	);
	private static $defaults = array(
		'Content' => '',
	);
	private static $singular_name = 'Directory';
	private static $icon          = 'cms/images/treeicons/book-openfolder.gif';

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		//$fields->removeByName('Content');
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
		'SubmitCountyForm',
		'county',
		'FeedbackForm',

	);

	private static $url_handlers = array(
		'county//$Action/$ID/' => 'county',
	);
	public function CountyForm() {

		$fields = new FieldList(
			DropdownField::create('County', 'County', IsahProject::get('County')->map('URLSegment', 'Title'))->setEmptyString('(Select a county)'
			));

		$actions = new FieldList(
			FormAction::create("SubmitCountyForm")->setTitle("View County")->addExtraClass('visuallyhidden')
		);

		$required = new RequiredFields('County');

		$form = new Form($this, 'CountyForm', $fields, $actions, $required);

		return $form;
	}

	public function SubmitCountyForm($data, $form) {
		$countyUrl = $data['County'];
		$county    = County::get()->filter(array('URLSegment' => $countyUrl))->First();
		if ($county) {
			$this->redirect($county->Link());
		}
	}

	public function FeedbackSuccess() {
		$success = $this->getRequest()->getVar('FeedbackSuccess');
		if ($success == 1) {
			return true;
		}
	}
	public function county() {
		$action = $this->getRequest()->param('Action');

		switch ($action) {

			case 'show':
				$urlSegment = $this->getRequest()->param('ID');
				$county     = County::get()->filter(array('URLSegment' => $urlSegment))->First();
				if ($county) {
					$data = new ArrayData(array('County' => $county));
					return $this->customise($data)->renderWith(array('County', 'Page'));
				}
				break;
				
			case 'list':
				$counties = County::get()->sort('Title ASC');
				$data     = new ArrayData(
					array(
						'Counties' => $counties,
						'Title'    => 'Counties',
						'Action'   => 'list',
					)
				);
				return $this->customise($data)->renderWith(array('CountyList', 'Page'));

			case 'load':

				$countyName = $this->getRequest()->param('ID');

				if (is_numeric($countyName)) {
					$county = County::get()->filter(array('ID' => $countyName));
				} else {
					$county = County::get()->filter(array(
							'URLSegment' => $countyName,
						))->First();
				}
				
				if ($county) {
					$data = new ArrayData(array(
							'County' => $county,
						));
					return $this->customise($data)->renderWith('CountyRequest');
				} else {	
	
					return $this->renderWith('CountyRequestNotFound');
				}
				break;
			default:
				$this->redirect('about');

		}

	}

}
