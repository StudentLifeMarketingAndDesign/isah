<?php
class Page extends SiteTree {

	private static $db = array(
	);

	private static $has_one = array(
	);
	public function OtherDirectoryResources() {
		return IsahDirectoryPage::get();
	}

	public function IsahProjects() {
		return IsahProject::get();
	}
}
class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array(
		'FeedbackForm',
	);

	public function init() {
		parent::init();
		$this->getRequestedCounty();

	}
	public function Breadcrumbs($maxDepth = 20, $unlinked = false, $stopAtPageType = false, $showHidden = false) {
		return parent::Breadcrumbs(20, false, false, true);
	}

	public function getRequestedCounty() {

		$action = $this->getRequest()->param('Action');
		$id     = $this->getRequest()->param('OtherID');

		switch ($action) {
			case 'list':
				return null;
			default:
				$county = County::get()->filter(array('URLSegment' => $id))->First();
		}
		if ($county) {
			return $county;
		} else {
			$county     = new DataObject();
			$county->ID = 0;
			return $county;
		}
	}

	public function FeedbackForm() {
		$county = $this->getRequestedCounty();
		//print_r($county->ID);
		$memberName  = '';
		$memberEmail = '';

		$fields = new FieldList(

			new TextField('Name', '<span>*</span>Your Name', $memberName),
			new EmailField('Email', '<span>*</span>Your Email Address', $memberEmail),

			DropdownField::create(
				'County',
				'If your feedback is related to a specific county please select one from below:',
				IsahProject::get('County')->map('ID', 'Title'),
				$county->ID
			)->setEmptyString('(Not related to a specific county)'),

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
		//$Form->enableSpamProtection();

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

		return $this->redirect($this->Link("?FeedbackSuccess=1"));

	}

	public function FeedbackSuccess() {
		if ($this->getRequest()->getVar('FeedbackSuccess')) {
			return true;
		}

	}

}
