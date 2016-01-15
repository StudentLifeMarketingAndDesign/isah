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
		$fields->removeByName('Content');
		//$fields->removeByName('BackgroundImage');
		$fields->removeByName('Metadata');

		$countyGridFieldConfig = GridFieldConfig_RecordEditor::create();
		$countyGridFieldConfig->getComponentByType('GridFieldPaginator')->setItemsPerPage(100);

		$countyGridField = new GridField('Counties', 'Counties', County::get(), $countyGridFieldConfig);
		$fields->addFieldToTab("Root.Main", $countyGridField);

		return $fields;
	}

	public function CountyForm() {

		$fields = new FieldList(
			DropdownField::create('County', 'County', IsahProject::get('County')->map('URLSegment', 'Title'))->setEmptyString('(Select a county)'
			));

		$actions = new FieldList(
			//FormAction::create("getCountyInfo")->setTitle("Submit")
		);

		$required = new RequiredFields('County');

		$form = new Form($this, 'CountyForm', $fields, $actions, $required);

		return $form;
	}

	public function OtherDirectoryResources() {

		return $this->Children()->filter(array('ClassName' => 'IsahDirectoryPage'));
	}

}

class IsahProjectDirectory_Controller extends Page_Controller {

	private static $allowed_actions = array(
		'CountyForm',
		'load',
		'county',
		'FeedbackForm',
	);

	private static $url_handlers = array(
		'load/$Name'         => 'load',
		'county/$URLSegment' => 'county',
	);

	public function FeedbackForm() {

		$memberName  = '';
		$memberEmail = '';

		$fields = new FieldList(

			new TextField('Name', '<span>*</span>Your Name', $memberName),
			new EmailField('Email', '<span>*</span>Your Email Address', $memberEmail),
			DropdownField::create('County', 'If your feedback is related to a specific county please select one from below:', IsahProject::get('County')->map('ID', 'Title'))->setEmptyString('(None)'),
			new TextAreaField('Feedback', '<span>*</span>Your Feedback'),
			new HiddenField('PageID', 'PageID', $this->ID)

		);

		$actions = new FieldList(
			new FormAction('SubmitFeedbackForm', 'Submit Feedback')
		);

		// Create action
		$validator = new RequiredFields('Name', 'Email', 'Feedback');

		//Create form
		$Form = new Form($this, 'FeedbackForm', $fields, $actions, $validator);

		//$protector = SpamProtectorManager::update_form($Form, 'Message', null, "Please enter the following words");
		$Form->enableSpamProtection();

		return $Form;
	}

	public function SubmitFeedbackForm($data, $form) {

		$adminEmail = Config::inst()->get('Email', 'admin_email');

		$feedback = new FeedbackItem();
		$form->saveInto($feedback);

		$feedback->write();

		if ($feedback->SpecificPage == "1") {
			$relatedPage = Page::get_by_id("Page", $feedback->PageID);
		}

		$subject = "Feedback submitted";

		//check data for errors
		$name      = Convert::raw2sql($data['Name']);
		$userEmail = Convert::raw2sql($data['Email']);
		$feedback  = Convert::raw2sql($data['Feedback']);

		if (isset($relatedPage)) {
			$body = ''.$name." has submitted feedback for page ".$relatedPage->Title.". <br><br>Feedback:".$feedback;
		} else {
			$body = ''.$name." has submitted feedback. "."<br><br>Feedback:".$feedback;
		}

		$email = new Email();
		$email->setTo($adminEmail);
		$email->setFrom($adminEmail);
		$email->setSubject($subject);
		$email->setBody($body);
		if (SS_ENVIRONMENT_TYPE == "live") {
			$email->send();
		}

		return $this->redirect($this->Link());
	}

	public function county() {
		$urlSegment = $this->getRequest()->param('URLSegment');
		$county     = County::get()->filter(array('URLSegment' => $urlSegment))->First();

		$data = new ArrayData(array('County' => $county));

		return $this->customise($data)->renderWith(array('County', 'Page'));
	}

	public function load() {
		$countyName = $this->getRequest()->param('Name');

		if (is_numeric($countyName)) {
			echo "is numeric";
			$county = County::get()->filter(array('ID' => $countyName));
		} else {
			$county = County::get()->filter(array(
					'URLSegment' => $countyName,
				))->First();
		}

		$data = new ArrayData(array(
				'County' => $county,
			));

		return $this->customise($data)->renderWith('CountyRequest');
	}

	public function getCountyInfo($data, Form $form) {
		$County = $data['County'];

		$form->sessionMessage('Hello '.$data['County'], 'success');

		//return $this->redirectBack();
	}

}
